<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    
    public function create()
    {
        return view('auth.login');
    }

   
    public function store(LoginRequest $request)
    {
        
        $credentials = $request->validated();

        
        if (Auth::attempt($credentials)) {
            
            $request->session()->regenerate();
            return redirect('/');
        }

        
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }

    
    public function destroy(\Illuminate\Http\Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}