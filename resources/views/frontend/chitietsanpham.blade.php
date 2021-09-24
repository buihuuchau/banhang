@extends('frontend.layouts.admin')
@section('title')
<title>{{$sanpham->tensanpham}}</title>
@endsection
@section('section')

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <ol class="breadcrumb hidden-xs-down text-left">
                            <li class="breadcrumb-item"><a href="" style="font-size: 20px;">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('sanphamdanhmuc', ['iddanhmuc' => $sanpham->iddanhmuc]) }}" style="font-size: 20px;">{{$sanpham->tendanhmuc}}</a></li>
                            <li class="breadcrumb-item active" style="font-size: 20px;">{{$sanpham->tensanpham}}</li>
                        </ol>
                        <h3>{{$sanpham->tensanpham}}</h3>
                    </div><!-- end title -->
                    <div class="row">
                        <div class="col-md-4">
                            @if($video!=null)
                            <video controls class="col-md-12">
                                <source src=" {{asset($video->dulieuvideo)  }}" type="video/mp4">
                            </video>
                            @else
                            <div>
                                <img src="{{asset($sanpham->anhsanpham)}}" class="col-md-12">
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <b style="font-size: 20px;">Đơn giá:</b>
                            <h2 style="color: gold">
                                {{number_format("$sanpham->dongiasanpham", 0, ",", ".")}}vnđ/{{$sanpham->donvitinhsanpham}}
                            </h2>
                            <b style="font-size: 20px;">Xuất xứ:</b>
                            <h2 style="color: blue">
                                {{$sanpham->xuatxusanpham}}
                            </h2>
                            @if($khohang!=null && $khohang->soluongconlai >=1 && $khohang->soluongconlai <= 10) <b style="font-size: 20px;">Chỉ còn lại:</b>
                                <h5>{{$khohang->soluongconlai}} sản phẩm</h5>
                                @endif
                                @if($khohang!=null && $khohang->soluongconlai <= 0) <h5 style="color: red;">Tạm hết hàng</h5>
                                    @endif
                        </div>
                        @if($khohang!=null && $khohang->soluongconlai > 0)<div class="post-sharing col-md-2">
                            <ul class="list-inline">
                                <li>
                                    <form action="{{route('themvaogiohang')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="idsanpham" value="{{$sanpham->id}}">
                                        <input type="submit" class="btn" value="Thêm vào giỏ hàng">
                                    </form>
                                    <!-- <button><a href="{{route('themvaogiohang', ['idsanpham'=>$sanpham->id])}}">Thêm vào giỏ hàng</a></button> -->
                                </li>
                                <li>
                                    <form action="{{route('muangay')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="idsanpham" value="{{$sanpham->id}}">
                                        <input type="submit" class="btn" value="Mua ngay">
                                    </form>
                                </li>
                            </ul>
                        </div><!-- end post-sharing -->
                        @endif

                    </div>
                    <div class="row container-fluid mt-4">
                        <div class="row flex-row flex-nowrap">
                            <div class="card">
                                <a href="{{asset($sanpham->anhsanpham)}}" target="_self">
                                    <img src="{{asset($sanpham->anhsanpham)}}" height="100px" width="100%">
                                </a>
                            </div>
                            @foreach($hinhanh as $rowhinhanh)
                            <div class="card">
                                <a href="{{asset($rowhinhanh->dulieuhinhanh)}}" target="_self">
                                    <img src="{{asset($rowhinhanh->dulieuhinhanh)}}" height="100px" width="100%">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="blog-meta big-meta text-left">
                        <h4>Thông tin sản phẩm:</h4>
                        <p>{{$sanpham->thongtinsanpham}}</p>
                    </div>




                    <hr class="invis1">

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
@endsection