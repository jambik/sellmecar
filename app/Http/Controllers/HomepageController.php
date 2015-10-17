<?php

namespace App\Http\Controllers;

use App\Car;
use App\Carinfo;
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
        $cars = Car::with('inquiriesCount')->orderBy('domestic', 'asc')->orderBy('name')->get();
        $cars1 = $cars->filter(function ($item) { return $item->name == "ВАЗ"; });
        $cars2 = $cars->filter(function ($item) { return $item->name != "ВАЗ"; });
        $cars = $cars1->merge($cars2);
        $carsList = $cars->lists('name', 'id')->toArray();

        $lastInquiries = Inquiry::with('car', 'city')->paginate(config('vars.inquiries_per_page'));
        $lastInquiries->setPath('inquiry/index');

        Carbon::setLocale(config('app.locale'));
        $lastNews = News::paginate(config('vars.news_per_page'));
        $lastNews->setPath('news/index');

        $cities = City::lists('name', 'id')->all();

        return view('homepage', compact('user', 'cars', 'carsList', 'lastInquiries', 'lastNews', 'cities'));
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

    public function vars(Request $request)
    {
        return config('vars');
    }
}
