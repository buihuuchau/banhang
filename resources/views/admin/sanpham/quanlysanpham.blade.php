@extends('admin.layouts.admin')

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
                                                <input type="number" class="form-control" name="dongiasanpham" min="1" required><br>
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
                                            <div class="form-group">
                                                <label>Tính nổi bật</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sanphamnoibat" id="sanphamnoibat1" value="0" checked>
                                                    <label class="form-check-label" for="sanphamnoibat1">
                                                        Không nổi bật
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sanphamnoibat" id="sanphamnoibat2" value="1">
                                                    <label class="form-check-label" for="sanphamnoibat2">
                                                        Nổi bật
                                                    </label>
                                                </div>
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
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ĐƠN VỊ TÍNH</th>
                                        <!-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TRẠNG THÁI</th> -->
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
                                        <td>{{ $rowsanpham->donvitinhsanpham }}</td>
                                        <!-- @if($rowsanpham->hidden == 0 && $rowsanpham->sanphamnoibat == 0)
                                        <td style="background-color: lightgreen;">Hiện---Bình thường</td>
                                        @endif
                                        @if($rowsanpham->hidden == 0 && $rowsanpham->sanphamnoibat == 1)
                                        <td style="background-color: pink;">Hiện---Nổi bật</td>
                                        @endif
                                        @if($rowsanpham->hidden == 1 && $rowsanpham->sanphamnoibat == 0)
                                        <td style="background-color: Olive;">Ẩn---Bình thường</td>
                                        @endif
                                        @if($rowsanpham->hidden == 1 && $rowsanpham->sanphamnoibat == 1)
                                        <td style="background-color: Olive; color: white;">Ẩn---Nổi bật</td>
                                        @endif -->

                                        <td class="row">
                                            <form action="{{route('editsanpham')}}" method="get">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="idsanpham" value="{{$rowsanpham->id}}">
                                                <button type="submit" class="btn btn-info"><i class="fas fa-info-circle"></i></button>
                                            </form>
                                            <form action="{{route('deletesanpham')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="idsanpham" value="{{$rowsanpham->id}}">
                                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            <label>Hiện</label>
                                            <input class="col form-control" type="checkbox" id="anhiensanpham" name="anhiensanpham" value="{{$rowsanpham->id}}" <?php if ($rowsanpham->hidden == 0) echo "checked"; ?>>
                                            <label>Nổi bật</label>
                                            <input class="col form-control" type="checkbox" id="sanphamnoibat" name="sanphamnoibat" value="{{$rowsanpham->id}}" <?php if ($rowsanpham->sanphamnoibat == 1) echo "checked"; ?>>
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


<!-- script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#anhiensanpham', function() {
            var idsanpham = $(this).val();
            $.ajax({
                url: "quanlysanpham",
                type: "get",
                data: {
                    "idsanphamanhien": idsanpham,
                },
                success: function(data) {
                    // window.location.reload();
                },
            });
        });
        $(document).on('click', '#sanphamnoibat', function() {
            var idsanpham = $(this).val();
            $.ajax({
                url: "quanlysanpham",
                type: "get",
                data: {
                    "idsanphamnoibat": idsanpham,
                },
                success: function(data) {
                    // window.location.reload();
                },
            });
        });
    });
</script>

<script>
    $(document).ready(function() {

        // const TYPES = ['info', 'warning', 'success', 'error'],
        //     TITLES = {
        //         'info': 'Notice!',
        //         'success': 'Awesome!',
        //         'warning': 'Watch Out!',
        //         'error': 'Doh!'
        //     },
        //     CONTENT = {
        //         'info': 'Hello, world! This is a toast message.',
        //         'success': 'The action has been completed.',
        //         'warning': 'It\'s all about to go wrong',
        //         'error': 'It all went wrong.'
        //     },
        //     POSITION = ['top-right', 'top-left', 'top-center', 'bottom-right', 'bottom-left', 'bottom-center'];

        // $.toastDefaults.position = 'top-right';
        // $.toastDefaults.dismissible = true;
        // $.toastDefaults.stackable = true;
        // $.toastDefaults.pauseDelayOnHover = true;
        // $(document).on('click', '#anhiensanpham', function() {
        //     var rng = Math.floor(Math.random() * 2) + 1,
        //         type = TYPES[Math.floor(Math.random() * TYPES.length)],
        //         title = TITLES[type],
        //         content = CONTENT[type];

        //     if (rng === 1) {
        //         $.toast({
        //             type: type,
        //             title: title,
        //             subtitle: '11 mins ago',
        //             content: content,
        //             delay: 5000
        //         });
        //     } else {
        //         $.toast({
        //             type: type,
        //             title: title,
        //             subtitle: '11 mins ago',
        //             content: content,
        //             delay: 5000,
        //             img: {
        //                 src: 'https://via.placeholder.com/20',
        //                 alt: 'Image'
        //             }
        //         });
        //     }
        // });
        const TYPES = ['success', 'info'],
            TITLES = {
                'success': 'Thành công',
                'info': 'Thành công',
            },
            CONTENT = {
                'success': 'Chuyển đổi trạng thái ẩn hiện thành công',
                'info': 'Chuyển đổi trạng thái nổi bật thành công',
            },
            POSITION = ['top-right', 'top-left', 'top-center', 'bottom-right', 'bottom-left', 'bottom-center'];

        $.toastDefaults.position = 'top-right';
        $.toastDefaults.dismissible = true;
        $.toastDefaults.stackable = true;
        $.toastDefaults.pauseDelayOnHover = true;


        $(document).on('click', '#anhiensanpham', function() {
            var type = TYPES[0],
                title = TITLES[type],
                content = CONTENT[type];

            $.toast({
                type: type,
                title: title,
                content: content,
                delay: 2000
            });
        });
        $(document).on('click', '#sanphamnoibat', function() {
            var type = TYPES[1],
                title = TITLES[type],
                content = CONTENT[type];

            $.toast({
                type: type,
                title: title,
                content: content,
                delay: 2000
            });
        });
    });
</script>

<!-- script -->


@endsection