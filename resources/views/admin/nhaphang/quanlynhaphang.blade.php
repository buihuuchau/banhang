@extends('admin.layouts.admin')

@section('title')
<title>Quản lý nhập hàng</title>
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
                    <h1 class="m-0">QUẢN LÝ NHẬP HÀNG</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Quản lý nhập hàng</a></li>
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

                <div class="col-sm-12">
                    <div class="col-md-12 mb-4 text-right">

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Thêm hàng
                        </button>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Thêm hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('addhang') }}" method="post">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Chọn sản phẩm</label>
                                                <select class="form-control" name="idsanpham" data-live-search="true">
                                                    @foreach($sanpham as $rowsanpham)
                                                    <option value="{{$rowsanpham->id}}">{{$rowsanpham->tensanpham}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Giá nhập vào</label>
                                                <input type="number" class="form-control" name="dongianhap" min="1" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Số lượng</label>
                                                <input type="number" class="form-control" name="soluongnhap" min="1" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nguồn gốc</label>
                                                <input type="text" class="form-control" name="nguongocnhap" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" onclick="return confirm('Không thể sửa khi xác nhận, cân nhắc...')">Thêm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- @if($errors->any())
                    <h3 style="color:red">{{$errors->first()}}</h3>
                    @endif -->

                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">NGÀY NHẬP</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TÊN SẢN PHẨM</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">GIÁ NHẬP</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">SỐ LƯỢNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÀNH TIỀN</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">NGUỒN HÀNG</th>
                                        <!-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THAO TÁC</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nhaphang as $key => $rownhaphang)
                                    <tr class="odd">
                                        <td>{{ $rownhaphang->ngaynhap }}</td>
                                        <td>{{ $rownhaphang->tensanpham }}</td>
                                        <td>{{number_format("$rownhaphang->dongianhap",0,",",".")}}</td>
                                        <td>{{number_format("$rownhaphang->soluongnhap",0,",",".")}}</td>
                                        <td>{{number_format("$rownhaphang->thanhtiennhap",0,",",".")}}</td>
                                        <td>{{ $rownhaphang->nguongocnhap }}</td>
                                        <!-- <td>
                                            <form action="{{route('deletehang')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="idnhaphang" value="{{$rownhaphang->id}}">
                                                <input type="hidden" name="idsanpham" value="{{$rownhaphang->idsanpham}}">
                                                <input type="hidden" name="soluongnhap" value="{{$rownhaphang->soluongnhap}}">
                                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection