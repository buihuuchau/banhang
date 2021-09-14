@extends('layouts.admin')

@section('title')
<title>Quản lý sản phẩm</title>
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
                    <h1 class="m-0">QUẢN LÝ SẢN PHẨM</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Quản lý sản phẩm</a></li>
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
                            Thêm sản phẩm
                        </button>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Thêm sản phẩm</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('addsanpham') }}" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Chọn danh mục cha</label>
                                                <select class="form-control" name="iddanhmuc">
                                                    <option value="0" style="color:blueviolet">Danh mục cha</option>
                                                    {!!$htmlOption!!}
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tên sản phẩm</label>
                                                <input type="text" class="form-control" name="tensanpham" required><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Ảnh đại diện sản phẩm</label>
                                                <input type="file" class="form-control" name="anhsanpham"><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Thông tin sản phẩm</label>
                                                <input type="text" class="form-control" name="thongtinsanpham" required><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Xuất xứ sản phẩm</label>
                                                <input type="text" class="form-control" name="xuatxusanpham" required><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Đơn giá sản phẩm</label>
                                                <input type="number" class="form-control" name="dongiasanpham" min="0" required><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Đơn vị tính</label>
                                                <input type="text" class="form-control" name="donvitinhsanpham" required><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Video sản phẩm</label>
                                                <input type="file" class="form-control" name="dulieuvideo"><br>
                                            </div>
                                            <div class="form-group">
                                                <label>Hình ảnh sản phẩm</label>
                                                <input type="file" class="form-control" name="dulieuhinhanh[]" multiple><br>
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

                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        {{-- <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">No.</th> --}}
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TÊN DANH MỤC</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TÊN SẢN PHẨM</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ẢNH SẢN PHẨM</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ĐƠN GIÁ SẢN PHẨM</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TỒN KHO SẢN PHẨM</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sanpham as $rowsanpham)
                                    <tr class="odd">
                                        @foreach($danhmuc as $rowdanhmuc)
                                        @if($rowsanpham->iddanhmuc == $rowdanhmuc->id)
                                        <td>{{ $rowdanhmuc->tendanhmuc }}</td>
                                        @endif
                                        @endforeach
                                        @if($rowsanpham->iddanhmuc == 0)
                                        <td>Danh mục cha</td>
                                        @endif
                                        <td>{{ $rowsanpham->tensanpham }}</td>
                                        <td><img src="{{$rowsanpham->anhsanpham}}" width="100px" height="100px"></td>
                                        <td>{{number_format("$rowsanpham->dongiasanpham",0,",",".")}}</td>
                                        <td>{{number_format("$rowsanpham->tonkhosanpham",0,",",".")}}</td>

                                        @foreach ($giohang as $rowgiohang)
                                        <?php if ($rowgiohang->idsanpham == $rowsanpham->id) {
                                            $sudung = $rowsanpham->id;
                                        } ?>
                                        @endforeach

                                        <td class="row">
                                            <form action="{{route('editsanpham')}}" method="get">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="idsanpham" value="{{$rowsanpham->id}}">
                                                <button type="submit" class="btn btn-info"><i class="fas fa-info-circle"></i></button>
                                            </form>
                                            @if($sudung != $rowsanpham->id)
                                            <form action="{{route('deletesanpham')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="idsanpham" value="{{$rowsanpham->id}}">
                                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </td>
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