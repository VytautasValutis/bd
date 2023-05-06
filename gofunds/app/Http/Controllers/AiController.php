<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AiController extends Controller
{
    public function sendRequest() {
        $client = new Client();
        $response = $client->post('https://api.openai.com/v1/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer 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',
            ],
            'json' => [
                'prompt' => 'Object oriented programming is',
                'max_tokens' => 7,
                'model' => 'text-davinci-003',
            ],
        ]);

        $body = $response->getBody();
        $completions = json_decode($body, true);
        $completed_text = $completions['choices'][0]['text'];
        return $completed_text;
    }
}
