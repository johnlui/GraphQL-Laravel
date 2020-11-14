<?php

namespace App\GraphApp;

class AppContext
{
  public $rootUrl;
  public $viewer;
  public $request;

  public static function apiResponse($status = 0 , $message = '' , $data='')
  {
    $returnArray = ['status' => $status, 'message'=>$message ,'values' => $data];
    if ( is_array($data) && ( array_key_exists('__schema', $data) || array_key_exists('__type', $data) ) ) {
      $returnArray['data'] = $data;
    }
    throw new \App\GraphApp\Exceptions\ApiResponseException('$context->apiResponse() 提前调用', response()->json($returnArray, 200, [], JSON_UNESCAPED_UNICODE));
  }
}
