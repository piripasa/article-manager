<?php

namespace Piripasa\ArticleManager\Controllers;

use App\Http\Controllers\Controller;
use Piripasa\ArticleManager\Repositories\TagRepository;
use Piripasa\ArticleManager\Requests\TagRequest;

class TagController extends Controller
{
    protected $respository;
    protected $data;

    public function __construct(TagRepository $tagRepository)
    {
        $this->respository = $tagRepository;
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
        $this->data['all'] = $this->respository->getTags();

        return view('artiman::tag.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artiman::tag.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        try {
            $this->respository->createTag($request);
            return redirect('tag')->with('message', 'Tag Created');
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
        return $this->respository->getTag($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['tag'] = $this->respository->getTag($id);

        return view('artiman::tag.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        try {
            $this->respository->updateTag($request, $id);
            return redirect('tag')->with('message', 'Tag Updated');
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
            $this->respository->deleteTag($id);
            return redirect('tag')->with('message', 'Tag Deleted');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
