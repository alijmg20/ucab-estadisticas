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

    public function completePrompt($prompt, $history = [])
    {
        // dd($history);
        // assistant
        $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => $history,
                'temperature' => 0.5,
                'max_tokens' => 200,
        ])->json();
    
        return response()->json($response['choices'][0]['message']['content']);
    }
}