<?php

namespace Piripasa\ArticleManager\Controllers;

use App\Http\Controllers\Controller;
use Piripasa\ArticleManager\Repositories\ArticleRepository;
use Piripasa\ArticleManager\Repositories\CategoryRepository;
use Piripasa\ArticleManager\Repositories\TagRepository;
use Piripasa\ArticleManager\Requests\ArticleRequest;

class ArticleController extends Controller
{
    protected $respository;
    protected $categoryRespository;
    protected $tagRespository;
    protected $data;

    public function __construct(ArticleRepository $articleRepository, CategoryRepository $categoryRepository, TagRepository $tagRepository)
    {
        $this->respository = $articleRepository;
        $this->categoryRespository = $categoryRepository;
        $this->tagRespository = $tagRepository;
        $this->data = [

        ];
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['all'] = $this->respository->getArticles();

        return view('artiman::article.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['categories'] = $this->categoryRespository->getCategoriesForSelect();
        $this->data['tags'] = $this->tagRespository->getTagsForSelect();

        return view('artiman::article.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        try {
            $this->respository->createArticle($request);
            return redirect('article')->with('message', 'Article Created');
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
        return $this->respository->getArticle($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['article'] = $this->respository->getArticle($id);

        return view('artiman::article.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        try {
            $this->respository->updateArticle($request, $id);
            return redirect('article')->with('message', 'Article Updated');
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
            $this->respository->deleteArticle($id);
            return redirect('article')->with('message', 'Article Deleted');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
