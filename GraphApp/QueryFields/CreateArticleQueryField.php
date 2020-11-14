<?php

namespace App\GraphApp\QueryFields;

use GraphQL\Type\Definition\Type;
use App\GraphApp\AppContext;

use App\GraphApp\Models\Article;

class CreateArticleQueryField
{
  public function export()
  {
    return [
      'type' => Type::int(),
      'args' => [
        'data' => [
          'type' => Type::nonNull(Type::int()),
          'defaultValue' => 0,
        ]
      ],
      'resolve' => function ($root, $args, AppContext $context) {
        // $article = new Article;
        // $article->title = $args['data']['title'];
        // $article->content = $args['data']['content'];
        // $article->save();

        return 0;
      }
    ];
  }
}