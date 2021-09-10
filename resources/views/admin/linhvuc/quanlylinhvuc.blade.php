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
                    <h1 class="m-0">LĨNH VỰC KINH DOANH</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Lĩnh vực kinh doanh</a></li>
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
                            Thêm lĩnh vực
                        </button>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Thêm lĩnh vực</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('addlinhvuc') }}" method="post">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Tên lĩnh vực</label>
                                                <input type="text" class="form-control" name="tenlinhvuc" required><br>
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
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TÊN LĨNH VỰC</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ẨN / HIỆN</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($linhvuc as $key => $rowlinhvuc)
                                    <tr class="odd">
                                        {{-- <td class="dtr-control sorting_1" tabindex="0">{{$key+1}}</td> --}}
                                        <td>{{ $rowlinhvuc->tenlinhvuc }}</td>
                                        @foreach ($sanpham as $key2 => $rowsanpham)
                                        <?php if ($rowsanpham->idlinhvuc == $rowlinhvuc->id) {
                                            $sudung = $rowlinhvuc->id;
                                        } ?>
                                        @endforeach

                                        @if ($rowlinhvuc->hidden == 0 && $sudung != $rowlinhvuc->id)
                                        <td>Chưa được sử dụng</td>
                                        @elseif($rowlinhvuc->hidden==0 && $sudung==$rowlinhvuc->id)
                                        <td bgcolor="lightgreen">Đang được sử dụng</td>
                                        @else
                                        <td bgcolor="gray" style="color:white">Vô hiệu hóa</td>
                                        @endif
                                        <td class="row">
                                            {{-- <a href="{{ route('editban', ['id' => $row->id]) }}">Sửa bàn</a><br> --}}

                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter{{ $rowlinhvuc->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button><br>
                                            <div class="modal fade" id="exampleModalCenter{{ $rowlinhvuc->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Sửa
                                                                lĩnh vực</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('editlinhvuc') }}" method="post">
                                                            <input type="hidden" name="id" value="{{ $rowlinhvuc->id }}">
                                                            <div class="modal-body">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label>Tên lĩnh vực</label>
                                                                    <input type="text" class="form-control" name="tenlinhvuc" value="{{ $rowlinhvuc->tenlinhvuc }}" required>
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

                                            @if ($rowlinhvuc->hidden == 0)
                                            <button class="btn btn-secondary">
                                                <a href="{{ route('hiddenlinhvuc', ['idlinhvuc' => $rowlinhvuc->id]) }}" style="color: white"><i class="fa fa-times"></i></a>
                                            </button>
                                            @else
                                            <button class="btn btn-success">
                                                <a href="{{ route('showlinhvuc', ['idlinhvuc' => $rowlinhvuc->id]) }}" style="color: white"><i class="fas fa-check"></i></a>
                                            </button>
                                            @endif

                                            @if ($sudung != $rowlinhvuc->id)
                                            <button class="btn btn-danger">
                                                <a href="{{ route('deletelinhvuc', ['idlinhvuc' => $rowlinhvuc->id]) }}" style="color: black" onclick="return confirm('Bạn có chắc chắn muốn xóa')">
                                                    <i class="fas fa-trash"></i></a>
                                            </button>
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