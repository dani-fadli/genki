<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Medicine;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::where('user_id', $request->user()->id)
            ->with('medicine:id,name,price')
            ->get();

        return inertia('Cart', [
            'carts' => $carts,
            'payments' => [
                'total_price' => $carts->sum(function ($cart) {
                    return $cart->medicine->price * $cart->quantity;
                })
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function get(Request $request)
    {
        return response()->json([
            'carts' => Cart::where('user_id', $request->user()->id)
                ->with('medicine:id,name,price')
                ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => ['required', 'exists:medicines,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = Cart::where([
            'user_id' => $request->user()->id,
            'medicine_id' => $request->medicine_id,
        ])->first();
        $medicine = Medicine::find($request->medicine_id);

        if ($cart) {
            if ($cart->quantity + $request->quantity > $medicine->stock)
                return back()->with('error', 'Produk sudah ada di keranjang dan sudah mencapai batas stok');

            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
            ]);
        } else {
            if ($request->quantity > $medicine->stock)
                return back()->with('error', 'Stok tidak mencukupi');

            Cart::create([
                'user_id' => $request->user()->id,
                'medicine_id' => $request->medicine_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'action' => ['string', 'in:increment,decrement,update'],
            'quantity' => ['nullable', 'required_if:action,update', 'integer', 'min:1'],
        ]);

        switch ($request->action) {
            case 'increment':
                if (++$cart->quantity > $cart->medicine->stock)
                    return back()->with('error', 'Stok tidak mencukupi');

                $cart->increment('quantity');
                break;
            case 'decrement':
                if (--$cart->quantity === 0)
                    return back()->with('error', 'Minimal quantity adalah 1');

                $cart->decrement('quantity');
                break;
            default:
                if ($request->quantity > $cart->medicine->stock)
                    return back()->with('error', 'Stok tidak mencukupi');

                $cart->update([
                    'quantity' => $request->quantity,
                ]);
        }

        return back()->with('success', 'Keranjang berhasil diperbarui');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back();
    }
}
