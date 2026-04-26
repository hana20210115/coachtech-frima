<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
   
    public function create($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();

        $address = session('new_address', [
            'postcode' => $user->profile?->postcode,
            'address'  => $user->profile?->address,
            'building' => $user->profile?->building,
        ]);

        return view('purchase.create', compact('item', 'user', 'address'));
    }

    
    public function editAddress($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();
        return view('address', compact('item', 'user'));
    }

    public function updateAddress(Request $request, $item_id)
    {
        session(['new_address' => [
            'postcode' => $request->postcode,
            'address'  => $request->address,
            'building' => $request->building,
        ]]);
        return redirect()->route('purchase.create', ['item_id' => $item_id]);
    }

    
    public function store(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();

        $address = session('new_address', [
            'postcode' => $user->profile?->postcode,
            'address'  => $user->profile?->address,
            'building' => $user->profile?->building,
        ]);

     
        session(['checkout_data' => [
            'payment_method' => $request->payment_method,
            'address' => $address,
        ]]);

       
        Stripe::setApiKey(env('STRIPE_SECRET'));

       
        $checkout_session = Session::create([
            
            'payment_method_types' => [$request->payment_method],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
           
            'success_url' => route('purchase.success', ['item_id' => $item->id]),
            'cancel_url'  => route('purchase.create', ['item_id' => $item->id]),
        ]);

       
        return redirect($checkout_session->url);
    }

    
     
    public function success($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();
        $checkoutData = session('checkout_data');

    
        if (!$checkoutData) {
            return redirect()->route('items.index');
        }

    
        DB::transaction(function () use ($item, $user, $checkoutData) {
            Order::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'payment_method' => $checkoutData['payment_method'] ?? '未選択',
                'post_code' => $checkoutData['address']['postcode'],
                'address'   => $checkoutData['address']['address'],
                'building'  => $checkoutData['address']['building'],
            ]);

            $item->is_sold = true;
            $item->save();
        });

      
        session()->forget(['new_address', 'checkout_data']);

        return redirect()->route('items.index')->with('message', '購入が完了しました');
    }
}