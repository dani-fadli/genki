<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)->get();
        return inertia('Order', [
            'orders' => $orders,
        ]);
    }

    public function indexDashboard(Request $request)
    {
        return inertia('Dashboard/Order', [
            'orders' => Order::latest()->paginate(10)
        ]);
    }

    public function indexPaymentConfirmation(string $orderId)
    {
        return inertia('PaymentConfirmation', [
            'order' => Order::find($orderId)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->prescription_image = Storage::url($order->prescription_image);

        return inertia('OrderDetail', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editDashboard($id)
    {
        $order = Order::find($id);
        $order->prescription_image = Storage::url($order->prescription_image);
        return inertia('Dashboard/OrderEdit', [
            'order' => $order,
        ]);
    }

    public function updateDashboard(Request $request, $id)
    {
        Order::findOrFail($id)->update([
            'status' => $request->status
        ]);

        return redirect(route('dashboard.order.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'bank_account_name' => ['required', 'string'],
            'bank_account_number' => ['required', 'string'],
            'payment_confirmation_image' => ['file', 'max:1000', 'mimes:jpg,jpeg,png'],
        ]);

        $file = $request->file('payment_confirmation_image');
        $filename = 'payment_confirmations_' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
        if ($file->isValid()) $file->storeAs('', $filename);

        $order->update([
            'payment' => (object)[
                'bank_account_name' => $request->bank_account_name,
                'bank_account_number' => $request->bank_account_number,
                'payment_confirmation_image' => $filename,
            ]
        ]);

        return redirect(route('homepage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

        ]);

        $carts = Cart::whereIn('id', $request->cart_ids)->with('medicine')->get();
        $carts->transform(function ($cart) {
            return [
                'medicine_id' => $cart->medicine->id,
                'name' => $cart->medicine->name,
                'quantity' => $cart->quantity,
                'price' => $cart->medicine->price,
                'total_price' => $cart->medicine->price * $cart->quantity,
            ];
        });

        $order = Order::create([
            'user_id' => $request->user()->id,
            'type' => 'general',
            'invoice_number' => strtoupper(implode('/', ['INV', 'G', now()->format('dmyhi'), Str::random(5)])),
            'medicines' => $carts->toArray(),
            'total_payment' => $carts->sum('total_price'),
            'status' => 'unpaid',
        ]);

        return redirect(route('order.payment_confirmation', $order->id));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function storePrescription(Request $request)
    {
        $request->validate([
            'prescription' => ['required', 'file', 'max:1000', 'mimes:jpg,jpeg,png'],
        ]);

        $file = $request->file('prescription');
        $filename = 'prescription_' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
        if ($file->isValid()) $file->storeAs('', $filename);

        $order = Order::create([
            'user_id' => $request->user()->id,
            'type' => 'prescription',
            'invoice_number' => strtoupper(implode('/', ['INV', 'P', now()->format('dmyhi'), Str::random(5)])),
            'status' => 'pending',
            'prescription_image' => $filename,
        ]);

        return redirect(route('order.show', $order->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
