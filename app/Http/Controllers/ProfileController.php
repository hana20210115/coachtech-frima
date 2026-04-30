<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('mypage_edit', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        
        $data = $request->only(['name', 'postcode', 'address', 'building']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');
            $data['image'] = $path;
        }

        $user->update(['name' => $data['name']]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'image' => $data['image'] ?? $user->profile?->image,
                'postcode' => $data['postcode'],
                'address' => $data['address'],
                'building' => $data['building'],
            ]
        );

        session()->forget('new_address');

        return redirect()->route('items.index')->with('status', 'プロフィールを更新しました');
    }
    
    public function index(Request $request)
    {
        $user = Auth::user()->load('profile');

        $sellItems = Item::where('user_id', $user->id)->get();

        $buyItems = Order::where('user_id', $user->id)
            ->with('item')
            ->get()
            ->pluck('item');

        return view('mypage', compact('user', 'sellItems', 'buyItems'));
    }
}