 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
 	<!-- Brand Logo -->
 	@if($thongtinshop == null)
 	<a href="{{route('firstpage')}}" class="brand-link">
 		<img src="storage/admin/UnknownLogo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
 		<span class="brand-text font-weight-light">UNKNOWN</span>
 	</a>
 	@endif
 	@if($thongtinshop != null)
 	<a href="{{route('firstpage')}}" class="brand-link">
 		<!-- <img src="{{$thongtinshop->logoshop}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"><br> -->
 		<img src="{{$thongtinshop->logoshop}}" width="200px" height="100px"><br>
 		<span class="brand-text font-weight-light">{{$thongtinshop->tenshop}}</span>
 	</a>
 	@endif


 	<!-- Sidebar -->
 	<div class="sidebar">
 		<!-- Sidebar user panel (optional) -->
 		<!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
 			<div class="image">
 				<img src="" class="img-circle elevation-2" alt="User Image">
 			</div>
 			<div class="info">
 				<a href="" class="d-block"></a>
 			</div>
 		</div> -->
 		<!-- Sidebar Menu -->
 		<nav class="mt-2">
 			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

 				@if($thongtinshop !== null)
 				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
 				<li class="nav-item">
 					<a href="{{route('quanlydanhmuc')}}" class="nav-link">
 						<i class="nav-icon fas fa-user"></i>
 						<p>
 							Quản lý danh mục
 							<!-- <span class="right badge badge-danger">New</span> -->
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="{{route('quanlysanpham')}}" class="nav-link">
 						<i class="nav-icon fas fa-user"></i>
 						<p>
 							Quản lý sản phẩm
 							<!-- <span class="right badge badge-danger">New</span> -->
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="{{route('quanlynhaphang')}}" class="nav-link">
 						<i class="nav-icon fas fa-user"></i>
 						<p>
 							Quản lý nhập hàng
 							<!-- <span class="right badge badge-danger">New</span> -->
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="{{route('quanlykhohang')}}" class="nav-link">
 						<i class="nav-icon fas fa-user"></i>
 						<p>
 							Quản lý kho hàng
 							<!-- <span class="right badge badge-danger">New</span> -->
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="{{route('quanlydonhang')}}" class="nav-link">
 						<i class="nav-icon fas fa-user"></i>
 						<p>
 							Quản lý đơn hàng
 							<!-- <span class="right badge badge-danger">New</span> -->
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="{{route('quanlyngansach')}}" class="nav-link">
 						<i class="nav-icon fas fa-user"></i>
 						<p>
 							Quản lý ngân sách
 							<!-- <span class="right badge badge-danger">New</span> -->
 						</p>
 					</a>
 				</li>
 				@endif
 				<li class="nav-item">
 					<form method="POST" action="{{ route('logout') }}">
 						@csrf
 						<x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
											this.closest('form').submit();" class="nav-link">
 							<h5>Đăng Xuất</h5>
 						</x-dropdown-link>
 					</form>
 				</li>

 			</ul>
 		</nav>
 		<!-- /.sidebar-menu -->
 	</div>
 	<!-- /.sidebar -->
 </aside>