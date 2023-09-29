<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('auth/user/login', function (Request $request){
        return view('multi-auth.user-login');
});


Route::get('auth/admin/login', function (Request $request){
    return view('multi-auth.admin-login');
});

Route::post('auth/user/login', function (Request $request){
    $request->validate([
       'email' => 'required|email',
       'password' => 'required'
    ]);

    if (auth()->guard('web')->attempt($request->only(['email', 'password']))) {
        dump(\Illuminate\Support\Facades\Auth::user());
        return '<H1>User Dashboard</H1>';
    } else {
        return 'Invalid Credentials';
    };
});


Route::post('auth/admin/login', function (Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    if (auth()->guard('admin')->attempt($request->only(['email', 'password']))) {
        dump(auth()->guard('admin')->user());
        return '<h1>Admin Dashboard</h1>';
    } else {
        return 'Invalid Credentials';
    }
});
