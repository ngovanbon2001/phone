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
    protected $userRepository;

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
    public function create(array $attributes)
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
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->userRepository->delete($id);
    }

    /**
     * @param int $id
     */
    public function show(int $id)
    {
        return $this->userRepository->find($id);
    }
}
