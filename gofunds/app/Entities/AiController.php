<?php

namespace App\Entities;

use GuzzleHttp\Client;

class AiController
{

    public function __construct($prompt, $max_tokens) 
    {
        $this->prompt = $prompt;
        $this->max_tokens = $max_tokens;
        
    }

    public function sendRequest() {
        $client = new Client();
        $response = $client->post('https://api.openai.com/v1/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer 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',
            ],
            'json' => [
                'prompt' => $this->prompt,
                'max_tokens' => $this->max_tokens,
                'model' => 'text-davinci-003',
            ],
        ]);

        $body = $response->getBody();
        $completions = json_decode($body, true);
        $completed_text = $completions['choices'][0]['text'];
        return $completed_text;
    }
}
