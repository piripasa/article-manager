<?php

namespace Piripasa\ArticleManager\Controllers;

use App\Http\Controllers\Controller;
use Piripasa\ArticleManager\Repositories\CategoryRepository;
use Piripasa\ArticleManager\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $respository;
    protected $data;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->respository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['all'] = $this->respository->getCategories();

        return view('article-manager::category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['categories'] = $this->respository->getCategoriesForSelect();

        return view('article-manager::category.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        try {
            $this->respository->createCategory($request);
            return redirect('category')->with('message', 'Category Created');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->respository->getCategory($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['category'] = $this->respository->getCategory($id);
        $this->data['categories'] = $this->respository->getCategoriesForSelect();

        return view('article-manager::category.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $this->respository->updateCategory($request, $id);
            return redirect('category')->with('message', 'Category Updated');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->respository->deleteCategory($id);
            return redirect('category')->with('message', 'Category Deleted');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
