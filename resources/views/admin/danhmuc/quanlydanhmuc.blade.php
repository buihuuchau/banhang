@extends('layouts.admin')

@section('title')
<title>Lĩnh vực kinh doanh</title>
@endsection
@section('dangxuat')
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
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">QUẢN LÝ DOANH MỤC</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Quản lý danh mục</a></li>
                        <li class="breadcrumb-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
											this.closest('form').submit();" class="nav-link">
                                    {{ __('Đăng xuất') }}
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 mb-4 text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Thêm danh mục
                    </button>
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm danh mục</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('adddanhmuc') }}" method="post">
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Tên danh mục</label>
                                            <input type="text" class="form-control" name="tendanhmuc" required><br>
                                        </div>
                                        <div class="form-group">
                                            <label>Chọn khu vực</label>
                                            <select class="form-control" name="danhmuccha">
                                                {!!$htmlOption!!}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @if($errors->any())
                <h3 style="color:red">{{$errors->first()}}</h3>
                @endif

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection