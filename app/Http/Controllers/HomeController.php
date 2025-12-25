<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TodayDeal;


class HomeController extends Controller
{
    public function index()
    {
        $todayDeals = TodayDeal::with('product')
    ->where('status', 1)
    ->where('start_time', '<=', now())
    ->where('end_time', '>=', now())
    ->get();
        return view('home.index',compact('todayDeals'));
    

    }



}
