<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class SentimentAnalyzer
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'http://text-processing.com';
    }

    public function analyzeText($text)
    {
        $url = 'http://text-processing.com/api/sentiment/';
        $data = http_build_query(['text' => $text]);

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => $data,
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            return null; // Error handling
        }

        return json_decode($response, true);
    }
}
