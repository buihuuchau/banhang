@extends('frontend.layouts.admin')
@section('title')
<title>Đặt hàng</title>
@endsection
@section('section')

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">


                    <h1 style="text-align: center;">Thanh toán hóa đơn</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Ảnh sản phẩm</th>
                                <th scope="col">Đơn giá sản phẩm</th>
                                <th scope="col">Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chitietgiohang as $rowchitietgiohang)
                            <tr>
                                <th scope="row">{{$rowchitietgiohang->tensanpham}}</th>
                                <td><img src="{{asset($rowchitietgiohang->anhsanpham)}}" height="60px"></td>
                                <td>{{number_format("$rowchitietgiohang->dongiasanpham",0,",",".")}} VNĐ</td>
                                <td>{{number_format("$rowchitietgiohang->soluongsanpham",0,",",".")}}</td>
                            </tr>

                            @endforeach
                            <tr>
                                <td style="color: black; font-size: 30px">Thành tiền: <?php echo number_format("$thanhtiendonhang", 0, ",", ".");
                                                                                        echo " VNĐ" ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="{{route('dodathang')}}" method="post">
                        {{ csrf_field() }}
                        <b>Địa chỉ giao hàng:</b>
                        <input type="text" class="form-control" name="diachigiaohang" value="{{$khachhang->diachigiaohang}}">
                        <input type="hidden" class="form-control" name="thanhtiendonhang" value="{{$thanhtiendonhang}}">
                        <div class="buttons_added">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Xác nhận đặt hàng')">Đặt hàng</button>
                        </div>
                    </form>
                    <br>
                    <p>Sau khi đặt hàng, chúng tôi sẽ chủ động liên hệ với bạn để xác nhận. Xin chân thành cảm ơn bạn đã tin tưởng, ủng hộ shop của chúng tôi!</p>
                </div><!-- end page-wrapper -->
            </div>
            @include('frontend.partials.sidebar')
        </div><!-- end row -->
    </div><!-- end container -->
</section>

@endsection