<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\ResetPassword;
use App\Http\Requests\Password\UpdateUser;
use App\Services\Contracts\UserExtendServiceInterface;

class ForgotPasswordController extends Controller
{
    protected $userExtendServiceInterface;

    public function __construct(UserExtendServiceInterface $userExtendServiceInterface)
    {
        $this->userExtendServiceInterface = $userExtendServiceInterface;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(ResetPassword $request)
    {
        $user = $this->userExtendServiceInterface->send($request->all());

        if (!$user) {
            return back()->with('message-error', 'Please try again!');
        }
        
        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(UpdateUser $request)
    {
        $user = $this->userExtendServiceInterface->update($request->all());

        if (!$user) {
            return back()->with('message-error', 'Please try again!');
        }
        
        return redirect()->route('login')->with('message', 'Your password has been changed!');
    }
}
