<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class OpenAIApi
{
    protected $client;

    public function __construct()
    {
        $this->client = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ]);
    }

    public function completePrompt($history = [])
    {
        // dd($history);
        // assistant
        $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => $history,
                'temperature' => 0.5,
                'max_tokens' => 200,
                'top_p' => 1.0,
                'frequency_penalty' => 0.52,
                'presence_penalty' => 0.5,
                'stop' => ['11.'],

        ])->json();
    
        return response()->json($response['choices'][0]['message']['content']);
    }
}