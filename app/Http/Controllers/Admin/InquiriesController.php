<?php

namespace App\Http\Controllers\Admin;

use App\Car;
use App\Carinfo;
use App\City;
use App\Inquiry;
use Carbon\Carbon;
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
        $items = Inquiry::with('car', 'city', 'carinfo')->orderBy('created_at', 'desc')->get();

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
        foreach (config('vars.car_info.color') as $key => $value) $colors[$key] = $value['name'];

        return view('admin.inquiries.create', compact('cars', 'cities', 'colors'));
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
            'name' => 'required'
        ]);

        $item = Inquiry::create($request->all());

        if ($request->has('carinfo'))
        {
            $carinfoFilled = false;
            foreach($request->get('carinfo') as $value) if ($value) { $carinfoFilled = true; break; }
            if ($carinfoFilled)
            {
                $carinfo = new Carinfo;
                $carinfo->fill($request->get('carinfo'));
                $item->carinfo()->save($carinfo);
            }
        }

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
        return Inquiry::with('city', 'car', 'user', 'carinfo')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = Inquiry::with('carinfo')->findOrFail($id);
        $cars = Car::lists('name', 'id')->all();
        $cities = City::lists('name', 'id')->all();
        foreach (config('vars.car_info.color') as $key => $value) $colors[$key] = $value['name'];

        return view('admin.inquiries.edit', compact('item', 'cars', 'cities', 'colors'));
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
            'name' => 'required'
        ]);

        $item = Inquiry::findOrFail($id);

        $item->update($request->all());

        if ($request->has('carinfo'))
        {
            $carinfoFilled = false;
            foreach($request->get('carinfo') as $value) if ($value) { $carinfoFilled = true; break; }
            if ($carinfoFilled)
            {
                $carinfo = Carinfo::where('inquiry_id', $id)->first() ?: new Carinfo;
                $carinfo->fill($request->get('carinfo'));
                $item->carinfo()->save($carinfo);
            }
            else
            {
                $item->carinfo()->delete();
            }
        }

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
