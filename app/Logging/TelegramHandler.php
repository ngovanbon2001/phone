<?php

namespace App\Logging;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\AbstractProcessingHandler;

class TelegramHandler extends AbstractProcessingHandler
{
    protected $botToken;
    protected $chatId;
    protected $client;

    public function __construct()
    {
        $this->botToken = config('logging.channels.telegram.bot_token');
        $this->chatId = config('logging.channels.telegram.chat_id');
    }

    protected function write($record): void
    {
        try {
            $message = $record['formatted'];
            $this->sendMessage($message);
        } catch (Exception $e) {
            Log::info("Lỗi: ". $e->getMessage());
        }
    }

    public function sendMessage($message)
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";

        try {
            $response = Http::withOptions([
                    'verify' => false,
                    'curl' => [
                        CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
                    ],
                ])
                ->timeout(60)
                ->post($url, [
                    'chat_id' => $this->chatId,
                    'text'    => $message,
                ]);

            if ($response->failed()) {
                throw new \Exception("Failed to send message: " . $response->body());
            }

            return $response->json();
        } catch (Exception $e) {
            throw new Exception("Failed to send message: " . $e->getMessage());
        }
    }
}
