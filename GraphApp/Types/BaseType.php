<?php


namespace App\GraphApp\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class BaseType extends ObjectType
{
  public static $instances = [];

  // 多个资源中同时使用相同类型,因为name必须唯一,所以不能new多个相同类型
  public static function getInstance($obj = null)
  {
    $name = (string) new static($obj);
    // 分页类型拼接上里面的type名字
    $name = $name.(string)$obj;

    if(array_key_exists($name, static::$instances)){
      return static::$instances[$name];
    }

    $instance = new static($obj);
    static::$instances[$name] = $instance;
    return $instance;
  }

}
