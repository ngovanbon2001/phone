<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserExtendServiceInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Socialite;

class UserExtendService implements UserExtendServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $attributes
     * @return bool|null
     */
    public function send(array $attributes): ?bool
    {
        try {
            $token = Str::random(64);

            $user = DB::table('password_resets')->insert([
                'email'      => $attributes['email'],
                'token'      => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::send('auth.email.forgetPassword', ['token' => $token], function ($message) use ($attributes) {
                $message->to($attributes['email']);
                $message->subject('Reset Password');
            });

            return $user;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $attributes
     * @return null
     */
    public function update(array $attributes)
    {
        DB::beginTransaction();
        try {
            $updatePassword = DB::table('password_resets')->where(['email' => $attributes['email']])->first();

            if (!$updatePassword) {
                return null;
            }

            $user = $this->userRepository->where(['email' => $attributes['email']])->first();

            if ($user) {
                $user->update(['password' => Hash::make($attributes['password'])]);
            }

            DB::table('password_resets')->where(['email' => $attributes['email']])->delete();

            DB::commit();
            return $user;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @return Redirector|string|RedirectResponse|Application
     */
    public function loginSocial(): Redirector|string|RedirectResponse|Application
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     * @param array $request
     */
    public function callBack(array $request)
    {
        try {
            $password = Str::random(8);
            $userData = Socialite::driver('google')->user();
            $user = $this->userRepository->findWhere([
                ['email', 'like', $userData['email'] ?? null]
            ])->first();

            if (empty($user)) {
                $result = $this->userRepository->create([
                    'email' =>  $userData['email'] ?? null,
                    'password' => Hash::make($password)
                ]);

                if ($result) {
                    Mail::raw('Your password is '. $password .'. Please do not share', function ($message) use ($userData) {
                        $message->to($userData['email'] ?? null)->subject('Register success');
                    });
                }
            } else {
                $result = $user;
            }

            return $result;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
