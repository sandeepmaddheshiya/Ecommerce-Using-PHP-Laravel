<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        // Retrieve orders associated with the admin's products
        $orders = Order::whereHas('orderItems.product', function ($query) use ($admin) {
            $query->where('admin_id', $admin->id);
        })->paginate(10); // Pagination added

        return view('admin.AdminOrders.index', compact('orders'));
    }


    public function show(Order $order)
    {
        $admin = Auth::guard('admin')->user();

        // Eager load orderItems with the product relationship
        $order->load('orderItems.product');

        // Ensure the order belongs to the admin's products
        if (!$order->orderItems->pluck('product.admin_id')->contains($admin->id)) {
            abort(403);
        }

        return view('admin.AdminOrders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|string|in:Pending,Confirmed,Shipped,Delivered',
        ]);

        // Find the order and update status
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        // Redirect with success message
        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }


}
