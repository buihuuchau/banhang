@extends('frontend.layouts.admin')
@section('title')
<title>{{$thongtinshop->tenshop}}</title>
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
                        <div id="loadmore" class="row">
                            <!-- @foreach($sanpham as $key => $rowsanpham)
                            <div class="col-md-3">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="{{ route('chitietsanpham', ['idsanpham' => $rowsanpham->id]) }}" title="">
                                            <img src="{{$rowsanpham->anhsanpham}}" height="212px">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="blog-meta big-meta">
                                        <span class="color-orange"><a href="{{ route('sanphamdanhmuc', ['iddanhmuc' => $rowsanpham->iddanhmuc]) }}" title="">{{ Str::limit($rowsanpham->tendanhmuc, 25) }}</a></span>
                                        <h4><a href="{{ route('chitietsanpham', ['idsanpham' => $rowsanpham->id]) }}" title="">{{ Str::limit($rowsanpham->tensanpham, 50) }}</a></h4>
                                        <b style="color:blue">{{number_format("$rowsanpham->dongiasanpham",0,",",".")}} VNĐ/{{$rowsanpham->donvitinhsanpham}}</b>
                                    </div>
                                </div>
                            </div>
                            @endforeach -->
                        </div>
                    </div>
                </div>
                <hr class="invis">
                {{$sanpham->links()}}
            </div>
            @include('frontend.partials.sidebar')
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var ENDPOINT = "{{ url('/') }}";
    var page = 1;
    infinteLoadMore(page);

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });

    function infinteLoadMore(page) {
        $.ajax({
                url: ENDPOINT + "/?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#loadmore").append(response);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>

@endsection