<?php

namespace App\Http\Controllers;

use App\Block;
use App\Car;
use App\City;
use App\Faq;
use App\Inquiry;
use App\News;
use App\Settings;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Mail;
use ReCaptcha\ReCaptcha;
use Validator;

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

        $blocks = Block::all()->keyBy('alias');
        $faq = Faq::all();

        return view('homepage', compact('user', 'cars', 'carsList', 'lastInquiries', 'lastNews', 'cities', 'blocks', 'faq'));
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

    public function feedbackSave(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required_if:phone,""',
            'phone' => 'required_if:email,""',
            'message' => 'required',
        ];

        $messages = [
            'name.required' => 'Введите Ваше имя. Мы же должны как-то к Вам обращаться :)',
            'email.required_if' => 'А где же ваш email для обратной связи?',
            'phone.required_if' => 'Укажите пожалуйста Ваш телефончик для обратной связи',
            'message.required' => 'А где собственно сообщение?',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function($validator) use ($request)
        {
            if (app()->environment() == 'production')
            {
                $recaptcha = new ReCaptcha(env('GOOGLE_RECAPTCHA_SECRET'));
                $resp = $recaptcha->verify($request->get('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

                if (!$resp->isSuccess()) {
                    $validator->errors()->add('google_recaptcha_error', 'Ошибка reCAPTCHA: ' . implode(', ', $resp->getErrorCodes()));
                }
            }
        });

        if ($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }

        $data = $request->all();
        $settings = Settings::find(1);

        Mail::queue(['text' => 'emails.feedback'], ['data' => $data], function ($message) use($data, $settings) {
            $message->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            $message->to(isset($settings->email) ? $settings->email : env('MAIL_ADDRESS'));
            $message->subject('Обратная связь');
        });

        if($request->ajax())
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Сообщение отправлено'
            ]);
        }

        Flash::success("Сообщение отправлено");
        return redirect('/');
    }

    public function vars()
    {
        return config('vars');
    }
}
