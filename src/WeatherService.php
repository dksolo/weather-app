<?php 

namespace Dksolo\WeatherApp;
use GuzzleHttp\Client;

class WeatherService
{
    private Client $client;
    private string $apiKey;
    private string $apiUrl;

    public function __construct() {
        $this->client = new Client();
        $this->apiKey = $_ENV['API_KEY'];
        $this->apiUrl = $_ENV['API_URL'];
    }

    public function getWeather(string $city): array
    {
        $response = $this->client->get($this->apiUrl, [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric',
            ]
        ]);

        $weatherData = json_decode($response->getBody()->getContents(), true);

        return [
            'city' => $weatherData['name'],
            'temperature' => $weatherData['main']['temp'],
            'weather' => $weatherData['weather'][0]['description'],
            'humidity' => $weatherData['main']['humidity']
        ];
    }
}