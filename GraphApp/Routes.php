<?php

namespace App\GraphApp;

class Routes
{
  public static function queries()
  {
    return [
      'foo' => \App\GraphApp\QueryFields\FooQueryField::class,
    ];
  }
  public static function mutations()
  {
    return [
      'createArticle' => \App\GraphApp\QueryFields\CreateArticleQueryField::class,
    ];
  }
}
