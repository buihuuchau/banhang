@extends('frontend.layouts.admin')
@section('title')
<title>Trang chủ</title>
@endsection
@section('section')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <h3>SẢN PHẨM NỔI BẬT</h3>
                    </div><!-- end title -->
                    <div class="blog-grid-system">
                        <div class="row">
                            @foreach($sanpham as $key => $rowsanpham)
                            <div class="col-md-3">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="{{ route('chitietsanpham', ['idsanpham' => $rowsanpham->id]) }}" title="">
                                            <img src="{{$rowsanpham->anhsanpham}}" height="212px">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div><!-- end hover -->
                                        </a>
                                    </div><!-- end media -->
                                    <div class="blog-meta big-meta">
                                        <span class="color-orange"><a href="{{ route('sanphamdanhmuc', ['iddanhmuc' => $rowsanpham->iddanhmuc]) }}" title="">{{ Str::limit($rowsanpham->tendanhmuc, 25) }}</a></span>
                                        <h4><a href="{{ route('chitietsanpham', ['idsanpham' => $rowsanpham->id]) }}" title="">{{ Str::limit($rowsanpham->tensanpham, 50) }}</a></h4>
                                        <b style="color:blue">{{number_format("$rowsanpham->dongiasanpham",0,",",".")}} VNĐ/{{$rowsanpham->donvitinhsanpham}}</b>
                                        <!-- <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i> 2887</a></small> -->
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                            </div><!-- end col -->
                            @endforeach
                        </div><!-- end row -->
                    </div><!-- end blog-grid-system -->
                </div>
                <hr class="invis">
                {{$sanpham->links()}}
            </div>
            @include('frontend.partials.sidebar')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection