#!/usr/bin/env php
<?php

use Dotenv\Dotenv;
use Dksolo\WeatherApp\WeatherService;

require_once __DIR__ . '/vendor/autoload.php';

if ($argc < 2 ) {
    echo "Please provide more arguments! \n";
    echo "Correct usage:\nphp weather.php city ";
    exit(1);
}


$dotenv = Dotenv::createImmutable(__DIR__); 
$dotenv->load();
$dotenv->required(['API_KEY', 'API_URL'])->notEmpty(); 


$weatherService = new WeatherService();

echo "Running {$argv[0]} \n";
$city = $argv[1];
echo "Getting the weather for {$city} ... \n";
$weather = $weatherService->getWeather($city);

echo "\n";
echo "City: {$weather['city']} \n";
echo "Temperature: {$weather['temperature']} \n";
echo "Weather : {$weather['weather']} \n";
echo "Humidity: {$weather['humidity']} \n";