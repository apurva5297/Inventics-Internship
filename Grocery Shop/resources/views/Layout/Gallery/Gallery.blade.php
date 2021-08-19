@extends('Layout.ProductPage.Product')
@section('content')
<div class="page-content">
    <div class="holder breadcrumbs-wrap mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{Route('Home')}}">Home</a></li>
                <li><span>Gallery</span></li>
            </ul>
        </div>
    </div>
    <div class="holder fullwidth">
        <div class="container px-0">
            <!-- Page Title -->
            <div class="page-title text-center">
                <div class="title">
                    <h1>GALLERY</h1>
                </div>
            </div>
            <!-- /Page Title -->
            <ul class="filters js-filters-gallery">
                <li class="filters-label"><a href="#">All<span class="filters-label-count"></span></a></li>
                <li class="filters-label" data-filter=".category1"><a href="#">Bestseller<span class="filters-label-count"></span></a></li>
                <li class="filters-label" data-filter=".category2"><a href="#">Trend<span class="filters-label-count"></span></a></li>
                <li class="filters-label" data-filter=".category3"><a href="#">New<span class="filters-label-count"></span></a></li>
            </ul>
            <div class="gallery-wrapper">
                <div class="gallery js-gallery-isotope row no-gutters">
                    <div class="col col-sm-9 col-md-6 gallery-item category3 category1">
                        <div class="gallery-item-image"><img src="images/gallery/gallery-1.jpg" alt=""></div>
                        <div class="gallery-item-caption">
                            <h3 class="gallery-item-subtitle">HTML TEMPLATE</h3>
                            <h4 class="gallery-item-title">Bestseller</h4>
                            <div class="gallery-item-links">
                                <a href="images/gallery/gallery-1.jpg" class="gallery-item-link" data-fancybox="gallery" data-caption="Lorem Ipsum Dolor"><i class="icon-zoom-in"></i></a>
                                <a href="#" class="gallery-item-link"><i class="icon-arrow-right-bold"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-9 col-md-6 gallery-item category2">
                        <div class="gallery-item-image"><img src="images/gallery/gallery-2.jpg" alt=""></div>
                        <div class="gallery-item-caption">
                            <h3 class="gallery-item-subtitle">HTML TEMPLATE</h3>
                            <h4 class="gallery-item-title">FOXic is very versatile</h4>
                            <div class="gallery-item-links">
                                <a href="images/gallery/gallery-2.jpg" class="gallery-item-link" data-fancybox="gallery" data-caption="Lorem Ipsum Dolor"><i class="icon-zoom-in"></i></a>
                                <a href="#" class="gallery-item-link"><i class="icon-arrow-right-bold"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-9 col-md-6 gallery-item category1">
                        <div class="gallery-item-image"><img src="images/gallery/gallery-3.jpg" alt=""></div>
                        <div class="gallery-item-caption">
                            <h3 class="gallery-item-subtitle">HTML TEMPLATE</h3>
                            <h4 class="gallery-item-title">Trend Design</h4>
                            <div class="gallery-item-links">
                                <a href="images/gallery/gallery-3.jpg" class="gallery-item-link" data-fancybox="gallery" data-caption="Lorem Ipsum Dolor"><i class="icon-zoom-in"></i></a>
                                <a href="#" class="gallery-item-link"><i class="icon-arrow-right-bold"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-9 col-md-6 gallery-item category2 category3">
                        <div class="gallery-item-image"><img src="images/gallery/gallery-4.jpg" alt=""></div>
                        <div class="gallery-item-caption">
                            <h3 class="gallery-item-subtitle">HTML TEMPLATE</h3>
                            <h4 class="gallery-item-title">FOXic is very versatile</h4>
                            <div class="gallery-item-links">
                                <a href="images/gallery/gallery-4.jpg" class="gallery-item-link" data-fancybox="gallery" data-caption="Lorem Ipsum Dolor"><i class="icon-zoom-in"></i></a>
                                <a href="#" class="gallery-item-link"><i class="icon-arrow-right-bold"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-9 col-md-6 gallery-item category2">
                        <div class="gallery-item-image"><img src="images/gallery/gallery-5.jpg" alt=""></div>
                        <div class="gallery-item-caption">
                            <h3 class="gallery-item-subtitle">HTML TEMPLATE</h3>
                            <h4 class="gallery-item-title">Bestseller</h4>
                            <div class="gallery-item-links">
                                <a href="images/gallery/gallery-5.jpg" class="gallery-item-link" data-fancybox="gallery" data-caption="Lorem Ipsum Dolor"><i class="icon-zoom-in"></i></a>
                                <a href="#" class="gallery-item-link"><i class="icon-arrow-right-bold"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-9 col-md-6 gallery-item category3">
                        <div class="gallery-item-image"><img src="images/gallery/gallery-6.jpg" alt=""></div>
                        <div class="gallery-item-caption">
                            <h3 class="gallery-item-subtitle">HTML TEMPLATE</h3>
                            <h4 class="gallery-item-title">eCommerce Solution</h4>
                            <div class="gallery-item-links">
                                <a href="images/gallery/gallery-6.jpg" class="gallery-item-link" data-fancybox="gallery" data-caption="Lorem Ipsum Dolor"><i class="icon-zoom-in"></i></a>
                                <a href="#" class="gallery-item-link"><i class="icon-arrow-right-bold"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-9 col-md-6 gallery-item category1">
                        <div class="gallery-item-image"><img src="images/gallery/gallery-7.jpg" alt=""></div>
                        <div class="gallery-item-caption">
                            <h3 class="gallery-item-subtitle">HTML TEMPLATE</h3>
                            <h4 class="gallery-item-title">Simply To Use</h4>
                            <div class="gallery-item-links">
                                <a href="images/gallery/gallery-7.jpg" class="gallery-item-link" data-fancybox="gallery" data-caption="Lorem Ipsum Dolor"><i class="icon-zoom-in"></i></a>
                                <a href="#" class="gallery-item-link"><i class="icon-arrow-right-bold"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-9 col-md-6 gallery-item category2">
                        <div class="gallery-item-image"><img src="images/gallery/gallery-8.jpg" alt=""></div>
                        <div class="gallery-item-caption">
                            <h3 class="gallery-item-subtitle">HTML TEMPLATE</h3>
                            <h4 class="gallery-item-title">SEO Optimized</h4>
                            <div class="gallery-item-links">
                                <a href="images/gallery/gallery-8.jpg" class="gallery-item-link" data-fancybox="gallery" data-caption="Lorem Ipsum Dolor"><i class="icon-zoom-in"></i></a>
                                <a href="#" class="gallery-item-link"><i class="icon-arrow-right-bold"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-9 col-md-6 gallery-item category1">
                        <div class="gallery-item-image"><img src="images/gallery/gallery-9.jpg" alt=""></div>
                        <div class="gallery-item-caption">
                            <h3 class="gallery-item-subtitle">HTML TEMPLATE</h3>
                            <h4 class="gallery-item-title">Awesome Skins</h4>
                            <div class="gallery-item-links">
                                <a href="images/gallery/gallery-9.jpg" class="gallery-item-link" data-fancybox="gallery" data-caption="Lorem Ipsum Dolor"><i class="icon-zoom-in"></i></a>
                                <a href="#" class="gallery-item-link"><i class="icon-arrow-right-bold"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex mt-3 mt-md-5 justify-content-center align-items-start">
        <ul class="pagination mt-0">
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
        </ul>
    </div>
</div>
@endsection()
