<header class="tech-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="tech-index.html"><img src="{{$thongtinshop->logoshop}}" width="200px" height="50px"></a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">Home</a>
                    </li>









                    @foreach($danhmuc as $rowdanhmuc)
                    @if($rowdanhmuc->danhmuccha == 0)
                    <li class="nav-item dropdown has-submenu menu-large hidden-md-down hidden-sm-down hidden-xs-down">
                        <a class="nav-link dropdown-toggle" href="{{$rowdanhmuc->id}}" id="{{$rowdanhmuc->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$rowdanhmuc->tendanhmuc}}</a>

                        <ul class="dropdown-menu megamenu" aria-labelledby="{{$rowdanhmuc->id}}">
                            <li>
                                <!-- <div class="container"> -->
                                <div class="mega-menu-content clearfix">
                                    <!-- <div class="tab"> -->
                                    @foreach($danhmuc as $rowdanhmuc2)
                                    @if($rowdanhmuc2->danhmuccha == $rowdanhmuc->id)
                                    <!-- <button class="tablinks active" onclick="openCategory(event, 'cat01')">{{$rowdanhmuc2->tendanhmuc}}</button> -->
                                    <h5><a href="#" class="link-success">{{$rowdanhmuc2->tendanhmuc}}</a></h5>
                                    @endif
                                    @endforeach
                                    <!-- </div> -->
                                </div><!-- end mega-menu-content -->
                                <!-- </div> -->
                            </li>
                        </ul>

                    </li>
                    @endif
                    @endforeach










                    <!-- <li class="nav-item">
                        <a class="nav-link" href="tech-category-01.html">Gadgets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tech-category-02.html">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tech-category-03.html">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tech-contact.html">Contact Us</a>
                    </li> -->
                </ul>
                <!-- <ul class="navbar-nav mr-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-rss"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-android"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-apple"></i></a>
                    </li>
                </ul> -->
            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->