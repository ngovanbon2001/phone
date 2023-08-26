<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $brandServiceInterface;
    protected $categoryServiceInterface;
    protected $userServiceInterface;

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(
        BrandServiceInterface    $brandServiceInterface,
        CategoryServiceInterface $categoryServiceInterface,
        UserServiceInterface  $userServiceInterface
    ) {
        $this->brandServiceInterface    = $brandServiceInterface;
        $this->categoryServiceInterface = $categoryServiceInterface;
        $this->userServiceInterface     = $userServiceInterface;
    }

    public function index(Request $request)
    {
        //all category
        $categories = $this->categoryServiceInterface->getAll();

        //all brand
        $brands = $this->brandServiceInterface->getAll();

        $users = $this->userServiceInterface->list($request->all());

        return view('admin/user/show', compact('users', 'categories', 'brands'));
    }

    public function create()
    {
        //all category
        $categories = $this->categoryServiceInterface->getAll();

        //all brand
        $brands = $this->brandServiceInterface->getAll();

        return view('admin/user/add', compact('categories', 'brands'));
    }

    public function store(CreateUserRequest $request)
    {
        $staff = $this->userServiceInterface->create($request->all());

        session()->flash('messageAdd', $staff->username . ' has been added.');
        return redirect()->route('indexUser');
    }

    public function edit($id)
    {
        //all category
        $categories = $this->categoryServiceInterface->getAll();

        //all brand
        $brands = $this->brandServiceInterface->getAll();

        // Get Staff
        $staff = $this->userServiceInterface->detail($id);

        return view('admin/user/update', compact('staff', 'categories', 'brands'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $staff = $this->userServiceInterface->update($request->all(), $id);

        session()->flash('messageUpdate', $staff->name . ' has been updated.');
        return redirect()->route('indexUser');
    }

    public function show($id)
    {
        //all category
        $categories = $this->categoryServiceInterface->getAll();

        //all brand
        $brands = $this->brandServiceInterface->getAll();

        // Get Staff
        $staff = $this->userServiceInterface->detail($id);

        return view('admin/profile/show', compact('staff', 'categories', 'brands'));
    }

    public function updateProfile(UpdateProfileRequest $request, $id)
    {
        $staff = $this->userServiceInterface->update($request->all(), $id);

        session()->flash('messageUpdate', $staff->name . ' has been updated.');
        return redirect()->route('showUser', $id);
    }

    public function destroy($id)
    {
        $this->userServiceInterface->delete($id);

        return redirect()->route('indexUser');
    }
}
