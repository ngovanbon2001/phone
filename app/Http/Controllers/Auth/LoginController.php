<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $cart      = Session::get('cart-0') ?? [];
            $cartLogin = Session::get('cart-' . auth()->user()->id) ?? [];
            $products  = array_merge($cart, $cartLogin);

            $aggregatedProducts = [];

            foreach ($products as $product) {
                $productId = $product["product_id"];
                $quantity = intval($product["quantity"]);

                if (!isset($aggregatedProducts[$productId])) {
                    $aggregatedProducts[$productId] = $product;
                } else {
                    $aggregatedProducts[$productId]["quantity"] += $quantity;
                }
            }
            
            Session::put('cart-' . auth()->user()->id, $aggregatedProducts);

            return redirect()->route('web.home');
        } else {
            session()->flash('messageLoginError', 'User account or password incorrect');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
