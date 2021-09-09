<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\Follower;
use App\Models\User;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Stripe\Stripe;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Mail;

class UserController extends Controller
{


    public function authenticate(Request $request)
    {
        $authenticated_user = User::where('email', $request->email_or_username)->orWhere('username', $request->email_or_username)->where('role', 'users')->first();
        if (!$authenticated_user) {
            return $this->respondWithError('Account not found');
        }
        if (!Hash::check($request->password, $authenticated_user->password)) {
            return $this->respondWithError(['error' => 'Invalid credentials'], 400);
        }
        //        if($authenticated_user->step_verification){
        //            $authenticated_user->otp = rand(200000, 999999);
        //            $authenticated_user->save();
        //            return $this->respondWithSuccess(['data' => ['verification_required' => true, 'message' => 'Login pending, Supply OTP to continue']], 201);
        //        }

        $token = $authenticated_user->createToken('LaravelAuthApp')->accessToken;

        if($authenticated_user->is_email_verified != 1){
            $this->verify($authenticated_user);
        }


        return $this->respondWithSuccess(['data' => ['token' => $token, 'verification_required' => false, 'user' => $authenticated_user]], 201);
    }

    public function stepVerification(Request $request)
    {
        $validator = $this->getValidationFactory()->make($request->all(), [
            'otp' => ['required', 'min:6', 'max:6'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);
        if ($validator->fails()) {
            return $this->respondWithErrors($validator->errors());
        }
        $authenticated_user = User::where('email', $request->email_or_username)->orWhere('username', $request->email_or_username)->first();

        if (!$authenticated_user) {
            return $this->respondWithError('Account not found');
        }
        if (!Hash::check($request->password, $authenticated_user->password)) {
            return $this->respondWithError(['error' => 'Invalid credentials'], 400);
        }

        //        if(!$authenticated_user->is_verified){
        //            return $this->respondWithError('Your email is unverified');
        //        }

        if ($authenticated_user->otp === $request->otp) {
            $token = $authenticated_user->createToken('LaravelAuthApp')->accessToken;
            $authenticated_user->otp = null;
            $authenticated_user->save();
            return $this->respondWithSuccess(['data' => ['token' => $token, 'verification_required' => false, 'user' => $authenticated_user]], 201);
        }
        return $this->respondWithError('Wrong OTP supplied');
    }


    /**
     * Gets Authenticated User
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticatedUser(): \Illuminate\Http\JsonResponse
    {
        if (!$authenticated_user = getUser()) {
            return response()->json(['error' => 'user_not_found'], 404);
        }
        $authenticated_user->makeVisible(['account_number', 'bank_code',]);
        return $this->respondWithSuccess($authenticated_user);
    }

    public function uploadAvatar(Request $request)
    {
        $validator = $this->getValidationFactory()->make($request->all(), [
            'profile_photo' => ['required', 'file', 'mimes:jpg,bmp,png'],
        ]);
        if ($validator->fails()) {
            return $this->respondWithErrors($validator->errors());
        }
        if ($file = $request->file('profile_photo')) {
            $authenticated_user = getUser();
            $avatar = $file->storeOnCloudinary('ajolla/avatars')->getSecurePath();
            $authenticated_user->profile_photo = $avatar;
            $authenticated_user->save();
            return $this->respondWithSuccess($authenticated_user);
        }
        return $this->respondWithError('Avatar upload was not successful');
    }


    public function forgetPassword(Request $request)
    {
        $validator = $this->getValidationFactory()->make($request->all(), [
            'email' => ['required', 'email'],
        ]);
        if ($validator->fails()) {
            return $this->respondWithErrors($validator->errors());
        }
        $authenticated_user = User::whereEmail($request->email)->first();
        if (!$authenticated_user) {
            return $this->respondWithError('Account does not match record');
        }
        $token = rand(777777, 999999);
        DB::table('password_resets')->insert(['email' => $request->email, 'token' => $token, 'created_at' => now()]);

        //Notify User
        //Send Email
        return $this->respondWithSuccess('Successfully created a reset token check your email ' . $token);
    }


    public function follow(Request $request)
    {
        $this->validateData($request, ['user_id' => 'required|exists:users,id']);
        $authenticated_user = getUser();
        $user = User::find($request->user_id);
        $saved = Follower::Where('user_id', $request->user_id)->where('follow_user_id', $authenticated_user->id)->first();
        if ($saved) {
            $saved->delete();
            $follow = ' unfollowed ';
        } else {
            $follow = ' followed ';
            $saved = Follower::create(['user_id' => $request->user_id, 'follow_user_id' => $authenticated_user->id]);
        }


        $user->following = DB::table('followers')->where('deleted_at', null)->where('follow_user_id', $user->id)->count();
        $user->followers = DB::table('followers')->where('deleted_at', null)->where('user_id', $user->id)->count();
        $raised = $user->campaigns()
            ->join('campaign_supports', 'campaigns.id', '=', 'campaign_supports.campaign_id')
            ->where('campaign_supports.payment_status', '=', 'ACTIVE')
            ->select(['campaign_supports.card_quantity', 'campaigns.price'])
            ->get()
            ->sum(function ($cam) {
                return $cam->card_quantity * $cam->price;
            });

        $raised_users = $user->campaigns()
            ->join('campaign_supports', 'campaigns.id', '=', 'campaign_supports.campaign_id')
            ->where('campaign_supports.payment_status', '=', 'JOINED')
            ->select(['campaign_supports.card_quantity'])
            ->get()->sum(function ($cam) {
                return $cam->card_quantity;
            });

        $user->launched = $user->campaigns()->count();
        $user->supported = $user->campaign_supports()->count();
        $user->raised = $raised;
        $user->raised_users = $raised_users;

        $user->am_following = DB::table('followers')
        ->where('deleted_at', null)
            ->where('user_id', $user->id)
            ->where('follow_user_id', $authenticated_user->id)->count();
        return $this->respondWithSuccess(['message' => 'You' . $follow . $user->name, 'data' => $user]);
    }

    public function updatePassword(Request $request)
    {
        $validator = $this->getValidationFactory()->make($request->all(), [
            'password' => ['required', 'confirmation', 'min:6'],
            'old_password' => ['required'],
        ]);
        if ($validator->fails()) {
            return $this->respondWithErrors($validator->errors());
        }
        $authenticated_user = getUser();
        if (Hash::check($request->old_password, $authenticated_user->password)) {
            $authenticated_user->update(['password' => Hash::make($request->password)]);
            return $this->respondWithSuccess($authenticated_user);
        }
        return $this->respondWithError('Invalid Old Password');
    }

    public function verifyOtp(Request $request)
    {
        $validator = $this->getValidationFactory()->make($request->all(), [
            'otp' => ['required', 'min:6'],
            'email' => ['required', 'min:6'],
        ]);
        if ($validator->fails()) {
            return $this->respondWithErrors($validator->errors());
        }
        $token = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();

        //        $pass = \App\Models\
        if ($token) {
            return $this->respondWithSuccess($token);
        }
        return $this->respondWithError('Token not valid');
    }

    public function changePassword(Request $request)
    {
        $validator = $this->getValidationFactory()->make($request->all(), [
            'current_password' => ['required', 'min:6',],
            'password' => ['required', 'min:6',],
        ]);
        if ($validator->fails()) {
            return $this->respondWithErrors($validator->errors());
        }
        $authenticated_user = getUser();
        if (!Hash::check($request->current_password, $authenticated_user->password)) {
            return $this->respondWithError('Current password is wrong');
        }
        $authenticated_user->update(['password' => Hash::make($request->password)]);
        return $this->respondWithSuccess('Password changed successfully');
    }


    public function index(Request $request)
    {
        $validator = $this->getValidationFactory()->make($request->all(), [
            'username' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->respondWithErrors($validator->errors());
        }
        $authenticated_user = User::where('username', $request->username)->first();
        return $this->respondWithSuccess(['is_available' => !$authenticated_user]);
    }


    public function locations()
    {
        $authenticated_user = auth()->user();
        $locations = $authenticated_user->locations;
        return $this->respondWithSuccess($locations);
    }

    public function store(UserPostRequest $request)
    {
        $data = $request->merge(['password' => Hash::make($request->password)])->except(['profile_photo']);
        $authenticated_user = User::create($data);
        if ($request->hasFile('profile_photo')) {
            $authenticated_user->profile_photo = moveFile($request->profile_photo, 'avatars');
            $authenticated_user->save();
        }

        if ($request->hasFile('cover_photo')) {
            $authenticated_user->cover_photo = moveFile($request->cover_photo, 'cover_photo');
            $authenticated_user->save();
        }
        $token = $authenticated_user->createToken('LaravelAuthApp')->accessToken;

        $this->verify($authenticated_user);

        return $this->respondWithSuccess(['data' => ['token' => $token, 'user' => $authenticated_user]], 201);
    }

    public function verify($authenticated_user){

        $tokenn = rand(200000, 999999);

        UserVerify::create([
              'user_id' => $authenticated_user->id,
              'token' => $tokenn
            ]);

       Mail::send('emails.emailVerificationEmail', ['token' => $tokenn], function($message) use($authenticated_user){
              $message->to($authenticated_user->email);
              $message->subject('Email Verification Mail');
          });
    }

    public function update(Request $request)
    {
        $authenticated_user = getUser();
        //        if($acct = $request->account_number && $bank = $request->bank_code)
        //        {
        //          $stripe =    Stripe::resolveAccountNumber($acct, $bank);
        //        }
        $authenticated_user->update($request->except(['password', 'profile_photo', 'cover_photo']));
        if ($file = $request->file('profile_photo')) {
            $avatar = $file->storeOnCloudinary('ajolla/avatars')->getSecurePath();
            $authenticated_user->profile_photo = $avatar;
            $authenticated_user->save();
        }

        if ($file = $request->file('cover_photo')) {
            $banner = $file->storeOnCloudinary('ajolla/banners')->getSecurePath();
            $authenticated_user->cover_photo = $banner;
            $authenticated_user->save();
        }
        return $this->respondWithSuccess(['data' => $authenticated_user], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->respondWithSuccess(['message' => 'Successfully logged out'], 204);
    }

    public function searchUsers(Request $request){

        $data = User::query();
        if($request->q){
            $data = $data->whereLike(['username'], $request->q);
        }
        $data = $data->get();
        return $this->respondWithSuccess($data);

    }
}
