<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
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

       
        $validatedData = $request->validated();

     
        $user->update(['name' => $validatedData['name']]);

   
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile_images', 'public');
            $validatedData['image'] = $path;
        }

        
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id], 
            [
                'postcode' => $validatedData['postcode'],
                'address' => $validatedData['address'],
             
                'image' => $validatedData['image'] ?? $user->profile?->image,
                'building_name' => $request->input('building_name'), 
            ]
        );

       return redirect('/')->with('status', 'プロフィールを設定しました！');
    }
}