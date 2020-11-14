<?php

namespace App\GraphApp\Types;

use GraphQL\Type\Definition\Type;

class FooType extends BaseType
{
  public function __construct($obj)
  {
    $config = [
      'description' => '自定义 Type 示例',
      'name' => 'FooType',
      'fields' => function() {
        return [
          'id' => [
            'description' => 'ID',
            'type' => Type::int(),
          ],
          'foo' => [
            'description' => 'foo',
            'type' => Type::string(),
          ],
          'bar' => [
            'description' => 'bar',
            'type' => Type::string(),
          ],
        ];
      },
    ];
    parent::__construct($config);
  }
}
