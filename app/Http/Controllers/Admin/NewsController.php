<?php

namespace App\Http\Controllers\Admin;

use App\News;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = News::orderBy('published_at', 'desc')->get();

        return view('admin.news.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $input = $request->all();
        $input['published_at'] = $input['published_at'] ?: Carbon::now();

        $item = News::create($input);

        $item->saveImage($item, $request);

        Flash::success("Запись - {$item->id} сохранена");

        return redirect(route('admin.news.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = News::findOrFail($id);

        return view('admin.news.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $item = News::findOrFail($id);

        $item->update($request->all());

        $item->saveImage($item, $request);

        Flash::success("Запись - {$id} обновлена");

        return redirect(route('admin.news.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        News::destroy($id);

        Flash::success("Запись - {$id} удалена");

        return redirect(route('admin.news.index'));
    }
}
