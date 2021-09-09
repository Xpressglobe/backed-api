<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function index()
    {
        $data = Country::where('is_supported', 1)->get();
        return $this->respondWithSuccess($data);
    }
}
