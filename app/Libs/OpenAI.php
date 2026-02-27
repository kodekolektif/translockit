<?php
namespace App\Libs;

use App\Settings\AppSettings;
use Illuminate\Support\Facades\Log;

class OpenAI
{
    private $apiKey;
    private $model;
    private $apiUrl;

    public function __construct(AppSettings $appSettings)
    {
        $this->apiKey = $appSettings->openai_api_key;
        $this->model = "gpt-4o-mini";
        $this->apiUrl = $appSettings->openai_api_url;
    }

    public function callAPI($userPrompt, $systemPrompt = null)
    {
        $messages = [];

        if ($systemPrompt) {
            $messages[] = [
                'role' => 'system',
                'content' => $systemPrompt
            ];
        }

        $messages[] = [
            'role' => 'user',
            'content' => $userPrompt
        ];

        $payload = [
            'model' => $this->model,
            'messages' => $messages,
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
        ];

        $ch = curl_init($this->apiUrl);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 30,
        ]);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        $curlErrno = curl_errno($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $decodedResponse = json_decode($response, true);
        $jsonError = json_last_error();

        // Secure header logging (hide API key)
        $safeHeaders = [
            'Content-Type: application/json',
            'Authorization: Bearer ***'
        ];

        $log = [
            'type' => 'OpenAI',
            'url' => $this->apiUrl,
            'ip' => request()->ip(),
            'datetime' => now()->toDateTimeString(),
            'http_code' => $httpCode,
            'curl_errno' => $curlErrno,
            'curl_error' => $curlError,
            'json_error' => $jsonError !== JSON_ERROR_NONE ? json_last_error_msg() : null,
            'request_headers' => $safeHeaders,
            'request_payload' => $payload,
            'response_raw' => $response,
        ];

        if ($curlErrno) {
            Log::channel('openai')->error('openai-request-failed', $log);
            throw new \Exception('Curl error: ' . $curlError);
        }

        if ($httpCode >= 400) {
            Log::channel('openai')->error('openai-http-error', $log);
            throw new \Exception("HTTP Error {$httpCode}");
        }

        Log::channel('openai')->info('openai-request-success', $log);

        return $decodedResponse;
    }


    public function translate($text, $targetLanguage = 'es')
    {
        $userPrompt = "Translate this to $targetLanguage: \"$text\"";
        $systemPrompt = "You are a professional translator AI. Translate only the text content, without altering the HTML tags or structure. Keep all punctuation, formatting, and HTML tag names exactly the same as in the input. Respond only with the translated result.";
        $response = $this->callAPI($userPrompt, $systemPrompt);

        if (isset($response['choices'][0]['message']['content'])) {
            return $response['choices'][0]['message']['content'];
        } else {
            throw new \Exception('Translation failed: ' . json_encode($response));
        }
    }
}
