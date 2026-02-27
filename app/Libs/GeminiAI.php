<?php
namespace App\Libs;

use App\Settings\AppSettings;
use Illuminate\Support\Facades\Log;

class GeminiAI
{
    private $apiKey;
    private $model;
    private $apiUrl;

    public function __construct(AppSettings $appSettings)
    {
        $this->apiKey = $appSettings->gemini_api_key ?? '';
        $this->model = 'gemini-2.0-flash'; // or use env setting if needed
        $this->apiUrl = $appSettings->gemini_api_url . $this->model . ':generateContent';
    }

    private function callAPI($userPrompt, $systemPrompt = null)
    {
        $parts = [];

        if ($systemPrompt) {
            $parts[] = ['text' => $systemPrompt];
        }

        $parts[] = ['text' => $userPrompt];

        $payload = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => $parts
                ]
            ]
        ];

        $headers = [
            'Content-Type: application/json',
        ];

        $url = $this->apiUrl . '?key=' . $this->apiKey;

        $ch = curl_init($url);

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

        $log = [
            'type' => 'Gemini',
            'url' => $this->apiUrl,
            'ip' => request()->ip(),
            'datetime' => now()->toDateTimeString(),
            'http_code' => $httpCode,
            'curl_errno' => $curlErrno,
            'curl_error' => $curlError,
            'json_error' => $jsonError !== JSON_ERROR_NONE ? json_last_error_msg() : null,
            'request_payload' => $payload,
            'response_raw' => $response,
        ];

        if ($curlErrno) {
            Log::channel('gemini')->error('gemini-request-failed', $log);
            throw new \Exception('Curl error: ' . $curlError);
        }

        if ($httpCode >= 400) {
            Log::channel('gemini')->error('gemini-http-error', $log);
            throw new \Exception("Gemini HTTP Error {$httpCode}");
        }

        Log::channel('gemini')->info('gemini-request-success', $log);

        return $decodedResponse;
    }


    public function translate($text, $targetLanguage = 'es')
    {
        $userPrompt = "Translate this to $targetLanguage: \"$text\"";
        $systemPrompt = "You are a professional translator AI. Respond only with the translated sentence.";

        try {
            $response = $this->callAPI($userPrompt, $systemPrompt);
            if (isset($response['candidates'][0]['content']['parts'][0]['text'])) {
                return $response['candidates'][0]['content']['parts'][0]['text'];
            } else {
                throw new \Exception('Invalid Gemini response: ' . json_encode($response));
            }
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

}
