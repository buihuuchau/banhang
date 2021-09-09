 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
 	<!-- Brand Logo -->
 	@if($thongtinshop == null)
 	<a href="" class="brand-link">
 		<img src="https://upload.wikimedia.org/wikipedia/commons/b/bc/Unknown_person.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
 		<span class="brand-text font-weight-light">UNKNOWN</span>
 	</a>
 	@endif
 	@if($thongtinshop != null)
 	<a href="" class="brand-link">
 		<!-- <img src="{{$thongtinshop->logoshop}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
 		<img src="https://baokhuyennong.com/wp-content/uploads/2020/06/ca-canh-5.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
 				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
 				@if($thongtinshop == null)
 				<li class="nav-item">
 					<a href="" class="nav-link">
 						<i class="nav-icon fas fa-user"></i>
 						<p>
 							Cap Nhat Thong Tin
 							<!-- <span class="right badge badge-danger">New</span> -->
 						</p>
 					</a>
 				</li>
 				@endif
 				@if($thongtinshop != null)
 				<li class="nav-item">
 					<a href="" class="nav-link">
 						<i class="nav-icon fas fa-user"></i>
 						<p>
 							Quản lý thành viên
 							<!-- <span class="right badge badge-danger">New</span> -->
 						</p>
 					</a>
 				</li>
 				@endif
 			</ul>
 		</nav>
 		<!-- /.sidebar-menu -->
 	</div>
 	<!-- /.sidebar -->
 </aside>