<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings;
use Flash;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::findOrNew(1);

        if( ! $settings->id)
        {
            $settings->email = 'jambik@gmail.com';
            $settings->description = 'Описание сайта';
        }

        return view('admin.settings.index', compact('settings'));
    }

    public function save(Request $request)
    {
        $settings = Settings::findOrNew(1);
        $settings->id = 1;
        $settings->fill($request->all());
        //dd($settings);
        $settings->save();

        Flash::success("Настройки сохранены ");
        return redirect(route('admin.settings'));
    }
}