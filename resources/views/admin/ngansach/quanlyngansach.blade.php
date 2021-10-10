@extends('admin.layouts.admin')

@section('title')
<title>Quản lý ngân sách</title>
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
                    <h1 class="m-0">QUẢN LÝ NGÂN SÁCH</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Quản lý ngân sách</a></li>
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

                {{-- form nhap ngay  --}}
                <div class="col-sm-6">
                    <div class="card">
                        <form action="{{route('thongkenhaphang')}}" method="get">
                            @csrf
                            <label>Từ:</label>
                            <input type="date" name="tungay" class="form-control">
                            <label>Đến:</label>
                            <input type="date" name="denngay" class="form-control">
                            <div style="text-align:center"><button type="submit" class="btn btn-primary">Thống kê nhập hàng</button></div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <form action="{{route('thongkebanhang')}}" method="get">
                            @csrf
                            <label>Từ:</label>
                            <input type="date" name="tungay" class="form-control">
                            <label>Đến:</label>
                            <input type="date" name="denngay" class="form-control">
                            <div style="text-align:center"><button type="submit" class="btn btn-primary">Thống kê bán hàng</button></div>
                        </form>
                    </div>
                </div>
                {{-- form nhap ngay --}}


                {{--  xuly thongkenhaphang  --}}
                @if($nhaphang!=null)
                <div class="col-sm-12">
                    <h1 style="text-align:center">Thống kê nhập hàng</h1>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">No.</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TÊN SẢN PHẨM</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ĐƠN GIÁ</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">SỐ LƯỢNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÀNH TIỀN</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">NGÀY NHẬP</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">NGUỒN GỐC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nhaphang as $key => $rownhaphang)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{$key+1}}</td>
                                        <td>{{$rownhaphang->tensanpham}}</td>
                                        <td>{{number_format("$rownhaphang->dongianhap",0,",",".");}}</td>
                                        <td>{{number_format("$rownhaphang->soluongnhap",0,",",".");}}</td>
                                        <td>{{number_format("$rownhaphang->thanhtiennhap",0,",",".");}}</td>
                                        <td>{{$rownhaphang->ngaynhap}}</td>
                                        <td>{{$rownhaphang->nguongocnhap}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th>Nhập hàng:<br>{{$tungay}}->{{$denngay}}</th>
                                        <th>{{number_format("$tong",0,",",".");}}</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 1</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 2</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 3</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 4</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 5</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 6</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 7</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 8</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 9</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 10</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 11</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÁNG 12</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd">
                                        @foreach ($total as $key => $rowtotal)
                                        <td>{{number_format("$rowtotal",0,",",".");}}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <canvas id="myChart">></canvas>
                </div>
                @endif
                {{-- xuly thongkenhaphang --}}


                {{-- xuly thongkebanhang --}}
                @if($donhang!=null)
                <div class="col-sm-12">
                    <h1 style="text-align:center">Thống kê bán hàng</h1>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">IDHD</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">T.GIAN</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ĐỊA CHỈ</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">THÀNH TIỀN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donhang as $key => $rowdonhang)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{$rowdonhang->id}}</td>
                                        <td>{{$rowdonhang->ngaydathang}}</td>
                                        <td>{{$rowdonhang->diachigiaohang}}</td>
                                        <td>{{number_format("$rowdonhang->thanhtiendonhang",0,",",".");}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th>Bán hàng:<br>{{$tungay}}->{{$denngay}}</th>
                                        <th>Tổng thu nhập:</th>
                                        <th>{{number_format("$tongthanhtien",0,",",".");}}</th>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Thống kê</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.1</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.2</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.3</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.4</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.5</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.6</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.7</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.8</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.9</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.10</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.11</th>
                                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Th.12</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd">
                                        <th>Thành tiền</th>
                                        @foreach ($totalthanhtien as $key => $rowtotalthanhtien)
                                        <td>{{number_format("$rowtotalthanhtien",0,",",".");}}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <canvas id="myChart2">></canvas>
                </div>


                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <h1 style="text-align:center">Các sản phẩm bán chạy</h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">TÊN MÓN</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ĐƠN GIÁ</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">SỐ LƯỢNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">TỈ LỆ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banchay as $key => $rowbanchay)
                                    <tr class="odd">
                                        <td>{{$rowbanchay['tensanpham']}}</td>
                                        <td>{{number_format($rowbanchay['dongiasanpham'],0,",",".")}}</td>
                                        <td>{{number_format($rowbanchay['soluongsanpham'],0,",",".")}}</td>
                                        @if($sumbanchay == 0)
                                        <td>0%</td>
                                        @else
                                        <td>{{number_format($rowbanchay['soluongsanpham']/$sumbanchay*100,2,",",".")}}%</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <h1 style="text-align:center">Các sản phẩm lỗi</h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">TÊN MÓN</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ĐƠN GIÁ</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">SỐ LƯỢNG</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">TỈ LỆ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hanghong as $key => $rowhanghong)
                                    <tr class="odd">
                                        <td>{{$rowhanghong['tensanpham']}}</td>
                                        <td>{{number_format($rowhanghong['dongiasanpham'],0,",",".")}}</td>
                                        <td>{{number_format($rowhanghong['soluongsanpham'],0,",",".")}}</td>
                                        @if($sumhong == 0)
                                        <td>0%</td>
                                        @else
                                        <td>{{number_format($rowhanghong['soluongsanpham']/$sumhong*100,2,",",".")}}%</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @endif
                {{-- xuly thongkebanhang --}}











            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->






<script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("2 mật khẩu khâc nhau");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
{{-- Ve bieu do --}}
{{-- bieudo nhaphang --}}
@if($nhaphang != null)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
    var xValues = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
    var yValues = [{{$thang1}}, {{$thang2}}, {{$thang3}}, {{$thang4}}, {{$thang5}}, {{$thang6}}, {{$thang7}}, {{$thang8}}, {{$thang9}}, {{$thang10}}, {{$thang11}}, {{$thang12}}, 0];
    var barColors = ["red", "orange", "yellow", "green", "blue", "brown", "purple", "pink", "red", "orange", "yellow", "green"];

    new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Thống kê theo tháng trong năm"
            }
        }
    });
    </script>
@endif
{{-- bieudo nhaphang --}}

{{-- bieudo banhang --}}
@if($donhang != null)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
    var xValues = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
    var yValues = [{{$thang1thanhtien}}, {{$thang2thanhtien}}, {{$thang3thanhtien}}, {{$thang4thanhtien}}, {{$thang5thanhtien}}, {{$thang6thanhtien}}, 
                {{$thang7thanhtien}}, {{$thang8thanhtien}}, {{$thang9thanhtien}}, {{$thang10thanhtien}}, {{$thang11thanhtien}}, {{$thang12thanhtien}}, 0];

    var barColors = ["red", "orange", "yellow", "green", "blue", "brown", "purple", "pink", "red", "orange", "yellow", "green"];

    new Chart("myChart2", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                },
            ]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Thống kê theo tháng trong năm"
            }
        }
    });
    </script>
@endif
{{-- bieudo banhang --}}
{{-- Ve bieu do end--}}






















@endsection