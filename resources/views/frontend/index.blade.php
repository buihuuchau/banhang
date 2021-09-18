@extends('frontend.layouts.admin')
@section('title')
<title>Trang chủ</title>
@endsection
@section('section')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">











                    <div class="blog-list clearfix">
                        @foreach($sanpham as $key => $rowsanpham)
                        @if($key != 0 && $key != 1 && $key != 2)
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="{{$rowsanpham->anhsanpham}}" height="212px">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="tech-single.html" title="">{{ Str::limit($rowsanpham->tensanpham, 100) }}</a></h4>
                                <p>{{ Str::limit($rowsanpham->thongtinsanpham, 100) }}</p>
                                <small class="firstsmall"><a class="bg-orange" href="tech-category-01.html" title="">{{$rowsanpham->tendanhmuc}}</a></small>
                                <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i> 1114</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
                        @endif
                        @endforeach
                    </div><!-- end blog-list -->



























                </div>

                <hr class="invis">

                <!-- <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div> -->

            </div>

            @include('frontend.partials.sidebar')
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection