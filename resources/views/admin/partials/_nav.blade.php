<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
				<span class="sr-only">Навигация</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/admin') }}">Sellmecar</a>
		</div>

		<div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav">
				<li>
					<a href="/" target="_blank"><i class="fa fa-share-square-o"></i> Открыть сайт</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cog"></i> Настройки <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#"><i class="fa fa-file-text"></i> Профиль</a></li>
						<li class="divider"></li>
						<li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out"></i> Выход</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>