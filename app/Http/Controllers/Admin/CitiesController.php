<?php

namespace App\Http\Controllers\Admin;

use App\City;
use Flash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = City::all();

        return view('admin.cities.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        $item = City::create($request->all());

        Flash::success("Запись - {$item->id} сохранена");

        return redirect(route('admin.cities.index'));
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
        $item = City::findOrFail($id);

        return view('admin.cities.edit', compact('item'));
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
        $this->validate($request, ['name' => 'required']);

        $item = City::findOrFail($id);

        $item->update($request->all());

        Flash::success("Запись - {$id} обновлена");

        return redirect(route('admin.cities.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     * @internal param Request $request
     */
    public function destroy($id)
    {
        City::destroy($id);

        Flash::success("Запись - {$id} удалена");

        return redirect(route('admin.cities.index'));
    }
}
