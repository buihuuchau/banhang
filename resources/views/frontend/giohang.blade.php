@extends('frontend.layouts.admin')
@section('title')
<title>Giỏ hàng</title>
@endsection
@section('section')

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">


                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Ảnh sản phẩm</th>
                                <th scope="col">Đơn giá sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chitietgiohang as $rowchitietgiohang)
                            <tr>
                                <th scope="row">{{$rowchitietgiohang->tensanpham}}</th>
                                <td><img src="{{asset($rowchitietgiohang->anhsanpham)}}" height="60px"></td>
                                <td>{{number_format("$rowchitietgiohang->dongiasanpham",0,",",".")}} VNĐ</td>
                                <td>{{number_format("$rowchitietgiohang->soluongsanpham",0,",",".")}}</td>
                                <td class="row">
                                    <form action="{{route('capnhatgiohang')}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="idsanpham" value="{{$rowchitietgiohang->id}}">
                                        <input type="hidden" name="dongiasanpham" value="{{$rowchitietgiohang->dongiasanpham}}">
                                        <div class="buttons_added">
                                            <!-- <input class="minus is-form" type="button" value="-"> -->
                                            <input aria-label="quantity" class="input-qty" max="10" min="1" name="soluongsanpham" type="number" value="{{$rowchitietgiohang->soluongsanpham}}">
                                            <!-- <input class="plus is-form" type="button" value="+"> -->
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                    <form action="{{route('deletegiohang')}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="idsanpham" value="{{$rowchitietgiohang->id}}">
                                        <div class="buttons_added">
                                            <button type="submit" class="btn btn-primary">Xóa</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <?php $thanhtien = $thanhtien + $rowchitietgiohang->dongiasanpham * $rowchitietgiohang->soluongsanpham ?>
                            @endforeach
                            <tr>
                                <td style="color: black; font-size: 30px">Thành tiền: <?php echo number_format("$thanhtien", 0, ",", ".");
                                                                                        echo " VNĐ" ?></td>
                                <td>
                                    <form action="" method="post">
                                        {{ csrf_field() }}
                                        <div class="buttons_added">
                                            <button type="submit" class="btn btn-primary">Thanh toán</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>





                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">IDĐH</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Địa chỉ giao hàng</th>
                                <th scope="col">Giá trị đơn hàng</th>
                                <th scope="col">Trạng thái đơn hàng</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donhang as $rowdonhang)
                            <tr>
                                <td scope="row">{{$rowdonhang->id}}</td>
                                <td scope="row">{{$rowdonhang->ngaydathang}}</td>
                                <td scope="row">{{$rowdonhang->diachigiaohang}}</td>
                                <td style="font-weight: bold; color: red;">{{number_format("$rowdonhang->thanhtiendonhang",0,",",".")}}</td>
                                @if($rowdonhang->trangthaidonhang == 0)
                                <td scope="row">Đã tiếp nhận</td>
                                <td class="row">
                                    <form action="{{route('huydonhang')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="iddonhang" value="{{$rowdonhang->id}}">
                                        <button type="submit" class="btn btn-primary">Hủy</button>
                                    </form>
                                </td>
                                @elseif($rowdonhang->trangthaidonhang == 1)
                                <td scope="row">Đã đóng gói</td>
                                <td class="row">
                                    <form action="{{route('huydonhang')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="iddonhang" value="{{$rowdonhang->id}}">
                                        <button type="submit" class="btn btn-primary">Hủy</button>
                                    </form>
                                </td>
                                @elseif($rowdonhang->trangthaidonhang == 2)
                                <td scope="row">Đang giao hàng</td>
                                <td></td>
                                @elseif($rowdonhang->trangthaidonhang == 3)
                                <td style="color: green;">Đã hoàn thành</td>
                                <td></td>
                                @elseif($rowdonhang->trangthaidonhang == 4)
                                <td style="color: red;">Đã hủy</td>
                                <td></td>
                                @endif

                            </tr>
                            @foreach($chitietdonhang as $rowchitietdonhang)
                            @if($rowdonhang->id == $rowchitietdonhang->iddonhang)
                            <tr>
                                <td></td>
                                <td>{{$rowchitietdonhang->tensanpham}}</td>
                                <td><img src="{{asset($rowchitietdonhang->anhsanpham)}}" height="30px"></td>
                                <td style="font-weight: bold; color: purple;">{{number_format("$rowchitietdonhang->dongiasanpham",0,",",".")}}</td>
                                <td style="font-weight: bold; color: purple;">{{number_format("$rowchitietdonhang->soluongsanpham",0,",",".")}}</td>
                                <td style="font-weight: bold; color: purple;">{{number_format("$rowchitietdonhang->thanhtiensanpham",0,",",".")}}</td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                            <tr>
                                <td>{{$donhang->links()}}</td>
                            </tr>
                        </tbody>
                    </table>










                    <div class="custombox clearfix">
                        <h4 class="small-title">Các sản phẩm liên quan</h4>
                        <div class="row">
                            @foreach($sanphamlienquan as $rowsanphamlienquan)
                            <div class="col-lg-2">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="{{route('chitietsanpham', ['idsanpham'=>$rowsanphamlienquan->id])}}" title="">
                                            <img src="{{asset($rowsanphamlienquan->anhsanpham)}}" height="100px">
                                            <div class="hovereffect">
                                                <span class=""></span>
                                            </div><!-- end hover -->
                                        </a>
                                    </div><!-- end media -->
                                    <div class="blog-meta">
                                        <h4><a href="{{route('chitietsanpham', ['idsanpham'=>$rowsanphamlienquan->id])}}" title="">{{ Str::limit($rowsanphamlienquan->tensanpham, 32) }}</a></h4>
                                        <b style="color:blue">{{number_format("$rowsanphamlienquan->dongiasanpham",0,",",".")}} VNĐ/{{$rowsanphamlienquan->donvitinhsanpham}}</b>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                            </div><!-- end col -->

                            @endforeach
                        </div><!-- end row -->
                    </div><!-- end custom-box -->

                </div><!-- end page-wrapper -->

            </div>
            @include('frontend.partials.sidebar')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<!-- Nut tang giam so luong -->
<script>
    $('input.input-qty').each(function() {
        var $this = $(this),
            qty = $this.parent().find('.is-form'),
            min = Number($this.attr('min')),
            max = Number($this.attr('max'))
        if (min == 0) {
            var d = 0
        } else d = min
        $(qty).on('click', function() {
            if ($(this).hasClass('minus')) {
                if (d > min) d += -1
            } else if ($(this).hasClass('plus')) {
                var x = Number($this.val()) + 1
                if (x <= max) d += 1
            }
            $this.attr('value', d).val(d)
        })
    })
</script>
@endsection