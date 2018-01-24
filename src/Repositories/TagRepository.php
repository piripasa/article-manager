<?php
/**
 * Created by PhpStorm.
 * User: piripasa
 * Date: 24/1/18
 * Time: 5:25 PM
 */

namespace Piripasa\ArticleManager\Repositories;

use Illuminate\Http\Request;
use Piripasa\ArticleManager\Models\Tag;

class TagRepository
{
    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    public function getTags()
    {
        return $this->model->paginate(10);
    }

    public function getTag($id)
    {
        return $this->model->findOrFail($id);
    }

    public function createTag(Request $request)
    {
        return $this->model->firstOrCreate($request->except(['_token', '_method']));
    }

    public function updateTag(Request $request, $id)
    {
        return $this->model->whereId($id)->update($request->except(['_token', '_method']));
    }

    public function deleteTag($id)
    {
        return $this->model->destroy($id);
    }
}
