<?php
/**
 * Created by PhpStorm.
 * User: piripasa
 * Date: 24/1/18
 * Time: 5:25 PM
 */

namespace Piripasa\ArticleManager\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Piripasa\ArticleManager\Models\Article;

class ArticleRepository
{
    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function getArticles()
    {
        return $this->model->paginate(10);
    }

    public function getArticle($id)
    {
        return $this->model->findOrFail($id);
    }

    public function createArticle(Request $request)
    {
        DB::transaction(function () use ($request) {
            $article = $this->model->firstOrCreate($request->except(['_token', '_method', 'tags']));

            if ($request->tags) {
                $tags = is_array($request->tags) ? $request->tags : [$request->tags];
                $article->tags()->sync($tags);
            }

            return $article;
        });
    }

    public function updateArticle(Request $request, $id)
    {
        return $this->model->whereId($id)->update($request->except(['_token', '_method']));
    }

    public function deleteArticle($id)
    {
        return $this->model->destroy($id);
    }
}
