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
                'prompt' => 'short story up to 20 words about grizzly',
                'max_tokens' => 20,
                'model' => 'text-davinci-003',
            ],
        ]);

        $body = $response->getBody();
        $completions = json_decode($body, true);
        $completed_text = $completions['choices'][0]['text'];
        return $completed_text;
    }
}
