<header class="tech-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset($thongtinshop->logoshop)}}" width="200px" height="50px"></a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto mt-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">Home</a>
                    </li>
                    @foreach($danhmuc as $rowdanhmuc)
                    @if($rowdanhmuc->danhmuccha == 0)
                    <li class="nav-item dropdown has-submenu menu-large hidden-md-down hidden-sm-down hidden-xs-down">
                        <a class="nav-link dropdown-toggle" id="{{$rowdanhmuc->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$rowdanhmuc->tendanhmuc}}</a>

                        <ul class="dropdown-menu megamenu" aria-labelledby="{{$rowdanhmuc->id}}">
                            <li>
                                <!-- <div class="container"> -->
                                <div class="mega-menu-content clearfix">
                                    @foreach($danhmuc as $rowdanhmuc2)
                                    @if($rowdanhmuc2->danhmuccha == $rowdanhmuc->id)
                                    <a href="{{ route('sanphamdanhmuc', ['iddanhmuc' => $rowdanhmuc2->id]) }}" class="link-success" style="color: blueviolet;">
                                        <b style="font-size: 18px;">{{$rowdanhmuc2->tendanhmuc}}</b>&nbsp&nbsp&nbsp&nbsp
                                    </a>
                                    @endif
                                    @endforeach
                                </div><!-- end mega-menu-content -->
                                <!-- </div> -->
                            </li>
                        </ul>
                    </li>
                    @endif
                    @endforeach
                </ul>

                <ul class="navbar-nav mr-auto mt-auto">
                    <h4 style="color: black">{{$thongtinshop->tenshop}}</h4>&nbsp&nbsp
                    <b style="color: brown; font-size: 12px;">Hotline:&nbsp{{$thongtinshop->dienthoaishop}}<br>
                        Giờ hoạt động:&nbsp{{$thongtinshop->thoigianhoatdong}}</b>
                </ul>

                <ul class="navbar-nav mr-2">
                    @if($khachhang!=null)
                    <li>
                        <h3><a href="{{route('editkhachhang', ['idkhachhang'=>$khachhang->id])}}">{{$khachhang->hotenkhachhang}}</a></h3>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dangxuatkhachhang')}}">
                            <b style="font-size: 13px;">Đăng xuất</b>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('giohang')}}" style="font-size: 20px;"><i class="fa fa-shopping-cart" aria-hidden="true"></i>({{$soluonggiohang}})</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('loginkhachhang')}}">
                            <b style="font-size: 13px;">Đăng nhập</b>
                        </a>
                        <a class="nav-link" href="{{route('registerkhachhang')}}">
                            <b style="font-size: 13px;">Đăng ký</b>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->