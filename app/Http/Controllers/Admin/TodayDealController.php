<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\TodayDeal;

class TodayDealController extends Controller
{
    //  SHOW CREATE FORM (THIS WAS MISSING)
    public function create()
    {
        $products = Product::where('is_active', 1)->get();
        return view('admin.todaydeals.create', compact('products'));
    }

    //  STORE DEAL
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'deal_price' => 'required|numeric|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        TodayDeal::create([
            'product_id' => $request->product_id,
            'deal_price' => $request->deal_price,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 1,
        ]);

        return redirect()
            ->route('admin.today-deals.create')
            ->with('success', 'Today deal created successfully');
    }
}
