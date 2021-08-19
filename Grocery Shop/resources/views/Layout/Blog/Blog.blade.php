@extends('Layout.ProductPage.Product')
@section('content')
    <div class="page-content">
        <div class="holder breadcrumbs-wrap mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{Route('home')}}">Home</a></li>
                    <li><span>Our Blog</span></li>
                </ul>
            </div>
        </div>
        <div class="holder">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Our Blog</h1>
                </div>
                <div class="row">
                    <div class="col-md-14 aside aside--content">
                        <div class="post-prws-listing">
                            <div class="post-prw">
                                <div class="row vert-margin-middle">
                                    @foreach($blog_category as $blog)
                                    <div class="post-prw-img col-md-7">
                                        <a href="blog-post.html">
                                            <img src="{{$img_url}}{{$blog->path}}" data-src="{{$img_url}}{{$blog->path}}" class="lazyload fade-up" alt="">
                                        </a>
                                    </div>

                                    <div class="post-prw-text col-md-11">
                                        <div class="post-prw-links">
                                            <div class="post-prw-date"><i class="icon-calendar"></i>10 nov, 2020</div>
                                        </div>
                                        <h4 class="post-prw-title"><a href="blog-post.html">{{$blog->title}}</a></h4>
                                        <div class="post-prw-teaser">{{$blog->content}} </div>
                                        <div class="post-prw-btn">
                                            <a href="blog-post.html" class="btn btn--sm">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
{{--                            <div class="post-prw">--}}
{{--                                <div class="row vert-margin-middle">--}}
{{--                                    <div class="post-prw-img col-md-7">--}}
{{--                                        <a href="blog-post.html">--}}
{{--                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/blog/blog-02.png" class="lazyload fade-up" alt="">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="post-prw-text col-md-11">--}}
{{--                                        <div class="post-prw-links">--}}
{{--                                            <div class="post-prw-date"><i class="icon-calendar"></i>15 nov, 2020</div>--}}
{{--                                            <div class="post-prw-date"><i class="icon-chat"></i>5 comments</div>--}}
{{--                                        </div>--}}
{{--                                        <h4 class="post-prw-title"><a href="blog-post.html">Slider/Megamenu visual builder</a></h4>--}}
{{--                                        <div class="post-prw-teaser">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco </div>--}}
{{--                                        <div class="post-prw-btn">--}}
{{--                                            <a href="blog-post.html" class="btn btn--sm">Read More</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="post-prw">--}}
{{--                                <div class="row vert-margin-middle">--}}
{{--                                    <div class="post-prw-img col-md-7">--}}
{{--                                        <a href="blog-post.html">--}}
{{--                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/blog/blog-03.png" class="lazyload fade-up" alt="">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="post-prw-text col-md-11">--}}
{{--                                        <div class="post-prw-links">--}}
{{--                                            <div class="post-prw-date"><i class="icon-calendar"></i>17 nov, 2020</div>--}}
{{--                                            <div class="post-prw-date"><i class="icon-chat"></i>5 comments</div>--}}
{{--                                        </div>--}}
{{--                                        <h4 class="post-prw-title"><a href="blog-post.html">Full theme control</a></h4>--}}
{{--                                        <div class="post-prw-teaser">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco </div>--}}
{{--                                        <div class="post-prw-btn">--}}
{{--                                            <a href="blog-post.html" class="btn btn--sm">Read More</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="post-prw">--}}
{{--                                <div class="row vert-margin-middle">--}}
{{--                                    <div class="post-prw-img col-md-7">--}}
{{--                                        <a href="blog-post.html">--}}
{{--                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/blog/blog-04.png" class="lazyload fade-up" alt="">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="post-prw-text col-md-11">--}}
{{--                                        <div class="post-prw-links">--}}
{{--                                            <div class="post-prw-date"><i class="icon-calendar"></i>01 dec, 2020</div>--}}
{{--                                            <div class="post-prw-date"><i class="icon-chat"></i>5 comments</div>--}}
{{--                                        </div>--}}
{{--                                        <h4 class="post-prw-title"><a href="blog-post.html">FOXic is very versatile</a></h4>--}}
{{--                                        <div class="post-prw-teaser">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco </div>--}}
{{--                                        <div class="post-prw-btn">--}}
{{--                                            <a href="blog-post.html" class="btn btn--sm">Read More</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="post-prw">--}}
{{--                                <div class="row vert-margin-middle">--}}
{{--                                    <div class="post-prw-img col-md-7">--}}
{{--                                        <a href="blog-post.html">--}}
{{--                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/blog/blog-05.png" class="lazyload fade-up" alt="">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="post-prw-text col-md-11">--}}
{{--                                        <div class="post-prw-links">--}}
{{--                                            <div class="post-prw-date"><i class="icon-calendar"></i>15 dec, 2020</div>--}}
{{--                                            <div class="post-prw-date"><i class="icon-chat"></i>5 comments</div>--}}
{{--                                        </div>--}}
{{--                                        <h4 class="post-prw-title"><a href="blog-post.html">Left column visual builder</a></h4>--}}
{{--                                        <div class="post-prw-teaser">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco </div>--}}
{{--                                        <div class="post-prw-btn">--}}
{{--                                            <a href="blog-post.html" class="btn btn--sm">Read More</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="pagination-wrap d-flex mt-4">
                            <ul class="pagination mt-0">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 aside aside--sidebar aside--right">
                        <div class="aside-content">
                            <div class="aside-block">
                                <h2 class="text-uppercase">Popular Tags</h2>
                                <ul class="tags-list">
                                    <li><a href="#">jeans</a></li>
                                    <li><a href="#">hand bags</a></li>
                                    <li><a href="#">gift card</a></li>
                                    <li><a href="#">goodwin</a></li>
                                    <li><a href="#">seiko</a></li>
                                    <li><a href="#">banita</a></li>
                                    <li><a href="#">foxic</a></li>
                                </ul>
                            </div>
                            <div class="aside-block">
                                <h2 class="text-uppercase">Popular Posts</h2>
                                <div class="post-prw-simple-sm">
                                    <a href="blog-post.html" class="post-prw-img">
                                        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/blog/blog-05.png" class="lazyload fade-up" alt="">
                                    </a>
                                    <div class="post-prw-links">
                                        <div class="post-prw-date"><i class="icon-calendar"></i>August 27, 2020</div>
                                        <a href="#" class="post-prw-author">by Jon Cock</a>
                                    </div>
                                    <h4 class="post-prw-title"><a href="#">FOXic shopify theme</a></h4>
                                    <a href="#" class="post-prw-comments"><i class="icon-chat"></i>15 comments</a>
                                </div>
                            </div>
                            <div class="aside-block">
                                <h2 class="text-uppercase">Meta</h2>
                                <ul class="list list--nomarker">
                                    <li><a href="#">Log in</a></li>
                                    <li><a href="#">Entries RSS</a></li>
                                    <li><a href="#">Comments RSS</a></li>
                                </ul>
                            </div>
                            <div class="aside-block">
                                <h2 class="text-uppercase">Archives</h2>
                                <ul class="list list--nomarker">
                                    <li><a href="#">January 2018</a></li>
                                    <li><a href="#">February 2018</a></li>
                                    <li><a href="#">March 2018</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
