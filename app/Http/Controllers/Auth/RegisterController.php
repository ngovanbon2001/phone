<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\Contracts\UserServiceInterface;
use App\Services\Contracts\UserTempServiceInterface;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $userTempServiceInterface;
    protected $userServiceInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserTempServiceInterface $userTempServiceInterface,
        UserServiceInterface     $userServiceInterface
    )
    {
        $this->middleware('guest');
        $this->userTempServiceInterface = $userTempServiceInterface;
        $this->userServiceInterface     = $userServiceInterface;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create($data)
    {
        return $this->userServiceInterface->createUser($data);
    }
}
