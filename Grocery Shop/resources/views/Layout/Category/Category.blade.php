@extends('Layout.ProductPage.Product')
@section('content')
    <div class="page-content">
        <div class="holder breadcrumbs-wrap mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="##">Home</a></li>
                    <li><span>{{ strtoupper($slug) }} </span></li>
                </ul>
            </div>
        </div>

        <div class="holder">
            <div class="container">
                <!-- Two columns -->
                <!-- Page Title -->
                <div class="page-title text-center">
                </div>
                <!-- /Page Title -->
                <!-- Filter Row -->
                <div class="filter-row">
                    <div class="row">
                        <div class="items-count">35 item(s)</div>
                        <div class="select-wrap d-none d-md-flex">
                            <div class="select-label">SORT:</div>
                            <div class="select-wrapper select-wrapper-xxs">
                                <select class="form-control input-sm" id="short_by_name" onchange="on_change_short_by(this)">
                                    <option value="Latest">Latest</option>
                                    <!-- <option value="rating">Rating</option> -->
                                    <option value="Price">Price</option>
                                </select>

                            </div>
                        </div>
                        <div class="select-wrap d-none d-md-flex">
                            <div class="select-label">VIEW:</div>
                            <div class="select-wrapper select-wrapper-xxs">
                                <select class="form-control input-sm" id="view_by_name" onchange="on_change_view_by(this)">
                                    <option value="2">1</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>

                                </select>
                            </div>
                        </div>
                        <div class="viewmode-wrap">
                            <div class="view-mode">
                                <span class="js-horview d-none d-lg-inline-flex"><i class="icon-grid"></i></span>
                                <span class="js-gridview"><i class="icon-grid"></i></span>
                                <span class="js-listview"><i class="icon-list"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Filter Row -->
                <div class="row">
                    <!-- Left column -->
                    <div class="col-lg-4 aside aside--left filter-col filter-mobile-col filter-col--sticky js-filter-col filter-col--opened-desktop" data-grid-tab-content>
                        <div class="filter-col-content filter-mobile-content">
                            <div class="sidebar-block">
                                <div class="sidebar-block_title">
                                    <span>Current selection</span>
                                </div>
                                <div class="sidebar-block_content">
                                    <div class="selected-filters-wrap">
                                        <ul class="selected-filters">
                                            <li><a href="#">Grey</a></li>
                                            <li><a href="#">Men</a></li>
                                            <li><a href="#">Above $200</a></li>
                                        </ul>
                                        <div class="d-flex flex-wrap align-items-center">
                                            <a href="#" class="clear-filters"><span>Clear All</span></a>
                                            <div class="selected-filters-count ml-auto d-none d-lg-block">Selected <span>6 items</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-block d-filter-mobile">
                                <h3 class="mb-1">SORT BY</h3>
                                <div class="select-wrapper select-wrapper-xs">
                                    <select class="form-control">
                                        <option value="featured">Featured</option>
                                        <option value="rating">Rating</option>
                                        <option value="price">Price</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block open">
                                <div class="sidebar-block_title">
                                    <span>Categories</span>
                                    <span class="toggle-arrow"><span></span><span></span></span>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="category-list">
                                        <li class="active"><a href="##" title="Casual" class="open">Casual&nbsp;<span>(30)</span></a>
                                            <div class="toggle-category js-toggle-category"><span><i class="icon-angle-down"></i></span></div>
                                            <ul class="category-list category-list">
                                                <li><a href="##" title="Men">Men&nbsp;<span>(10)</span></a></li>
                                                <li><a href="##" title="Women">Women&nbsp;<span>(10)</span></a></li>
                                                <li><a href="##" title="Accessories">Accessories&nbsp;<span>(10)</span></a></li>
                                            </ul>
                                        </li>
                                        <li><a href="##" title="T-Shirts" class="open">T-Shirts</a></li>
                                        <li><a href="##" title="Medical" class="open">Medical</a></li>
                                        <li><a href="##" title="FoodMarket" class="open">FoodMarket</a></li>
                                        <li><a href="##" title="Bikes" class="open">Bikes&nbsp;<span>(12)</span></a></li>
                                        <li><a href="##" title="Cosmetics" class="open">Cosmetics&nbsp;<span>(16)</span></a></li>
                                        <li><a href="##" title="Fishing" class="open">Fishing&nbsp;<span>(20)</span></a></li>
                                        <li><a href="##" title="Electronics" class="open">Electronics&nbsp;<span>(15)</span></a></li>
                                        <li><a href="##" title="Games" class="open">Games&nbsp;<span>(14)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block collapsed">
                                <div class="sidebar-block_title">
                                    <span>Colors</span>
                                    <span class="toggle-arrow"><span></span><span></span></span>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="color-list two-column">
                                        <li class="active"><a href="#" data-tooltip="Dark Red" title="Dark Red"><span class="value"><img src="images/colorswatch/color-red.png" alt=""></span><span class="colorname">Red (87)</span></a></li>
                                        <li><a href="#" data-tooltip="Pink" title="Pink"><span class="value"><img src="images/colorswatch/color-pink.png" alt=""></span><span class="colorname">Pink (95)</span></a></li>
                                        <li><a href="#" data-tooltip="Violet" title="Violet"><span class="value"><img src="images/colorswatch/color-violet.png" alt=""></span><span class="colorname">Violet (18)</span></a></li>
                                        <li><a href="#" data-tooltip="Blue" title="Blue"><span class="value"><img src="images/colorswatch/color-blue.png" alt=""></span><span class="colorname">Blue (78)</span></a></li>
                                        <li><a href="#" data-tooltip="Marine" title="Marine"><span class="value"><img src="images/colorswatch/color-marine.png" alt=""></span><span class="colorname">Marine (45)</span></a></li>
                                        <li><a href="#" data-tooltip="Orange" title="Orange"><span class="value"><img src="images/colorswatch/color-orange.png" alt=""></span><span class="colorname">Orange (96)</span></a></li>
                                        <li><a href="#" data-tooltip="Yellow" title="Yellow"><span class="value"><img src="images/colorswatch/color-yellow.png" alt=""></span><span class="colorname">Yellow (55)</span></a></li>
                                        <li><a href="#" data-tooltip="Dark Yellow" title="Dark Yellow"><span class="value"><img src="images/colorswatch/color-darkyellow.png" alt=""></span><span class="colorname">Dark Yellow (2)</span></a></li>
                                        <li><a href="#" data-tooltip="Black" title="Black"><span class="value"><img src="images/colorswatch/color-black.png" alt=""></span><span class="colorname">Black (15)</span></a></li>
                                        <li><a href="#" data-tooltip="White" title="White"><span class="value"><img src="images/colorswatch/color-white.png" alt=""></span><span class="colorname">White (58)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block collapsed">
                                <div class="sidebar-block_title">
                                    <span>Size</span>
                                    <span class="toggle-arrow"><span></span><span></span></span>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="category-list two-column size-list" data-sort='["XXS","XS","S","M","L","XL","XXL","XXXL"]'>
                                        <li data-value="L" class="active"><a href="#">L</a></li>
                                        <li data-value="XL"><a href="#">XL</a></li>
                                        <li data-value="XXS"><a href="#">XXS</a></li>
                                        <li data-value="XS"><a href="#">XS</a></li>
                                        <li data-value="S"><a href="#">S</a></li>
                                        <li data-value="XXL"><a href="#">XXL</a></li>
                                        <li data-value="XXXL"><a href="#">XXXL</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block collapsed">
                                <div class="sidebar-block_title">
                                    <span>Brands</span>
                                    <span class="toggle-arrow"><span></span><span></span></span>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="category-list">
                                        <li><a href="#">Adidas</a></li>
                                        <li><a href="#">Nike</a></li>
                                        <li class="active"><a href="#">Reebok</a></li>
                                        <li><a href="#">Ralph Lauren</a></li>
                                        <li><a href="#">Delpozo</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block collapsed">
                                <div class="sidebar-block_title">
                                    <span>Price</span>
                                    <span class="toggle-arrow"><span></span><span></span></span>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="category-list">
                                        <li><a href="#">$100-$200</a></li>
                                        <li class="active"><a href="#">Above $200</a></li>
                                        <li><a href="#">Under $100</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-block filter-group-block collapsed">
                                <div class="sidebar-block_title">
                                    <span>Popular tags</span>
                                    <span class="toggle-arrow"><span></span><span></span></span>
                                </div>
                                <div class="sidebar-block_content">
                                    <ul class="tags-list">
                                        <li class="active"><a href="#">Jeans</a></li>
                                        <li><a href="#">St.Valentine’s gift</a></li>
                                        <li><a href="#">Sunglasses</a></li>
                                        <li><a href="#">Discount</a></li>
                                        <li><a href="#">Maxi dress</a></li>
                                    </ul>
                                </div>
                            </div>
                            <a href="https://bit.ly/3eJX5XE" class="bnr image-hover-scale bnr--bottom bnr--left" data-fontratio="3.95">
                                <div class="bnr-img">
                                    <img src="{{asset('images/banners/banner-collection-aside.png')}}" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- filter toggle -->
                    <div class="filter-toggle js-filter-toggle">
                        <div class="loader-horizontal js-loader-horizontal">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div>
                            </div>
                        </div>
                        <span class="filter-toggle-icons js-filter-btn"><i class="icon-filter"></i><i class="icon-filter-close"></i></span>
                        <span class="filter-toggle-text"><a href="#" class="filter-btn-open js-filter-btn">REFINE & SORT</a><a href="#" class="filter-btn-close js-filter-btn">RESET</a><a href="#" class="filter-btn-apply js-filter-btn">APPLY & CLOSE</a></span>
                    </div>
                    <!-- /Left column -->
                    <!-- Center column -->
                    <div class="col-lg aside">
                        <div class="prd-grid-wrap">
                            <!-- Products Grid -->
                            <div class="prd-grid product-listing data-to-show-3 data-to-show-md-3 data-to-show-sm-2 js-category-grid" data-grid-tab-content>
                                @foreach($cat_product as $product)
                                    @if($product->product_cat==$slug || $slug=="index")
                                        <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                            <div class="prd-inside">
                                                <div class="prd-img-area">
                                                    <a href="##" class="prd-img image-hover-scale image-container">
                                                        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{$img_url}}{{$product->img_path}}" alt="Leather Pegged Pants" class="js-prd-img lazyload fade-up">
                                                        <div class="foxic-loader"></div>
                                                        <div class="prd-big-squared-labels">
                                                        </div>
                                                    </a>
                                                    <div class="prd-circle-labels">
                                                        <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                                        <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                                        <div class="colorswatch-label colorswatch-label--variants js-prd-colorswatch">
                                                            <i class="icon-palette"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>
                                                            <ul>
                                                                <!-- <li data-image="images/skins/fashion/products/product-01-1.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-orange.png" alt=""></a></li>
                                                                <li data-image="images/skins/fashion/products/product-01-color-2.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-black.png" alt=""></a></li>
                                                                <li data-image="images/skins/fashion/products/product-01-color-3.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-red.png" alt=""></a></li> -->
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- <ul class="list-options color-swatch">
                                                      <li data-image="images/skins/fashion/products/product-01-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-01-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                                      <li data-image="images/skins/fashion/products/product-01-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-01-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                                      <li data-image="images/skins/fashion/products/product-01-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-01-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                                    </ul> -->
                                                </div>
                                                <div class="prd-info">
                                                    <div class="prd-info-wrap">
                                                        <div class="prd-info-top">
                                                            <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                                        </div>
                                                        <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                                        <div class="prd-tag"><a href="#">{{$product->brand}}</a></div>
                                                        <h2 class="prd-title"><a href="##">{{$product->name}}</a></h2>
                                                        <div class="prd-description">
                                                            {{$product->description}}
                                                        </div>
                                                        <div class="prd-action">
                                                            <form action="#">
                                                                <button class="btn js-prd-addtocart" data-product='{"name": "Leather Pegged Pants", "path":"images/skins/fashion/products/product-01-1.jpg", "url":"##", "aspect_ratio":0.778}'>Add To Cart</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="prd-hovers">
                                                        <div class="prd-circle-labels">
                                                            <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                            <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                                        </div>
                                                        <div class="prd-price">
                                                            <div class="price-new">{{$currency}}{{$product->min_price+0}}</div>
                                                        </div>
                                                        <div class="prd-action">
                                                            <div class="prd-action-left">
                                                                <form action="#">
                                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Leather Pegged Pants", "path":"images/skins/fashion/products/product-01-1.jpg", "url":"##", "aspect_ratio":0.778}'>Add To Cart</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    @endif


    @endforeach
@endsection
