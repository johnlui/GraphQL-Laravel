<?php

use Illuminate\Support\Facades\Route;
use GraphQL\Http\Controllers\GraphQLController;

Route::any(config('graphql.apiUri'), [GraphQLController::class, 'fire']);