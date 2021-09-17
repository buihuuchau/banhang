@extends('layouts.admin')

@section('title')
<title>Quản lý đơn hàng</title>
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
                    <h1 class="m-0">QUẢN LÝ ĐƠN HÀNG</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Quản lý đơn hàng</a></li>
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
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">NO.</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">NGÀY ĐẶT HÀNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ĐỊA CHỈ GIAO HÀNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">GIÁ TRỊ ĐƠN HÀNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">SĐT KHÁCH HÀNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">UY TÍN KHÁCH HÀNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TRẠNG THÁI</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donhang as $key => $rowdonhang)
                                    <tr class="odd">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $rowdonhang->ngaydathang }}</td>
                                        <td>{{ $rowdonhang->diachigiaohang }}</td>
                                        <td>{{number_format("$rowdonhang->thanhtiendonhang",0,",",".")}}</td>
                                        <td>{{ $rowdonhang->sdtkhachhang }}</td>
                                        <td>{{number_format("$rowdonhang->uytinkhachhang",0,",",".")}}</td>
                                        @if($rowdonhang->trangthaidonhang == 0)
                                        <td>Đã tiếp nhận</td>
                                        @endif
                                        @if($rowdonhang->trangthaidonhang == 1)
                                        <td>Đã đóng gói</td>
                                        @endif
                                        @if($rowdonhang->trangthaidonhang == 2)
                                        <td>Đang giao hàng</td>
                                        @endif
                                        @if($rowdonhang->trangthaidonhang == 3)
                                        <td style="background-color: lightgreen;">Đã hoàn thành</td>
                                        @endif
                                        @if($rowdonhang->trangthaidonhang == 4)
                                        <td style="background-color: red; color: white;">Đã hủy</td>
                                        @endif
                                        <td class="row">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong{{$rowdonhang->id}}">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                            <div class="modal fade" id="exampleModalLong{{$rowdonhang->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Danh sách món hàng</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach($chitietdonhang as $rowchitietdonhang)
                                                            @if($rowdonhang->id == $rowchitietdonhang->iddonhang)
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <h5 class="col-md-9" style="font-weight: bold;">{{$rowchitietdonhang->tensanpham}}</h5>
                                                                        <img src="{{$rowchitietdonhang->anhsanpham}}" class="col-md-3">
                                                                    </div>
                                                                </div>
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item">Đơn giá:&nbsp&nbsp&nbsp{{number_format("$rowchitietdonhang->dongiasanpham",0,",",".")}}</li>
                                                                    <li class="list-group-item">Số lượng:&nbsp&nbsp&nbsp{{number_format("$rowchitietdonhang->soluongsanpham",0,",",".")}}</li>
                                                                    <li class="list-group-item">Thành tiền:&nbsp&nbsp&nbsp{{number_format("$rowchitietdonhang->thanhtiensanpham",0,",",".")}}</li>
                                                                </ul>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($rowdonhang->trangthaidonhang == 0)
                                            <form action="{{route('checkdonggoi')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="iddonhang" value="{{$rowdonhang->id}}">
                                                <button type="submit" onclick="return confirm('Bạn muốn đóng gói đơn hàng?')" class="btn btn-warning">
                                                    <i class="fas fa-box-open"></i>
                                            </form>
                                            <form action="{{route('checkhuydon')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="iddonhang" value="{{$rowdonhang->id}}">
                                                <button type="submit" onclick="return confirm('Bạn muốn hủy đơn hàng này?')" class="btn btn-danger">
                                                    <i class="fas fa-times"></i>
                                            </form>
                                            @endif
                                            @if($rowdonhang->trangthaidonhang == 1)
                                            <form action="{{route('checkgiaohang')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="iddonhang" value="{{$rowdonhang->id}}">
                                                <button type="submit" onclick="return confirm('Đi giao hàng...')" class="btn btn-warning">
                                                    <i class="fas fa-motorcycle"></i>
                                            </form>
                                            <form action="{{route('checkhuydon')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="iddonhang" value="{{$rowdonhang->id}}">
                                                <button type="submit" onclick="return confirm('Bạn muốn hủy đơn hàng này?')" class="btn btn-danger">
                                                    <i class="fas fa-times"></i>
                                            </form>
                                            @endif
                                            @if($rowdonhang->trangthaidonhang == 2)
                                            <form action="{{route('checkhoanthanh')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="iddonhang" value="{{$rowdonhang->id}}">
                                                <button type="submit" onclick="return confirm('Hoàn thành đơn hàng...')" class="btn btn-success">
                                                    <i class="fas fa-check"></i>
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