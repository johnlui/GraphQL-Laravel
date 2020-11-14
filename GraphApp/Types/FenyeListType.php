<?php

namespace App\GraphApp\Types;

use GraphQL\Type\Definition\Type;

class FenyeListType extends BaseType
{
  public function __construct($obj)
  {
    if(!$obj){
      \App\GraphApp\AppContext::apiResponse(-1002, '使用[FenyeListType]必须传入初始化参数(列表内部的数据类型)');
    }
    if(!($obj instanceof BaseType)){
      \App\GraphApp\AppContext::apiResponse(-1001, '['.(string)$obj.']必须是BaseType的子类');
    }
    $config = [
      'description' => '分页类型数据',
      'name' => 'FenyeList'. str_replace('\\', '_', get_class( $obj )),
      'fields' => function()use($obj) {
        return [
          'message' => [
            'description' => '其他数据',
            'type' => Type::string(),
          ],
          'current_page' => [
            'description' => '当前页数',
            'type' => Type::int(),
          ],
          'per_page' => [
            'description' => '每页数据条数',
            'type' => Type::int(),
          ],
          'last_page' => [
            'description' => '总页数',
            'type' => Type::int(),
          ],
          'total' => [
            'description' => '总数据条数',
            'type' => Type::int(),
          ],
          'data' => [
            'description' => '数据列表',
            'type' => Type::listOf($obj),
          ],
        ];
      },
    ];
    parent::__construct($config);
  }
}
