<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\StoreNewsRequest;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.index', [
            'title' => 'News',
            'news'  => News::latest()->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create', [
            'title' => 'Add new News',
            'categories' => Category::all()
        ]);
    }


    public function store(StoreNewsRequest $request)
    {
        return $request->persist();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin.news.show', [
            'title' => "Show {$news->title}",
            'news'  => $news->load('creator', 'category'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        News::removeFiles($news);

        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'News has removed successfully');
    }
}
