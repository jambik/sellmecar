<?php

namespace App\Http\Controllers;

use App\Car;
use App\City;
use App\Inquiry;
use App\News;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function homepage()
    {
        $user = Auth::user() ?: false;
        $cars = Car::with('inquiriesCount')->get();
        $carsList = Car::all()->lists('name', 'id')->toArray();
        $carBrandsShow = 18;

        $lastInquiries = Inquiry::paginate(config('vars.inquiriesPerPage'));
        $lastInquiries->setPath('inquiry/index');

        Carbon::setLocale(config('app.locale'));
        $lastNews = News::paginate(config('vars.newsPerPage'));
        $lastNews->setPath('news/index');

        $cities = City::lists('name', 'name')->all();

        return view('homepage', compact('user', 'cars', 'carsList', 'carBrandsShow', 'lastInquiries', 'lastNews', 'cities'));
    }

    public function profile(Request $request)
    {
        if($request->ajax())
        {
            return response()->json(['user' => Auth::user()]);
        }

        return;
    }

    public function profileSave(Request $request)
    {
        $user = Auth::user();

        $user->name  = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->save();

        if($request->ajax())
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Профиль сохранён'
            ]);
        }

        Flash::success("Профиль сохранён");
        return redirect('/');
    }
}
