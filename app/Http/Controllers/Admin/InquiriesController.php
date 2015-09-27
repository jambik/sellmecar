<?php

namespace App\Http\Controllers\Admin;

use App\Car;
use App\City;
use App\Inquiry;
use Flash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = Inquiry::with('car', 'city')->orderBy('created_at', 'desc')->get();

        return view('admin.inquiries.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cars = Car::lists('name', 'id')->all();
        $cities = City::lists('name', 'id')->all();

        return view('admin.inquiries.create', compact('cars', 'cities'));
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

        $item = Inquiry::create($request->all());

        Flash::success("Запись - {$item->id} сохранена");

        return redirect(route('admin.inquiries.index'));
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
        $item = Inquiry::findOrFail($id);
        $cars = Car::lists('name', 'id')->all();
        $cities = City::lists('name', 'id')->all();

        return view('admin.inquiries.edit', compact('item', 'cars', 'cities'));
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

        $item = Inquiry::findOrFail($id);

        $item->update($request->all());

        Flash::success("Запись - {$id} обновлена");

        return redirect(route('admin.inquiries.index'));
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
        Inquiry::destroy($id);

        Flash::success("Запись - {$id} удалена");

        return redirect(route('admin.inquiries.index'));
    }
}
