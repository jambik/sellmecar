<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Metro;
use Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = Metro::with('city')->get();

        return view('admin.metro.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::lists('name', 'id')->all();

        return view('admin.metro.create', compact('cities'));
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

        $item = Metro::create($request->all());

        Flash::success("Запись - {$item->id} сохранена");

        return redirect(route('admin.metro.index'));
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
        $item = Metro::findOrFail($id);
        $cities = City::lists('name', 'id')->all();

        return view('admin.metro.edit', compact('item', 'cities'));
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

        $item = Metro::findOrFail($id);

        $item->update($request->all());

        Flash::success("Запись - {$id} обновлена");

        return redirect(route('admin.metro.index'));
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
        Metro::destroy($id);

        Flash::success("Запись - {$id} удалена");

        return redirect(route('admin.metro.index'));
    }
}
