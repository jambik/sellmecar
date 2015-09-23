<?php

namespace App\Http\Controllers;

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
        $inquiries = Inquiry::with('car')->paginate(config('vars.inquiriesPerPage'));

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

        $this->validate($request, [
            'name' => 'required'
        ]);

        $item = Inquiry::create($request->all() + ['user_id' => $user->id]);
        $inquiry = Inquiry::with('car')->findOrFail($item->id);

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
        $inquiry = Inquiry::with('car')->findOrFail($id);
        $user = User::find($inquiry->user_id);

        if($request->ajax())
        {
            return response()->json([
                'inquiry' => $inquiry,
                'user' => $user
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
