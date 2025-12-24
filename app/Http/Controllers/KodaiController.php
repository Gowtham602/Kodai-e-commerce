<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KodaiController extends Controller
{
    public function about(){
        return view('Kodai.about');
    }
}
