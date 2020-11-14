<?php

namespace GraphQL\Http\Controllers;

use Illuminate\Http\Request;

use App\GraphApp\AppContext;
use App\GraphApp\AppObjectType;
use App\GraphApp\Routes;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Error\FormattedError;
use GraphQL\Error\DebugFlag;
use GraphQL\Validator\Rules\DisableIntrospection;
use GraphQL\Validator\DocumentValidator;

/**
 * GraphQLController
 */
class GraphQLController extends Controller
{

  private $exceptionsShouldThrow = [
    \App\GraphApp\Exceptions\ApiResponseException::class,
  ];

  public function fire(Request $request)
  {
    $debug = DebugFlag::NONE;
    if (config('app.debug')) {
      \DB::connection()->enableQueryLog();
      $debug = DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE;
    } else {
      DocumentValidator::addRule(new DisableIntrospection());
    }

    $returnMessage = '';

    $appContext = new AppContext();
    $appContext->rootUrl = $request->fullUrl();
    $appContext->request = $_REQUEST;

    $data = $request->all();
    $data += ['query' => null, 'variables' => null];

    $schema = new Schema([
      'query' => AppObjectType::query(Routes::queries()),
      'mutation' => AppObjectType::mutation(Routes::mutations()),
    ]);
    $result = GraphQL::executeQuery(
      $schema,
      $data['query'],
      null,
      $appContext,
      (array) $data['variables']
    );

    $errorHandler = function(array $errors, callable $formatter) use ($debug) {
      $error = $errors[0];
      if ( in_array(get_class($error), $this->exceptionsShouldThrow) ) {
        throw $error;
      }
      if ($error instanceof \ErrorException) {
        throw $error;
      }
      return FormattedError::createFromException($error, $debug);
    };
    $resultArray = $result->setErrorsHandler($errorHandler)->toArray($debug);
    $returnStatus = 0;
    $returnMessage = 'OK';

    $output = [];
    if (array_key_exists('data', $resultArray)) {
      $output = $resultArray['data'];
    }
    if (array_key_exists('extensions', $resultArray)) {
      $output['extensions'] = $resultArray['extensions'];
    }
    if (array_key_exists('errors', $resultArray)) {
      $output['errors'] = $resultArray['errors'];
      $returnStatus = -1;
      if(isset($resultArray['errors']['debugMessage'])){
        $returnMessage = $resultArray['errors']['debugMessage'];
      } else {
        $returnMessage = 'Error';
      }
    }

    if ($debug) {
      $output['queries'] = \DB::getQueryLog();
    }

    return $this->apiResponse($returnStatus, $returnMessage, $output);
  }
}