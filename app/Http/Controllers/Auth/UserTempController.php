<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserTemp\CreateUserRequest;
use App\Services\Contracts\UserTempServiceInterface;

class UserTempController extends Controller
{
    protected $userTempServiceInterface;

    public function __construct(UserTempServiceInterface $userTempServiceInterface)
    {
        $this->userTempServiceInterface = $userTempServiceInterface;
    }

    public function create(CreateUserRequest $request)
    {
        $userTemp = $this->userTempServiceInterface->create($request->all());

        return $this->handleViewResponse($userTemp, 'register', Common::ACTION[Common::ACTION_CREATE], 'Please confirm registration');
    }

    public function show($id)
    {
        $userTemp = $this->userTempServiceInterface->show($id);

        return view('auth/user/temp', compact('userTemp'));
    }
}
