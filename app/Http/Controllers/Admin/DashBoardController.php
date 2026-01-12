<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class DashBoardController extends Controller
{
    //  protect all admin product routes
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
public function dashboard()
{
    return view('admin.dashboard', [
        'ordersCount' => Order::count(),
        'productsCount' => Product::count(),
        'usersCount' => User::count(),
        'todayOrders' => Order::whereDate('created_at', today())->count(),
    ]);
}

 public function userList()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

       
 



}
