<?php

namespace App\GraphApp\QueryFields;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use App\GraphApp\TypeRegistry;
use App\GraphApp\AppContext;

class FooQueryField
{
  public function export()
  {
    return [
      'description' => '客户信息',
      'type' => \App\GraphApp\Types\FooType::getInstance(),
      'args' => [
        'id' => [
          'type' => Type::int(),
          'description' => 'Foo id',
        ],
      ],
      'resolve' => function ($root, $args, AppContext $context) {
        if(!isset($args['id'])){
          \App\GraphApp\AppContext::apiResponse(4, '[id]字段为必填项');
        }
        return [
          'id' => $args['id'],
          'foo' => 'foo',
          'bar' => 'bar',
        ];
      }
    ];
  }
}

