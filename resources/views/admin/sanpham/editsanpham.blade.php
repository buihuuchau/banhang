@extends('admin.layouts.admin')

@section('title')
<title>Chỉnh sửa sản phẩm</title>
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
                    <h1 class="m-0">CHỈNH SỬA SẢN PHẨM</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Chỉnh sửa sản phẩm</a></li>
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

                @if($errors->any())
                <h3 style="color:red">{{$errors->first()}}</h3>
                @endif
                <div class="col-md-12">
                    <form action="{{route('doeditsanpham') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="idsanpham" value="{{$sanpham->id}}">
                            <div class="form-group col-md-6">
                                <label>Chọn danh mục cha</label>
                                <select class="form-control" name="iddanhmuc">
                                    <option value="0" style="color:blueviolet">Danh mục cha</option>
                                    {!!$htmlOption!!}
                                    @foreach ($danhmuc as $key => $rowdanhmuc)
                                    @if ($rowdanhmuc->id == $sanpham->iddanhmuc)
                                    <option value="{{ $rowdanhmuc->id }}" selected>
                                        {{ $rowdanhmuc->tendanhmuc }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control" name="tensanpham" value="{{ $sanpham->tensanpham }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Ảnh đại diện sản phẩm</label>
                                <input type="file" class="form-control" name="anhsanpham">
                                <img style="width:150px; height:150px; margin-top: 10px; object-fit: cover" src="{{ $sanpham->anhsanpham }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Video sản phẩm</label>
                                <input type="file" class="form-control" name="dulieuvideo">
                                @if($video)
                                <video style="height:140px; margin-top: 10px" controls>
                                    <source src="{{ $video->dulieuvideo }}" type="video/mp4">
                                </video>
                                <button type="button" class="btn btn-danger">
                                    <a href="{{route('deletedulieuvideo',['idvideo'=>$video->id])}}" style="color: white" onclick="return confirm('Bạn có chắc chắn muốn xóa')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </button>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label>Ảnh sản phẩm</label>
                                <input type="file" class="form-control" name="dulieuhinhanh[]" multiple>
                            </div>
                            @if($hinhanh)
                            @foreach($hinhanh as $rowhinhanh)
                            <div class="form-group col-md-2">
                                <img style="width:150px; height:150px; margin-top: 10px; object-fit: cover" src="{{ $rowhinhanh->dulieuhinhanh }}">
                                <button type="button" class="btn btn-danger">
                                    <a href="{{route('deletedulieuhinhanh',['idhinhanh'=>$rowhinhanh->id])}}" style="color: white" onclick="return confirm('Bạn có chắc chắn muốn xóa')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </button>
                            </div>
                            @endforeach
                            @endif
                            <div class="form-group col-md-12">
                                <label>Thông tin sản phẩm</label>
                                <input type="text" class="form-control" name="thongtinsanpham" value="{{$sanpham->thongtinsanpham}}"><br>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Xuất xứ sản phẩm</label>
                                <input type="text" class="form-control" name="xuatxusanpham" value="{{$sanpham->xuatxusanpham}}"><br>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Đơn giá sản phẩm</label>
                                <input type="number" class="form-control" name="dongiasanpham" value="{{$sanpham->dongiasanpham}}" min="1"><br>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Đơn vị tính</label>
                                <input type="text" class="form-control" name="donvitinhsanpham" value="{{$sanpham->donvitinhsanpham}}"><br>
                            </div>

                            <div class="form-group col-md-5">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-primary">Lưu chỉnh sửa</button>
                            </div>
                            <div class="form-group col-md-5">
                            </div>
                        </div>
                    </form>


                </div>

            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection