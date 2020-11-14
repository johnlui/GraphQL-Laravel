<?php

namespace GraphQL\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Base Controller
 */
class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  
  public function apiResponse($status = 0 , $message = 'success' , $data = null)
  {
    $returnArray = ['status' => $status, 'message'=>$message ,'values' => $data];
    if ( is_array($data) && ( array_key_exists('__schema', $data) || array_key_exists('__type', $data) ) ) {
      $returnArray['data'] = $data;
    }
    return response()->json($returnArray, 200, [], JSON_UNESCAPED_UNICODE);
  }
}