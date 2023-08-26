<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard("admin")->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('homeAdmin');
        } else {
            session()->flash('messageLoginError', 'User account or password incorrect');
            return redirect()->route('login');
        }
    }
}
