<section class="section first-section">
    <div class="container-fluid">
        <div class="masonry-blog clearfix">









            @foreach($sanpham as $key => $rowsanpham)
            @if($key==0)
            <div class="first-slot">
                <div class="masonry-box post-media">
                    <img src="{{$rowsanpham->anhsanpham}}" height="346px">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="tech-category-01.html" title="">{{$rowsanpham->tendanhmuc}}</a></span>
                                <h4><a href="tech-single.html" title="">{{ Str::limit($rowsanpham->tensanpham, 100) }}</a></h4>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end first-side -->
            @endif

            @if($key==1)
            <div class="second-slot">
                <div class="masonry-box post-media">
                    <img src="{{$rowsanpham->anhsanpham}}" height="346px">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="tech-category-01.html" title="">{{$rowsanpham->tendanhmuc}}</a></span>
                                <h4><a href="tech-single.html" title="">{{ Str::limit($rowsanpham->tensanpham, 100) }}</a></h4>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end second-side -->
            @endif

            @if($key==2)
            <div class="last-slot">
                <div class="masonry-box post-media">
                    <img src="{{$rowsanpham->anhsanpham}}" height="346px">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="tech-category-01.html" title="">{{$rowsanpham->tendanhmuc}}</a></span>
                                <h4><a href="tech-single.html" title="">{{ Str::limit($rowsanpham->tensanpham, 100) }}</a></h4>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end second-side -->
            @endif
            @endforeach









        </div><!-- end masonry -->
    </div>
</section>