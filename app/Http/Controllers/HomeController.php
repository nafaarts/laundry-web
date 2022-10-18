<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\LaundryService;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['users'] = User::count();
        $data['laundry'] = Laundry::count();
        $data['services'] = LaundryService::count();
        $data['orders'] = Order::count();

        return view('home', compact('data'));
    }
}
