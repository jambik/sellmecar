@include('admin.partials._header', ['title' => $title])

@include('admin.partials._nav')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-3">
            @include('admin.partials._menu')
        </div>
        <div class="col-lg-10 col-md-9 col-sm-9">
            @include('admin.partials._status')
            @include('admin.partials._errors')
            @yield('content')
        </div>
    </div>
</div>

@include('admin.partials._flash')
@include('admin.partials._footer')