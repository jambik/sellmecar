<?php

namespace App\Http\Controllers;

use App\Carinfo;
use App\Inquiry;
use App\User;
use Auth;
use Flash;
use Illuminate\Http\Request;
use App\Http\Requests;

class InquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $inquiries = Inquiry::with('car', 'city')->paginate(config('vars.inquiries_per_page'));

        return response()->json($inquiries);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function privateIndex()
    {
        $inquiries = Inquiry::with('car')->byUser(Auth::user()->id)->get();

        return response()->json(["inquiries" => $inquiries]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function search(Request $request)
    {
        $inquiries = Inquiry::query();

        $search['car_id']      = $request->has('car_id') ? $request->get('car_id') : false;
        $search['model']       = $request->get('model');
        $search['year_from']   = $request->get('year_from');
        $search['year_to']     = $request->get('year_to');
        $search['city_id']     = $request->get('city_id');
        $search['metro']       = $request->has('metro') && $request->get('metro') ? $request->get('metro') : false;
        $search['search_info'] = $request->get('search_info');

        if ($search['car_id'])    foreach($search['car_id'] as $key => $value) if ( ! $value) unset($search['car_id'][$key]);
        if ($search['car_id'])    $inquiries->whereIn('car_id', $search['car_id']);
        if ($search['model'])     $inquiries->where('model', $search['model']);
        if ($search['year_from']) $inquiries->where('year_from', '>=', $search['year_from']);
        if ($search['year_to'])   $inquiries->where('year_to', '<=', $search['year_to']);
        if ($search['city_id'])   $inquiries->where('city_id', $search['city_id']);
        if ($search['metro'])     $inquiries->where('metro', $search['metro']);

        if ($search['search_info'])
        {
            // Расширенный поиск
            $capacity = config('vars.car_info.capacity');

            $searchMore['price_from'] = $request->get('price_from') ?: false;
            $searchMore['price_to'] = $request->get('price_to') ?: false;
            $searchMore['gear'] = $request->get('gear') ?: false;
            $searchMore['transmission'] = $request->get('transmission') ?: false;
            $searchMore['engine'] = $request->get('engine') ?: false;
            $searchMore['rudder'] = $request->get('rudder') ?: false;
            $searchMore['color'] = $request->get('color') ?: false;
            $searchMore['run'] = $request->get('run') ?: false;
            $searchMore['capacity_from'] = $request->get('capacity_from') ? $capacity[$request->get('capacity_from')] : false;
            $searchMore['capacity_to'] = $request->get('capacity_to') ? $capacity[$request->get('capacity_to')] : false;
            $searchMore['state'] = $request->get('state') ?: false;
            $searchMore['owners'] = $request->get('owners') ?: false;

            if ($searchMore['price_from']) $inquiries->where('price_from', '>=', $searchMore['price_from']);
            if ($searchMore['price_to']) $inquiries->where('price_to', '<=', $searchMore['price_to']);
            if ($searchMore['gear']) $inquiries->where('gear', $searchMore['gear']);
            if ($searchMore['transmission']) $inquiries->where('transmission', $searchMore['transmission']);
            if ($searchMore['engine']) $inquiries->where('engine', $searchMore['engine']);
            if ($searchMore['rudder']) $inquiries->where('rudder', $searchMore['rudder']);
            if ($searchMore['color']) $inquiries->where('color', $searchMore['color']);
            if ($searchMore['run']) $inquiries->where('run', '<=', $searchMore['run']);
            if ($searchMore['capacity_from']) $inquiries->where('capacity_from', '>=', $searchMore['capacity_from']);
            if ($searchMore['capacity_to']) $inquiries->where('capacity_to', '<=', $searchMore['capacity_to']);
            if ($searchMore['state']) $inquiries->where('state', '>=', $searchMore['state']);
            if ($searchMore['owners']) $inquiries->where('owners', '>=', $searchMore['owners']);
        }

        $searchResult['found'] = $inquiries->with('car', 'user', 'city')->get();
        $searchResult['suggest'] = [];

        if($request->ajax())
        {
            return response()->json($searchResult);
        }

        return $searchResult;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $this->validate($request,
            [
                'car_id' => 'required',
                'city_id' => 'required',
                'name' => 'required',
                'phone' => 'required|min:7',
            ],
            [
                'car_id.required' => 'Выберите марку автомобиля',
                'city_id.required' => 'Выберите город',
                'name.required' => 'Укажите свое имя',
                'phone.required' => 'Укажите свой номер телефона',
                'phone.min' => 'Укажите свой номер телефона',
            ]
        );

        $item = Inquiry::create($request->all() + ['user_id' => $user->id]);

        if ($request->has('carinfo'))
        {
            $carinfoFilled = false;
            foreach($request->get('carinfo') as $value) if ($value) { $carinfoFilled = true; break; }
            if ($carinfoFilled) Carinfo::create($request->get('carinfo') + ['inquiry_id' => $item->id]);
        }

        $inquiry = Inquiry::with('car', 'carinfo', 'city')->findOrFail($item->id);

        if($request->ajax())
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Объявление сохранено',
                'inquiry' => $inquiry
            ]);
        }

        Flash::success("Запись - {$inquiry->id} сохранена");
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function show($id, Request $request)
    {
        $inquiry = Inquiry::with('car', 'carinfo', 'city', 'user')->findOrFail($id);

        if($request->ajax())
        {
            return response()->json([
                'inquiry' => $inquiry
            ]);
        }

        return $inquiry;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        Inquiry::destroy($id);

        if($request->ajax())
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Объявление удалено'
            ]);
        }

        Flash::success("Запись #{$id} удалена");
        return redirect()->back();
    }
}
