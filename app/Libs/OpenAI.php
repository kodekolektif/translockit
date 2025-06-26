<?php
namespace App\Libs;

use App\Settings\AppSettings;

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
        $parts = [];

        if ($systemPrompt) {
            // Add system prompt first
            $parts[] = ['role' => 'system', 'content' => $systemPrompt];
        }

        // Then add user prompt
        $parts[] = ['role' => 'user', 'content' => $userPrompt];

        $data = [
            'model' => $this->model,
            'messages' => $parts,
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
        ];

        $ch = curl_init($this->apiUrl);
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
        $systemPrompt = "You are a professional translator AI. Translate only the text content, without altering the HTML tags or structure. Keep all punctuation, formatting, and HTML tag names exactly the same as in the input. Respond only with the translated result.";
        $response = $this->callAPI($userPrompt, $systemPrompt);

        if (isset($response['choices'][0]['message']['content'])) {
            return $response['choices'][0]['message']['content'];
        } else {
            throw new \Exception('Translation failed: ' . json_encode($response));
        }
    }
}
