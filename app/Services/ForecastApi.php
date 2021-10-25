<?php 
namespace App\Services;
use GuzzleHttp\Client;
class ForecastApi {
 
  public $api_key='';
  public $client;
  private $response_type = 'metric';
  private $apiUrl = '';
  private $cityName = '';
  private $state = '';
  private $country = '';
  public $response = '';

  public function __construct(){
    $this->client = new Client();
    $this->apiUrl = config('forecast.apiURL');
  }

  public function weatherUnits(String $type): Object {
    $this->response_type = $type;
    return $this;
  }

  public function city(string $name): Object {
    $this->cityName = $name;
    return $this;
  }

  public function stateAndCountry(array $name): Object {
    $this->state = $name['state'] ?? '';
    $this->country = $name['country'] ?? '';
    return $this;
  }

  private function makeUrl(string $name): String {
    $api_key = config('forecast.apiKey');
    return "$this->apiUrl$name?q=$this->cityName,$this->state,$this->country&units=$this->response_type&appid=$api_key";
  }

  public function weather(): Object {
    $this->response = $this->client->get($this->makeUrl('weather'));
    return $this;
  }
  public function forecast(): Object {
    $this->response = $this->client->get($this->makeUrl('forecast'));
    return $this;
  }

  public function result(){
    if ($this->response->getStatusCode() == 200) {
      return json_decode($this->response->getBody(), true);
    }
    return false;
  }
}