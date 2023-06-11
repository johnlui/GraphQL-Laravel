<?php

namespace GraphQL;

use App\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Redis;
use Request;
use Throwable;

class Handler extends ExceptionHandler
{

  /**
   * A list of the inputs that are never flashed for validation exceptions.
   *
   * @var array
   */
  protected $dontFlash = [
    'password',
    'password_confirmation',
  ];

  /**
   * Add one exception to the list of the exception types that are not reported.
   *
   * @var array
   */
  public function register()
  {
    $this->dontReport[] = \App\GraphApp\Exceptions\ApiResponseException::class;
  }

  /**
   * Report or log an exception.
   *
   * @param  \Throwable  $exception
   * @return void
   *
   * @throws \Exception
   */
  public function report(Throwable $exception)
  {
    if ($exception instanceof \App\GraphApp\Exceptions\ApiResponseException) {
      return;
    }
    parent::report($exception);
  }

  /**
   * Render an exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Throwable  $exception
   * @return \Symfony\Component\HttpFoundation\Response
   *
   * @throws \Throwable
   */
  public function render($request, Throwable $exception)
  {
    if ($exception instanceof \App\GraphApp\Exceptions\ApiResponseException) {
      return $exception->getData();
    }
    if ($exception instanceof \GraphQL\Error\Error) {
      return cc($exception);
    }
    return parent::render($request, $exception);
  }
}
