<?php

namespace App\Services;

use App\Repositories\Contracts\UserTempRepositoryInterface;
use App\Services\Contracts\UserTempServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class UserTempService implements UserTempServiceInterface
{
    protected UserTempRepositoryInterface $userRepository;

    /**
     * @param UserTempRepositoryInterface $userRepository
     */
    public function __construct (
        UserTempRepositoryInterface $userRepository,
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed
    {
        try {
            $attributes['code'] = Str::random(6);
            $userTemp = $this->userRepository->create($attributes);
            $url = URL::route('user.register', ['id' => $userTemp->id]);
            $html = sprintf('<p>Mã code của bạn: %s</p>', $userTemp->code);
            $html .= sprintf('<p><a href="%s">Click vào đây để đến Gmail</a></p>', $url);

            if ($userTemp) {
                Mail::send([], [], function ($message) use ($userTemp, $html) {
                    $message->to($userTemp->email)->subject('Register');
                    $message->setBody($html, 'text/html');
                });
            }

            return $userTemp;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function delete(int $id): mixed
    {
        try {
            $userTemp = $this->userRepository->find($id);

            if ($userTemp) {
                $userTemp->delete();
            }

            return $userTemp;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function show(int $id): mixed
    {
        try {
            return $this->userRepository->find($id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
