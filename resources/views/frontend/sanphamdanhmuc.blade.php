@extends('frontend.layouts.admin')
@section('title')
<title>{{$tendanhmuc}}</title>
@endsection
@section('section')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <!-- san pham danh muc cha -->
                @if($sanphamdanhmuc)
                <div class="page-wrapper">
                    <div class="blog-title-area text-left">
                        <div class="blog-title-area text-center">
                            <h3>{{$tendanhmuc}}</h3>
                        </div><!-- end title -->
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="{{route('index')}}" style="font-size: 20px;">Home</a></li>
                            <li class="breadcrumb-item active" style="font-size: 20px;">{{$tendanhmuc}}</li>
                        </ol>
                    </div><!-- end title -->
                    <div class="blog-grid-system">
                        <div class="row">
                            @foreach($sanphamdanhmuc as $rowsanphamdanhmuc)
                            @foreach($rowsanphamdanhmuc as $rowrowsanphamdanhmuc)
                            <div class="col-md-3">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="{{ route('chitietsanpham', ['idsanpham' => $rowrowsanphamdanhmuc->id]) }}" title="">
                                            <img src="{{asset($rowrowsanphamdanhmuc->anhsanpham)}}" height="212px">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div><!-- end hover -->
                                        </a>
                                    </div><!-- end media -->
                                    <div class="blog-meta big-meta">
                                        <span class="color-orange"><a href="{{ route('sanphamdanhmuc', ['iddanhmuc' => $rowrowsanphamdanhmuc->iddanhmuc]) }}" title="">{{ Str::limit($rowrowsanphamdanhmuc->tendanhmuc, 25) }}</a></span>
                                        <h4><a href="{{ route('chitietsanpham', ['idsanpham' => $rowrowsanphamdanhmuc->id]) }}" title="">{{ Str::limit($rowrowsanphamdanhmuc->tensanpham, 50) }}</a></h4>
                                        <b style="color:blue">{{number_format("$rowrowsanphamdanhmuc->dongiasanpham",0,",",".")}} VNĐ/{{$rowrowsanphamdanhmuc->donvitinhsanpham}}</b>
                                        <!-- <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i> 2887</a></small> -->
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                            </div><!-- end col -->
                            @endforeach
                            @endforeach
                        </div><!-- end row -->
                    </div><!-- end blog-grid-system -->
                </div>
                @endif


                <!-- san pham danh muc con -->
                @if($sanpham)
                <div class="page-wrapper">
                    <div class="blog-title-area text-left">
                        <div class="blog-title-area text-center">
                            <h3>{{$tendanhmuc}}</h3>
                        </div><!-- end title -->
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="{{route('index')}}" style="font-size: 20px;">Home</a></li>
                            <li class="breadcrumb-item active" style="font-size: 20px;">{{$tendanhmuc}}</li>
                        </ol>
                        @if($iddanhmuc != 0)
                        <div class="row justify-content-end">
                            <a class="mr-4" href="{{route('sanphamdanhmuc', ['iddanhmuc'=>$iddanhmuc, 'sapxep'=>1])}}" style="color:blue">A đến Z</a>
                            <a class="mr-4" href="{{route('sanphamdanhmuc', ['iddanhmuc'=>$iddanhmuc, 'sapxep'=>2])}}" style="color:blue">Z đến A</a>
                            <a class="mr-4" href="{{route('sanphamdanhmuc', ['iddanhmuc'=>$iddanhmuc, 'sapxep'=>3])}}" style="color:blue">Thấp tới cao</a>
                            <a class="mr-4" href="{{route('sanphamdanhmuc', ['iddanhmuc'=>$iddanhmuc, 'sapxep'=>4])}}" style="color:blue">Cao tới thấp</a>
                        </div>
                        @endif
                    </div><!-- end title -->
                    <div class="blog-grid-system">
                        <div class="row">
                            @foreach($sanpham as $key => $rowsanpham)
                            <div class="col-md-3">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="{{ route('chitietsanpham', ['idsanpham' => $rowsanpham->id]) }}" title="">
                                            <img src="{{asset($rowsanpham->anhsanpham)}}" height="212px">
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
                @endif

            </div>
            @include('frontend.partials.sidebar')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection