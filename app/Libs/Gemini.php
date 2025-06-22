<?php
namespace App\Libs;

use App\Settings\AppSettings;

class Gemini
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
            // Add system prompt first
            $parts[] = ['text' => $systemPrompt];
        }

        // Then add user prompt
        $parts[] = ['text' => $userPrompt];

        $data = [
            'contents' => [
                [
                    'role' => 'user', // optional, can be omitted
                    'parts' => $parts
                ]
            ]
        ];

        $headers = [
            'Content-Type: application/json',
        ];

        $url = $this->apiUrl . '?key=' . $this->apiKey;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }
        curl_close($ch);

        return json_decode($response, true);
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
