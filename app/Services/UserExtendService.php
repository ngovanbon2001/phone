<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserExtendServiceInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserExtendService implements UserExtendServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct (
        UserRepositoryInterface $userRepository,
    )
    {
        $this->userRepository = $userRepository;
    }

    public function send(array $attributes)
    {
        try {
            $token = Str::random(64);

            $user = DB::table('password_resets')->insert([
                'email'      => $attributes['email'],
                'token'      => $token,
                'created_at' => Carbon::now()
            ]);
    
            Mail::send('auth.email.forgetPassword', ['token' => $token], function ($message) use ($attributes){
                $message->to($attributes['email']);
                $message->subject('Reset Password');
            });

            return $user;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

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
}
