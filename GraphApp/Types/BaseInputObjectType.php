<?php


namespace App\GraphApp\Types;


use GraphQL\Type\Definition\InputObjectType;

class BaseInputObjectType extends InputObjectType
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

  public static function validate($data)
  {
    $obj = static::getInstance();
    foreach ($obj->getFields() as $field) {
      if(isset($field->validate) && isset($data[$field->name])){
        call_user_func($field->validate, $data[$field->name]);
      }
    }
  }

  public static function defaultValue()
  {
    $values = [];
    $obj = static::getInstance();
    foreach ($obj->getFields() as $key => $field) {
      $values[$key] = $field->defaultValue;
    }
    return $values;
  }
}
