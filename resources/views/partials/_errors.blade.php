@if (count($errors) > 0)
    <div class="alert alert-danger">
        <p class="text-uppercase">Ошибка!</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif