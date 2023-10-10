<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\UserExtendServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    protected UserExtendServiceInterface $userExtendService;

    /**
     * @param UserExtendServiceInterface $userExtendService
     */
    public function __construct(
        UserExtendServiceInterface $userExtendService,
    ) {
        $this->userExtendService = $userExtendService;
    }

    /**
     * @return Redirector|string|RedirectResponse|Application
     */
    public function redirectToGoogle(): Redirector|string|RedirectResponse|Application
    {
        return $this->userExtendService->loginSocial();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function handleGoogleCallback(Request $request): RedirectResponse
    {
        $result = $this->userExtendService->callBack($request->all());

        if ($result) {
            auth()->login($result, true);
    
            loginCart();
    
            return redirect()->route('web.home');
        }

        return redirect()->route('login');
    }
}
