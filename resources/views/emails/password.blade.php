{{--Click here to reset your password: {{ $user->hasRole('admin') ? url('/admin/password/reset/'.$token) : url('/password/reset/'.$token) }}--}}
Click here to reset your password: {{ url('/password/reset/'.$token) }}
