<?php
/**
 * Created by PhpStorm.
 * User: piripasa
 * Date: 24/1/18
 * Time: 11:55 AM
 */

namespace Piripasa\ArticleManager\Repositories;

use Illuminate\Http\Request;
use Piripasa\ArticleManager\Models\Category;

class CategoryRepository
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getCategories()
    {
        return $this->model->paginate(10);
    }

    public function getCategory($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getCategoriesForSelect()
    {
        return $this->model->pluck('name', 'id')->toArray();
    }

    public function createCategory(Request $request)
    {
        return $this->model->firstOrCreate($request->except(['_token', '_method']));
    }

    public function updateCategory(Request $request, $id)
    {
        return $this->model->whereId($id)->update($request->except(['_token', '_method']));
    }

    public function deleteCategory($id)
    {
        return $this->model->destroy($id);
    }
}
