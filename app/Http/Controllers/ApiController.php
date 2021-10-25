<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
  private $http_code = 200;
  private $message = '';

  public function code(int $http_code) : object {
    $this->http_code = $http_code;   
    return $this;
  }
  public function message(string $message): object {
    $this->message = $message;   
    return $this;
  }
  public function response(array $data): array {
    return [
      'success' =>  $this->http_code >= 200 && $this->http_code <= 299 ? true : false,
      'message' => $this->message,
      'data' => $data,
      'code' => $this->http_code
    ];
  }
  public function json(array $data = []): JsonResponse {
      return new JsonResponse($this->response($data), $this->http_code); 
  }
}