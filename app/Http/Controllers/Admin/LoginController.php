<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('admin.auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        if (Auth::guard("admin")->attempt(
            ['email' => $request->input('email'), 'password' => $request->input('password')])
        ) {
            return redirect()->route('homeAdmin');
        } else {
            session()->flash('messageLoginError', 'User account or password incorrect');
            return redirect()->route('login');
        }
    }
}
