@extends('admin.layouts.admin')

@section('title')
<title>Quản lý kho hàng</title>
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
                    <h1 class="m-0">QUẢN LÝ KHO HÀNG</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Quản lý kho hàng</a></li>
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
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TÊN SẢN PHẨM</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">SỐ LƯỢNG HÀNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">HÀNG ĐÃ BÁN</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">HÀNG CÒN LẠI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($khohang as $key => $rowkhohang)
                                    <tr class="odd">
                                        <td>{{ $rowkhohang->tensanpham }}</td>
                                        <td>{{number_format("$rowkhohang->soluonghang",0,",",".")}}</td>
                                        <td>{{number_format("$rowkhohang->soluongban",0,",",".")}}</td>
                                        <td>{{number_format("$rowkhohang->soluongconlai",0,",",".")}}</td>
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