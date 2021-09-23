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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{$sanpham->tensanpham}}</th>
                                <td><img src="{{asset($sanpham->anhsanpham)}}" height="60px"></td>
                                <td>{{number_format("$sanpham->dongiasanpham",0,",",".")}} VNĐ</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="{{route('domuangay')}}" method="post">
                        {{ csrf_field() }}
                        <b>Địa chỉ giao hàng:</b>
                        <input type="hidden" name="idsanpham" value="{{$sanpham->id}}">
                        <input type="text" class="form-control" name="diachigiaohang" value="{{$khachhang->diachigiaohang}}">
                        <input type="hidden" class="form-control" name="thanhtiendonhang" value="{{$sanpham->dongiasanpham}}">
                        <div class="buttons_added">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Xác nhận đặt hàng')">Đặt hàng</button>
                        </div>
                    </form>
                    <br>
                    <p>Sau khi đặt hàng, chúng tôi sẽ chủ động liên hệ với bạn để xác nhận.</p>
                </div><!-- end page-wrapper -->
            </div>
            @include('frontend.partials.sidebar')
        </div><!-- end row -->
    </div><!-- end container -->
</section>

@endsection