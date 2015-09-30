<?php

namespace App\Http\Controllers\Admin;

use App\Car;
use App\Carmodel;
use Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarmodelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = Carmodel::with('car')->get();

        return view('admin.carmodels.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cars = Car::orderBy('name')->get()->lists('name', 'id')->all();

        return view('admin.carmodels.create', compact('cars'));
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
            'name' => 'required',
            'car_id' => 'required'
        ]);

        $item = Carmodel::create($request->all());

        Flash::success("Запись - {$item->id} сохранена");

        return redirect(route('admin.carmodels.index'));
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
        $item = Carmodel::findOrFail($id);
        $cars = Car::orderBy('name')->get()->lists('name', 'id')->all();

        return view('admin.carmodels.edit', compact('item', 'cars'));
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
            'name' => 'required',
            'car_id' => 'required'
        ]);

        $item = Carmodel::findOrFail($id);

        $item->update($request->all());

        Flash::success("Запись - {$id} обновлена");

        return redirect(route('admin.carmodels.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Carmodel::destroy($id);

        Flash::success("Запись - {$id} удалена");

        return redirect(route('admin.carmodels.index'));
    }
}
