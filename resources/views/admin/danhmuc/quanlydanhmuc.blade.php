@extends('layouts.admin')

@section('title')
<title>Quản lý danh mục</title>
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

                <div class="col-sm-12">
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
                                                <label>Chọn danh mục cha</label>
                                                <select class="form-control" name="danhmuccha" data-live-search="true">
                                                    <option value="0" style="color:blueviolet">Danh mục cha</option>
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

                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        {{-- <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">No.</th> --}}
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">DANH MỤC CHA</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TÊN DANH MỤC</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ẨN / HIỆN</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($danhmuc as $key => $rowdanhmuc)
                                    <tr class="odd">
                                        {{-- <td class="dtr-control sorting_1" tabindex="0">{{$key+1}}</td> --}}

                                        @foreach($danhmuc as $rowdanhmuc2)
                                        @if($rowdanhmuc->danhmuccha == $rowdanhmuc2->id)
                                        <td>{{ $rowdanhmuc2->tendanhmuc }}</td>
                                        @endif
                                        @endforeach
                                        @if($rowdanhmuc->danhmuccha == 0)
                                        <td></td>
                                        @endif

                                        <td>{{ $rowdanhmuc->tendanhmuc }}</td>

                                        @foreach ($sanpham as $rowsanpham)
                                        <?php if ($rowsanpham->iddanhmuc == $rowdanhmuc->id) {
                                            $sudung = $rowdanhmuc->id;
                                        } ?>
                                        @endforeach

                                        @if ($rowdanhmuc->hidden == 0 && $sudung != $rowdanhmuc->id)
                                        <td>Chưa được sử dụng</td>
                                        @elseif($rowdanhmuc->hidden==0 && $sudung==$rowdanhmuc->id)
                                        <td bgcolor="lightgreen">Đang được sử dụng</td>
                                        @else
                                        <td bgcolor="gray" style="color:white">Vô hiệu hóa</td>
                                        @endif
                                        <td class="row">
                                            {{-- <a href="{{ route('editban', ['id' => $row->id]) }}">Sửa bàn</a><br> --}}

                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter{{ $rowdanhmuc->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button><br>
                                            <div class="modal fade" id="exampleModalCenter{{ $rowdanhmuc->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Sửa
                                                                danh mục</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('editdanhmuc') }}" method="post">
                                                            <input type="hidden" name="id" value="{{ $rowdanhmuc->id }}">
                                                            <div class="modal-body">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label>Tên danh mục</label>
                                                                    <input type="text" class="form-control" name="tendanhmuc" value="{{ $rowdanhmuc->tendanhmuc }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Chọn danh mục cha</label>
                                                                    <select class="form-control" name="danhmuccha" data-live-search="true">
                                                                        <option value="0" style="color:blueviolet">Danh mục cha</option>
                                                                        {!!$htmlOption!!}
                                                                        @foreach ($danhmuc as $key2 => $rowdanhmuc2)
                                                                        @if ($rowdanhmuc->danhmuccha == $rowdanhmuc2->id)
                                                                        <option value="{{ $rowdanhmuc2->id }}" selected>
                                                                            {{ $rowdanhmuc2->tendanhmuc }}
                                                                        </option>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Lưu chỉnh sửa</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($rowdanhmuc->hidden == 0)
                                            <form action="{{route('hiddendanhmuc')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="iddanhmuc" value="{{$rowdanhmuc->id}}">
                                                <button type="submit" class="btn btn-secondary"><i class="fa fa-times"></i></button>
                                            </form>
                                            @else
                                            <form action="{{route('showdanhmuc')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="iddanhmuc" value="{{$rowdanhmuc->id}}">
                                                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                                            </form>
                                            @endif

                                            @if ($sudung != $rowdanhmuc->id)
                                            <form action="{{route('deletedanhmuc')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="iddanhmuc" value="{{$rowdanhmuc->id}}">
                                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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