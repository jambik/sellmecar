<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use DB;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class AdministratorsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = DB::table('users')
                    ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                    ->whereNotNull('role_user.role_id')
                    ->get();

        return view('admin.administrators.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.administrators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $emailRule = $request->input('email') ? 'required|email|max:255|unique:users' : '';
        $passwordRule = $request->input('password') ? 'required|min:6' : '';

        $this->validate($request, [
            'name' => 'required',
            'email' => $emailRule,
            'password' => $passwordRule
        ]);

        $item = User::create($request->all());
        $item->password = $passwordRule ? bcrypt($request->input('password')) : "";
        $item->save();

        $adminRole = Role::where('name', 'admin')->first();
        $item->attachRole($adminRole);

        Flash::success("Запись - {$item->id} сохранена");
        return redirect(route('admin.administrators.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $item = User::findOrFail($id);
        $item->password = '';

        return view('admin.administrators.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $emailRule = $request->input('email') ? 'required|email|max:255|unique:users,email,' . $id : '';
        $passwordRule = $request->input('password') ? 'required|min:6' : '';

        $this->validate($request, [
            'name' => 'required',
            'email' => $emailRule,
            'password' => $passwordRule
        ]);

        $item = User::findOrFail($id);

        $item->update($request->except('password') +
            ($passwordRule ? ['password' => bcrypt($request->input('password'))] : []));

        Flash::success("Запись - {$id} обновлена");
        return redirect(route('admin.administrators.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        Flash::success("Запись - {$id} удалена");
        return redirect(route('admin.administrators.index'));
    }

}
