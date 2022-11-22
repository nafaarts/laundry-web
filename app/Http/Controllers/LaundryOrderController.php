<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class LaundryOrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->laundry->orders()->latest()->paginate();
        return view('user-laundry.order', compact('orders'));
    }

    public function detail(Order $order)
    {
        return view('user-laundry.order-detail', compact('order'));
    }

    public function updateStatus(Order $order)
    {
        $type = request('type');
        switch ($type) {
            case 'STATUS':
                $order->update(['status' => request('status')]);
                break;

            case 'PAID':
                $order->update(['is_paid' => request('status')]);
                break;

            case 'PICKEDUP':
                $order->update(['is_pickeup' => request('status')]);
                break;

            default:
                abort(404);
                break;
        }

        return redirect()->route('laundry-orders.detail', $order)->with('success', 'Status berhasil di update!');
    }
}
