<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Requests\storeArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleUpdateResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function StoreArticle(storeArticleRequest $storeArticleRequest)
    {
            $article = Article::create($storeArticleRequest->all());
        if ($storeArticleRequest->hasFile('picture'))
        {
            $pictureUrl =   Storage::putFile('/article',$storeArticleRequest->picture);
            $article->update([
                'url_picture'=>$pictureUrl
            ]);
        }
        return response()->json([
            "message"=>"مقاله با موفقیت در سامانه درج گردید",
            "data"=>new storeArticleRequest($article)
        ],200);
        /*        Article::created([
        'title'=>$storeArticleRequest->title,
        'slug'=>$storeArticleRequest->slug,
        'author'=>$storeArticleRequest->aothor,
        'time_study'=>$storeArticleRequest->time_study,
        ]);*/
    }

    public function show($id)
    {
        $article = Article::find($id);
        if ($article == null){
            return response()->json(
              [
                  'message'=>"مقاله مورد نظر یافت نشد!",
              ]
            ,404);
        }
        else{
            return response()->json(
                [
                    "message"=>"مقاله مورد نظر یافت شد",
                    "data"=>new ArticleResource($article)
                ]
            );
        }
        /*return new ArticleResource($article);*/
    }

    public function showlist($perpage)
    {
        $articles = DB::table('articles')->simplePaginate(1);
        if ($articles == null){
            return response()->json(
                [
                    'message'=>"متاسفانه هنوز مقاله ای ایجاد نشده است",
                ]
                ,404);
        }
        else{
            return response()->json(
                [
                    "message"=>"لیت مقالات با موفقیت دریافت شد ",
                    "data"=> ArticleResource::collection($articles)
                ]
            );
        }
    }

    public function update(ArticleUpdateRequest $articleUpdateRequest , Article $article)
    {
        $article->update($articleUpdateRequest->all());
        return response()->json([
            "message" => "اطلاعات مقاله موردنظر با موفقیت بروز رسانی شد",
            "data" => new ArticleUpdateResource($article)
        ], 200);
    }

    public function delete(Article $article)
    {
        $article->delete();
        return response()->json([
            "message" => "مقاله موردنظر حذف شد",
        ], 200);
    }
}
