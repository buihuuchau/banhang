@extends('admin.layouts.admin')

@section('title')
<title>Thông tin shop</title>
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
                    <h1 class="m-0">FIRST PAGE</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">First page</a></li>
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

                @if($thongtinshop == null)
                <div class="col-md-3"></div>
                <div class="card col-md-6">
                    <div class="card-body">
                        <form action="{{ route('capnhatthongtinshop')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if($errors->any())
                            <h3 style="color:red">{{$errors->first()}}</h3>
                            @endif
                            <div class="form-group">
                                <label>TÊN SHOP:</label>
                                <input required="true" type="text" class="form-control" name="tenshop" value="{{ old('tenshop') }}">
                            </div>

                            <div class="form-group">
                                <label>LOGO SHOP:</label>
                                <input required="true" type="file" class="form-control" name="logoshop" value="{{ old('logoshop') }}">
                            </div>

                            <div class="form-group">
                                <label>ĐỊA CHỈ SHOP:</label>
                                <input required="true" type="text" class="form-control" name="diachishop" value="{{ old('diachishop') }}">
                            </div>

                            <div class="form-group">
                                <label>SỐ ĐIỆN THOẠI SHOP:</label>
                                <input required="true" type="tel" class="form-control" name="dienthoaishop" placeholder="0123456789" pattern="[0-9]{10}" value="{{ old('dienthoaishop') }}">
                            </div>

                            <div class="form-group">
                                <label>EMAIL SHOP:</label>
                                <input type="email" class="form-control" name="emailshop" placeholder="abc@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="{{ old('emailshop') }}">
                            </div>

                            <div class="form-group">
                                <label>WEBSITE SHOP:</label>
                                <input type="url" class="form-control" name="websiteshop" pattern="https?://.+" placeholder="http:// or https://" value="{{ old('websiteshop') }}">
                            </div>

                            <div class="form-group">
                                <label>STK/CHI NHÁNH NGÂN HÀNG:</label>
                                <input required="true" type="text" class="form-control" name="stkshop" value="{{ old('stkshop') }}">
                            </div>

                            <div class="form-group">
                                <label>VỊ TRÍ SHOP:</label>
                                <input type="text" class="form-control" name="vitrishop" value="{{ old('vitrishop') }}">
                            </div>

                            <div class="col text-center">
                                <button class="btn btn-danger">Cập nhật thông tin lần đầu</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
                @else
                <div class="col-md-3"></div>
                <div class="card col-md-6">
                    <div class="card-body">
                        <form action="{{ route('suathongtinshop')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if($errors->any())
                            <h3 style="color:red">{{$errors->first()}}</h3>
                            @endif
                            <div class="form-group">
                                <label>TÊN SHOP:</label>
                                <input required="true" type="text" class="form-control" name="tenshop" value="{{ $thongtinshop->tenshop }}">
                            </div>

                            <div class="form-group">
                                <label>LOGO SHOP:</label>
                                <input type="file" class="form-control" name="logoshop" value="{{ old('logoshop') }}">
                            </div>

                            <div class="form-group">
                                <label>ĐỊA CHỈ SHOP:</label>
                                <input required="true" type="text" class="form-control" name="diachishop" value="{{ $thongtinshop->diachishop }}">
                            </div>

                            <div class="form-group">
                                <label>SỐ ĐIỆN THOẠI SHOP:</label>
                                <input required="true" type="tel" class="form-control" name="dienthoaishop" pattern="[0-9]{10}" value="{{ $thongtinshop->dienthoaishop }}">
                            </div>

                            <div class="form-group">
                                <label>EMAIL SHOP:</label>
                                <input type="email" class="form-control" name="emailshop" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="{{ $thongtinshop->emailshop }}">
                            </div>

                            <div class="form-group">
                                <label>WEBSITE SHOP:</label>
                                <input type="url" class="form-control" name="websiteshop" pattern="https?://.+" placeholder="http:// or https://" value="{{ $thongtinshop->websiteshop }}">
                            </div>

                            <div class="form-group">
                                <label>STK/CHI NHÁNH NGÂN HÀNG:</label>
                                <input required="true" type="text" class="form-control" name="stkshop" value="{{ $thongtinshop->stkshop }}">
                            </div>

                            <div class="form-group">
                                <label>VỊ TRÍ SHOP:</label>
                                <input type="text" class="form-control" name="vitrishop" value="{{ $thongtinshop->vitrishop }}">
                            </div>

                            <div class="col text-center">
                                <button class="btn btn-danger">Chỉnh sửa thông tin</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
                @endif

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection