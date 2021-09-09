<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        $data = Currency::where('active', 1)->get();
        return $this->respondWithSuccess($data);
    }
}
