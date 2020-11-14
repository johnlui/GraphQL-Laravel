<?php

use Illuminate\Support\Facades\Route;
use GraphQL\Http\Controllers\GraphQLController;

Route::any('graphql', [GraphQLController::class, 'fire']);