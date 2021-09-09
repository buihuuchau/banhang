<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="" class="nav-link">Home</a>
		</li>
	</ul>
	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<ul class="navbar-nav ml-right">
			<li class="nav-item d-none d-sm-inline-block">
				<form method="POST" action="{{ route('logout') }}">
					@csrf
					<x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
									this.closest('form').submit();" class="nav-link">
						{{-- {{ __('Đăng xuất') }} --}}<h5>Đăng xuất</h5>
					</x-dropdown-link>
				</form>
			</li>
		</ul>
	</ul>
</nav>
<!-- /.navbar -->