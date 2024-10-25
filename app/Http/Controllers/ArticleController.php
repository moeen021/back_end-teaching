<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function storeArticle(storeArticleRequest $storeArticleRequest)
    {
        Article::create($storeArticleRequest->all());
    }
}
