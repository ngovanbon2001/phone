<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * @OA\Info(
 *     title="Gotech API",
 *     version="1.0.0",
 *     description="Tài liệu API cho hệ thống Gotech",
 *     @OA\Contact(
 *         email="admin@gotech.vn"
 *     )
 * )
 */
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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        if (Auth::attempt([
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ])) {
            loginCart();

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

    /**
     * @OA\Get(
     *     path="/api/listUser",
     *     summary="Lấy danh sách tài khoản người dùng",
     *     description="Trả về danh sách tất cả các tài khoản người dùng hiện có trong hệ thống",
     *     operationId="listUser",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Tên người dùng",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email người dùng",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Danh sách tài khoản",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", description="ID của người dùng"),
     *                 @OA\Property(property="name", type="string", description="Tên người dùng"),
     *                 @OA\Property(property="email", type="string", description="Địa chỉ email của người dùng")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Yêu cầu không hợp lệ"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Lỗi server"
     *     )
     * )
     */
    public function listUser()
    {
        return Admin::all();
    }
}
