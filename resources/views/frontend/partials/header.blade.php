<header class="tech-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <div class="row">
                <div class="row col-xl-12">
                    <a class="navbar-brand ml-3" href="{{route('index')}}"><img src="{{asset($thongtinshop->logoshop)}}" width="200px" height="50px"></a>
                    <ul class="navbar-nav ml-auto">
                        <h4 style="color: black">{{$thongtinshop->tenshop}}</h4>&nbsp;&nbsp;
                        <b style="color: brown; font-size: 12px;">
                            Hotline:&nbsp{{$thongtinshop->dienthoaishop}}<br>
                            Giờ hoạt động:&nbsp{{$thongtinshop->thoigianhoatdong}}
                        </b>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @if($khachhang!=null)
                        <li class="nav-item">
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
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('registerkhachhang')}}">
                                <b style="font-size: 13px;">Đăng ký</b>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="row col-xl-12">
                    <ul class="navbar-nav">
                        <div class="row">
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="{{route('index')}}">Home</a>
                            </li>
                            @foreach($danhmuc as $rowdanhmuc)
                            @if($rowdanhmuc->danhmuccha == 0)
                            <li class="nav-item dropdown has-submenu menu-large">
                                <a class="nav-link dropdown-toggle" href="{{ route('sanphamdanhmuc', ['iddanhmuc' => $rowdanhmuc->id, 'sapxep'=>0]) }}">
                                    {{$rowdanhmuc->tendanhmuc}}
                                </a>
                                <ul class="dropdown-menu megamenu">
                                    <li>
                                        <div class="mega-menu-content clearfix">
                                            @foreach($danhmuc as $rowdanhmuc2)
                                            @if($rowdanhmuc2->danhmuccha == $rowdanhmuc->id)
                                            <a href="{{ route('sanphamdanhmuc', ['iddanhmuc' => $rowdanhmuc2->id, 'sapxep'=>0]) }}" class="link-success" style="color: blueviolet;">
                                                <b class="ml-3" style="font-size: 18px;">{{$rowdanhmuc2->tendanhmuc}}</b>&nbsp&nbsp&nbsp&nbsp
                                            </a>
                                            @endif
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            @endforeach
                            <li class="nav-item ml-1">
                                <form action="{{route('timkiemsanpham')}}" method="post">
                                    @csrf
                                    <input type="text" name="tukhoa" placeholder="Tìm kiếm sản phẩm">
                                    <input type="submit" value="Tìm">
                                </form>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->