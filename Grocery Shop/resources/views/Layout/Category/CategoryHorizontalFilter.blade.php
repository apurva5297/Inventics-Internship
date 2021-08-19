@include('Layout.Category.HeadSection')
@include('Layout.ProductPage.Header.Header')
<div class="page-content">
    <div class="holder breadcrumbs-wrap mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{Route('home')}}">Home</a></li>
                <li><span>Category</span></li>
            </ul>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <!-- Two columns -->
            <!-- Page Title -->
            <div class="page-title text-center">
                <h1>WOMEN’S</h1>
            </div>
            <!-- /Page Title -->
            <!-- Filter Row -->
            <div class="filter-row">
                <div class="row">
                    <div class="selected-filters-wrap">
                        <ul class="selected-filters">
                            <li><a href="#">Grey</a></li>
                            <li><a href="#">Men</a></li>
                            <li><a href="#">Above $200</a></li>
                            <li><a href="#" class="clear-filters"><span>Clear All</span></a></li>
                        </ul>
                    </div>
                    <div class="items-count">35 item(s)</div>
                    <div class="select-wrap d-none d-md-flex">
                        <div class="select-label">SORT:</div>
                        <div class="select-wrapper select-wrapper-xxs">
                            <select class="form-control input-sm">
                                <option value="featured">Featured</option>
                                <option value="rating">Rating</option>
                                <option value="price">Price</option>
                            </select>
                        </div>
                    </div>
                    <div class="select-wrap d-none d-md-flex">
                        <div class="select-label">VIEW:</div>
                        <div class="select-wrapper select-wrapper-xxs">
                            <select class="form-control input-sm">
                                <option value="featured">12</option>
                                <option value="rating">36</option>
                                <option value="price">100</option>
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
                <!-- Center column -->
                <div class="col-lg">
                    <div class="filter-col-horizontal filter-mobile-col js-filter-col-horizontal filter-col--opened-desktop">
                        <div id="filterRow" class="filter-row-content filter-mobile-content">
                            <div class="row">
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
                                <div class="sidebar-block filter-group-block filter-row-col-16">
                                    <div class="sidebar-block_title">
                                        <span>Categories</span>
                                        <span class="toggle-arrow"><span></span><span></span></span>
                                    </div>
                                    <div class="sidebar-block_content">
                                        <ul class="category-list">
                                            <li class="active"><a href="Route{{('Category')}}" title="Casual" class="open">Casual&nbsp;<span>(30)</span></a></li>
                                            <li><a href="Route{{('Category')}}" title="T-Shirts" class="open">T-Shirts</a></li>
                                            <li><a href="Route{{('Category')}}" title="Medical" class="open">Medical</a></li>
                                            <li><a href="Route{{('Category')}}" title="FoodMarket" class="open">FoodMarket</a></li>
                                            <li><a href="Route{{('Category')}}" title="Bikes" class="open">Bikes&nbsp;<span>(12)</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sidebar-block filter-group-block filter-row-col-25">
                                    <div class="sidebar-block_title">
                                        <span>Brands</span>
                                        <span class="toggle-arrow"><span></span><span></span></span>
                                    </div>
                                    <div class="sidebar-block_content">
                                        <ul class="category-list two-column">
                                            <li><a href="#">Banita</a></li>
                                            <li><a href="#">Seiko</a></li>
                                            <li class="active"><a href="#">Goodwin</a></li>
                                            <li><a href="#">Foxic</a></li>
                                            <li><a href="#">Bigsteps</a></li>
                                            <li><a href="#">Banita</a></li>
                                            <li><a href="#">Seiko</a></li>
                                            <li><a href="#">Foxic</a></li>
                                            <li><a href="#">Bigsteps</a></li>
                                            <li><a href="#">Seiko</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sidebar-block filter-group-block filter-row-col-25">
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
                                <div class="sidebar-block filter-group-block filter-row-col-16">
                                    <div class="sidebar-block_title">
                                        <span>Size</span>
                                        <span class="toggle-arrow"><span></span><span></span></span>
                                    </div>
                                    <div class="sidebar-block_content">
                                        <ul class="category-list size-list">
                                            <li class="active"><a href="#">30-32</a></li>
                                            <li><a href="#">32-34</a></li>
                                            <li><a href="#">34-36</a></li>
                                            <li><a href="#">36-38</a></li>
                                            <li><a href="#">38-40</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sidebar-block filter-group-block filter-row-col-16">
                                    <div class="sidebar-block_title">
                                        <span>Popular tags</span>
                                        <span class="toggle-arrow"><span></span><span></span></span>
                                    </div>
                                    <div class="sidebar-block_content">
                                        <ul class="tags-list">
                                            <li class="active"><a href="#">Jeans</a></li>
                                            <li><a href="#">Tshirts</a></li>
                                            <li><a href="#">Bags</a></li>
                                            <li><a href="#">Sale</a></li>
                                            <li><a href="#">Maxi</a></li>
                                            <li><a href="#">Dress</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
                    <div class="prd-grid-wrap">
                        <!-- Products Grid -->
                        <div class="prd-grid product-listing data-to-show-4 data-to-show-md-3 data-to-show-sm-2 js-category-grid" data-grid-tab-content>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-01-1.jpg" alt="Leather Pegged Pants" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                            <div class="colorswatch-label colorswatch-label--variants js-prd-colorswatch">
                                                <i class="icon-palette"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span
                                                        class="path8"></span><span class="path9"></span><span class="path10"></span></i>
                                                <ul>
                                                    <li data-image="images/skins/fashion/products/product-01-1.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-orange.png" alt=""></a></li>
                                                    <li data-image="images/skins/fashion/products/product-01-color-2.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-black.png" alt=""></a></li>
                                                    <li data-image="images/skins/fashion/products/product-01-color-3.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-red.png" alt=""></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-01-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-01-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-01-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-01-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-01-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-01-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">FOXic</a></div>
                                            <h2 class="prd-title"><a href="product.html">Leather Pegged Pants</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Leather Pegged Pants", "path":"images/skins/fashion/products/product-01-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Leather Pegged Pants", "path":"images/skins/fashion/products/product-01-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-02-1.jpg" alt="Oversize Cotton Dress" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                            <div class="colorswatch-label colorswatch-label--variants js-prd-colorswatch">
                                                <i class="icon-palette"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span
                                                        class="path8"></span><span class="path9"></span><span class="path10"></span></i>
                                                <ul>
                                                    <li data-image="images/skins/fashion/products/product-02-1.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-orange.png" alt=""></a></li>
                                                    <li data-image="images/skins/fashion/products/product-02-color-2.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-red.png" alt=""></a></li>
                                                    <li data-image="images/skins/fashion/products/product-02-color-3.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-yellow.png" alt=""></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-02-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-02-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-02-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-02-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-02-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-02-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">Seiko</a></div>
                                            <h2 class="prd-title"><a href="product.html">Oversize Cotton Dress</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Oversize Cotton Dress", "path":"images/skins/fashion/products/product-02-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Oversize Cotton Dress", "path":"images/skins/fashion/products/product-02-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-03-1.jpg" alt="Oversized Cotton Blouse" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                                <div class="label-new"><span>New</span></div>
                                                <div class="label-sale"><span>-10% <span class="sale-text">Sale</span></span>
                                                    <div class="countdown-circle">
                                                        <div class="countdown js-countdown" data-countdown="2021/07/01"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-03-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-03-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-03-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-03-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-03-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-03-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">Banita</a></div>
                                            <h2 class="prd-title"><a href="product.html">Oversized Cotton Blouse</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Oversized Cotton Blouse", "path":"images/skins/fashion/products/product-03-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-old">$ 200</div>
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Oversized Cotton Blouse", "path":"images/skins/fashion/products/product-03-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-04-1.jpg" alt="Suede Leather Mini Skirt" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-04-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-04-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-04-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-04-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-04-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-04-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">Bigsteps</a></div>
                                            <h2 class="prd-title"><a href="product.html">Suede Leather Mini Skirt</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Suede Leather Mini Skirt", "path":"images/skins/fashion/products/product-04-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Suede Leather Mini Skirt", "path":"images/skins/fashion/products/product-04-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-05-1.jpg" alt="Cotton T-shirt" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-05-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-05-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-05-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-05-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-05-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-05-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">FOXic</a></div>
                                            <h2 class="prd-title"><a href="product.html">Cotton T-shirt</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Cotton T-shirt", "path":"images/skins/fashion/products/product-05-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Cotton T-shirt", "path":"images/skins/fashion/products/product-05-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-06-1.jpg" alt="Midi Dress with Belt" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                            <div class="colorswatch-label colorswatch-label--variants js-prd-colorswatch">
                                                <i class="icon-palette"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span
                                                        class="path8"></span><span class="path9"></span><span class="path10"></span></i>
                                                <ul>
                                                    <li data-image="images/skins/fashion/products/product-06-1.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-grey.png" alt=""></a></li>
                                                    <li data-image="images/skins/fashion/products/product-06-color-2.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-green.png" alt=""></a></li>
                                                    <li data-image="images/skins/fashion/products/product-06-color-3.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="images/colorswatch/color-black.png" alt=""></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-06-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-06-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-06-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-06-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-06-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-06-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">Seiko</a></div>
                                            <h2 class="prd-title"><a href="product.html">Midi Dress with Belt</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Midi Dress with Belt", "path":"images/skins/fashion/products/product-06-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Midi Dress with Belt", "path":"images/skins/fashion/products/product-06-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow prd-outstock">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-07-1.jpg" alt="Denim Mini Skirt" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                                <div class="label-outstock"><span>Sold Out</span></div>
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-07-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-07-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">Banita</a></div>
                                            <h2 class="prd-title"><a href="product.html">Denim Mini Skirt</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Denim Mini Skirt", "path":"images/skins/fashion/products/product-07-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Denim Mini Skirt", "path":"images/skins/fashion/products/product-07-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-08-1.jpg" alt="Peg Leg Trousers" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                                <div class="label-sale"><span>-10% <span class="sale-text">Sale</span></span>
                                                    <div class="countdown-circle">
                                                        <div class="countdown js-countdown" data-countdown="2021/07/01"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-08-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-08-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-08-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-08-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-08-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-08-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">FOXic</a></div>
                                            <h2 class="prd-title"><a href="product.html">Peg Leg Trousers</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Peg Leg Trousers", "path":"images/skins/fashion/products/product-08-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-old">$ 200</div>
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Peg Leg Trousers", "path":"images/skins/fashion/products/product-08-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-09-1.jpg" alt="Skinny Jeans" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                                <div class="label-new"><span>New</span></div>
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-09-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-09-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-09-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-09-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-09-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-09-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">FOXic</a></div>
                                            <h2 class="prd-title"><a href="product.html">Skinny Jeans</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Skinny Jeans", "path":"images/skins/fashion/products/product-09-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Skinny Jeans", "path":"images/skins/fashion/products/product-09-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-10-1.jpg" alt="Short Sleeve Blouse" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                                <div class="label-sale"><span>-10% <span class="sale-text">Sale</span></span>
                                                    <div class="countdown-circle">
                                                        <div class="countdown js-countdown" data-countdown="2021/07/01"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-10-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-10-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-10-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-10-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-10-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-10-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">FOXic</a></div>
                                            <h2 class="prd-title"><a href="product.html">Short Sleeve Blouse</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Short Sleeve Blouse", "path":"images/skins/fashion/products/product-10-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-old">$ 200</div>
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Short Sleeve Blouse", "path":"images/skins/fashion/products/product-10-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-11-1.jpg" alt="Jogger Lounge Pants" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                                <div class="label-sale"><span>-10% <span class="sale-text">Sale</span></span>
                                                    <div class="countdown-circle">
                                                        <div class="countdown js-countdown" data-countdown="2021/07/01"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-11-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-11-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-11-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-11-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-11-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-11-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">FOXic</a></div>
                                            <h2 class="prd-title"><a href="product.html">Jogger Lounge Pants</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Jogger Lounge Pants", "path":"images/skins/fashion/products/product-11-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-old">$ 200</div>
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Jogger Lounge Pants", "path":"images/skins/fashion/products/product-11-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
                                <div class="prd-inside">
                                    <div class="prd-img-area">
                                        <a href="product.html" class="prd-img image-hover-scale image-container">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-12-1.jpg" alt="Elastic Cuff Joggers Pants" class="js-prd-img lazyload fade-up">
                                            <div class="foxic-loader"></div>
                                            <div class="prd-big-squared-labels">
                                                <div class="label-sale"><span>-10% <span class="sale-text">Sale</span></span>
                                                    <div class="countdown-circle">
                                                        <div class="countdown js-countdown" data-countdown="2021/07/01"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="prd-circle-labels">
                                            <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                     class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                            <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                        </div>
                                        <ul class="list-options color-swatch">
                                            <li data-image="images/skins/fashion/products/product-12-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-12-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-12-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-12-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                            <li data-image="images/skins/fashion/products/product-12-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img
                                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-12-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                                        </ul>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-info-wrap">
                                            <div class="prd-info-top">
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                            <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i>
                                            </div>
                                            <div class="prd-tag"><a href="#">FOXic</a></div>
                                            <h2 class="prd-title"><a href="product.html">Elastic Cuff Joggers Pants</a></h2>
                                            <div class="prd-description">
                                                Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                            </div>
                                            <div class="prd-action">
                                                <form action="#">
                                                    <button class="btn js-prd-addtocart" data-product='{"name": "Elastic Cuff Joggers Pants", "path":"images/skins/fashion/products/product-12-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="prd-hovers">
                                            <div class="prd-circle-labels">
                                                <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#"
                                                                                                                                                                                                              class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                                <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-old">$ 200</div>
                                                <div class="price-new">$ 180</div>
                                            </div>
                                            <div class="prd-action">
                                                <div class="prd-action-left">
                                                    <form action="#">
                                                        <button class="btn js-prd-addtocart" data-product='{"name": "Elastic Cuff Joggers Pants", "path":"images/skins/fashion/products/product-12-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="loader-horizontal-sm js-loader-horizontal-sm d-none" data-loader-horizontal style="opacity: 0;"><span></span></div>--}}
                        <div class="circle-loader-wrap">
                            <div class="circle-loader" id="load_more_box">
                                <a href="#" id="custom_load_moree" data-total="30" data-loaded="12" data-load="6" class="lazyload js-circle-loader">

                                <svg id="svg_d" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="50%" cy="50%" r="63" fill="transparent"></circle>
                                        <circle class="js-circle-bar" cx="50%" cy="50%" r="63" fill="transparent"></circle>
                                    </svg>
                                    <svg id="svg_m" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="50%" cy="50%" r="50" fill="transparent"></circle>
                                        <circle class="js-circle-bar" cx="50%" cy="50%" r="50" fill="transparent"></circle>
                                    </svg>
                                    <div class="circle-loader-text">Load More</div>
                                    <div class="circle-loader-text-alt"><span class="js-circle-loader" id="currentProduct_count">6</span>&nbsp;out of&nbsp;<span class="js-circle-loader" id="totalProduct_count"></span></div>
                                </a>
                            </div>
                        </div>
                        <!-- /Products Grid -->
                        <!--<div class="mt-2">-->
                        <!--<button class="btn" onclick="THEME.loaderHorizontalSm.open()">Show Small Loader</button>-->
                        <!--<button class="btn" onclick="THEME.loaderHorizontalSm.close()">Hide Small Loader</button>-->
                        <!--</div>-->
                        <!--<div class="mt-2">-->
                        <!--<button class="btn" onclick="THEME.loaderCategory.open()">Show Opacity</button>-->
                        <!--<button class="btn" onclick="THEME.loaderCategory.close()">Hide Opacity</button>-->
                        <!--</div>-->
                    </div>
                </div>
                <!-- /Center column -->
            </div>
            <!-- /Two columns -->
        </div>
    </div>
</div>
<footer class="page-footer footer-style-6 ">
    <div class="holder ">
        <div class="footer-shop-info">
            <div class="container">
                <div class="text-icn-blocks-bg-row">
                    <div class="text-icn-block-footer">
                        <div class="icn">
                            <i class="icon-trolley"></i>
                        </div>
                        <div class="text">
                            <h4>Extra fast delivery</h4>
                            <p>Your order will be delivered 3-5 business days after all of your items are available</p>
                        </div>
                    </div>
                    <div class="text-icn-block-footer">
                        <div class="icn">
                            <i class="icon-currency"></i>
                        </div>
                        <div class="text">
                            <h4>Best price</h4>
                            <p>We'll match the product prices of key online and local competitors for immediately</p>
                        </div>
                    </div>
                    <div class="text-icn-block-footer">
                        <div class="icn">
                            <i class="icon-diplom"></i>
                        </div>
                        <div class="text">
                            <h4>Guarantee</h4>
                            <p>If the item you want is available, we can process a return and place a new order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="row mt-0">
                <div class="col-lg col-xl last-mobile">
                    <div class="footer-block">
                        <div class="footer-logo">
                            <a href="index.html"><img class="lazyload fade-up" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="images/logo-footer.png 1x, images/logo-footer2x.png 2x" alt="Logo"></a>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                <li>E-mail: <a href="mailto:Foxshop@gmail.com">Foxshop@gmail.com</a></li>
                                <li>Hours: 10:00 - 18:00, Mon - Fri</li>
                            </ul>
                        </div>
                        <ul class="social-list">
                            <li>
                                <a href="#" class="icon icon-facebook"></a>
                            </li>
                            <li>
                                <a href="#" class="icon icon-twitter"></a>
                            </li>
                            <li>
                                <a href="#" class="icon icon-google"></a>
                            </li>
                            <li>
                                <a href="#" class="icon icon-vimeo"></a>
                            </li>
                            <li>
                                <a href="#" class="icon icon-youtube"></a>
                            </li>
                            <li>
                                <a href="#" class="icon icon-pinterest"></a>
                            </li>
                        </ul>
                        <div class="d-lg-none mt-3">
                            <div class="box-coupon">
                                <div class="box-coupon-icon"><i class="icon-scissors"></i></div>
                                <div class="box-coupon-text"><span class="custom-color">FOXIC</span> THEME</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-xl">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>Information</h4>
                            <span class="toggle-arrow"><span></span><span></span></span>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                                <li><a href="typography.html">Terms & Conditions</a></li>
                                <li><a href="typography.html">Returns & Exchanges</a></li>
                                <li><a href="typography.html">Shipping & Delivery</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-xl">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>Account details</h4>
                            <span class="toggle-arrow"><span></span><span></span></span>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                <li><a href="account-details.html">My Account</a></li>
                                <li><a href="cart.html">View Cart</a></li>
                                <li><a href="Route{{('AccountWishlist')}}">My Wishlist</a></li>
                                <li><a href="account-history.html">Order Status</a></li>
                                <li><a href="account-history.html">Track My Order</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-xl">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>Safe payments</h4>
                            <span class="toggle-arrow"><span></span><span></span></span>
                        </div>
                        <div class="collapsed-content">
                            <ul class="payment-link">
                                <li><i class="icon-google-pay-logo"></i></li>
                                <li><i class="icon-visa-pay-logo"></i></li>
                                <li><i class="icon-apple-pay-logo"></i></li>
                            </ul>
                        </div>
                        <div class="d-none d-lg-block">
                            <div class="box-coupon">
                                <div class="box-coupon-icon"><i class="icon-scissors"></i></div>
                                <div class="box-coupon-text"><span class="custom-color">FOXIC</span> THEME</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom footer-bottom--bg">
        <div class="container">
            <div class="footer-copyright text-center">
                <a href="#">FOXshop</a> ©2020 copyright
            </div>
        </div>
    </div>
</footer>
<div class="footer-sticky">
    <!--  sticky add to cart -->
    <div class="sticky-addcart js-stickyAddToCart closed">
        <div class="container">
            <div class="row">
                <div class="col-auto sticky-addcart_image">
                    <a href="product.html">
                        <img src="images/skins/fashion/products/product-01-1.jpg" alt="" />
                    </a>
                </div>
                <div class="col col-sm-5 col-lg-4 col-xl-5 sticky-addcart_info">
                    <h1 class="sticky-addcart_title">Leather Pegged Pants</h1>
                    <div class="sticky-addcart_price">
                        <span class="sticky-addcart_price--actual">$180.00</span>
                        <span class="sticky-addcart_price--old">$210.00</span>
                    </div>
                </div>
                <div class="col-auto sticky-addcart_options  prd-block prd-block_info--style1">
                    <div class="select-wrapper">
                        <select class="form-control form-control--sm">
                            <option value="">--Please choose an option--</option>
                        </select>
                    </div>
                </div>
                <div class="col-auto sticky-addcart_actions">
                    <div class="prd-block_qty">
                        <span class="option-label">Quantity:</span>
                        <div class="qty qty-changer">
                            <button class="decrease"></button>
                            <input type="number" class="qty-input" value="1" data-min="1" data-max="1000">
                            <button class="increase"></button>
                        </div>
                    </div>
                    <div class="btn-wrap">
                        <button class="btn js-prd-addtocart" data-fancybox data-src="#modalCheckOut">Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--added to cart-->
    <div class="popup-addedtocart js-popupAddToCart closed" data-close="50000">
        <div class="container">
            <div class="row">
                <div class="popup-addedtocart-close js-popupAddToCart-close"><i class="icon-close"></i></div>
                <div class="popup-addedtocart-cart js-open-drop" data-panel="#dropdnMinicart"><i class="icon-basket"></i></div>
                <div class="col-auto popup-addedtocart_logo">
                    <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/logo-white-sm.png" class="lazyload fade-up" alt="">
                </div>
                <div class="col popup-addedtocart_info">
                    <div class="row">
                        <a href="product.html" class="col-auto popup-addedtocart_image">
                <span class="image-container w-100">
                  <img src="images/skins/fashion/products/product-01-1.jpg" alt="" />
                </span>
                        </a>
                        <div class="col popup-addedtocart_text">
                            <a href="product.html" class="popup-addedtocart_title"></a>
                            <span class="popup-addedtocart_message">Added to <a href="cart.html" class="underline">Cart</a></span>
                            <span class="popup-addedtocart_error_message"></span>
                        </div>
                    </div>
                </div>
                <div class="col-auto popup-addedtocart_actions">
                    <span>You can continue</span> <a href="#" class="btn btn--grey btn--sm js-open-drop" data-panel="#dropdnMinicart"><i class="icon-basket"></i><span>Check Cart</span></a> <span>or</span> <a href="checkout.html"
                                                                                                                                                                                                                class="btn btn--invert btn--sm"><i class="icon-envelope-1"></i><span>Check out</span></a>
                </div>
            </div>
        </div>
    </div>
    <!--  select options -->
    <div class="sticky-addcart popup-selectoptions js-popupSelectOptions closed" data-close="500000">
        <div class="container">
            <div class="row">
                <div class="popup-selectoptions-close js-popupSelectOptions-close"><i class="icon-close"></i></div>
                <div class="col-auto sticky-addcart_image sticky-addcart_image--zoom">
                    <a href="#" data-caption="">
                        <span class="image-container"><img src="#" alt="" /></span>
                    </a>
                </div>
                <div class="col col-sm-5 col-lg-4 col-xl-5 sticky-addcart_info">
                    <h1 class="sticky-addcart_title"><a href="#">&nbsp;</a></h1>
                    <div class="sticky-addcart_price">
                        <span class="sticky-addcart_price--actual"></span>
                        <span class="sticky-addcart_price--old"></span>
                    </div>
                    <div class="sticky-addcart_error_message">Error Message</div>
                </div>
                <div class="col-auto sticky-addcart_options prd-block prd-block_info--style1">
                    <div class="select-wrapper">
                        <select class="form-control form-control--sm sticky-addcart_options_select">
                            <option value="none">Select Option please..</option>
                        </select>
                        <div class="invalid-feedback">Can't be blank</div>
                    </div>
                </div>
                <div class="col-auto sticky-addcart_actions">
                    <div class="prd-block_qty">
                        <span class="option-label">Quantity:</span>
                        <div class="qty qty-changer">
                            <button class="decrease"></button>
                            <input type="number" class="qty-input" value="2" data-min="1" data-max="10000">
                            <button class="increase"></button>
                        </div>
                    </div>
                    <div class="btn-wrap">
                        <button class="btn js-prd-addtocart">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- back to top -->
    <a class="back-to-top js-back-to-top compensate-for-scrollbar" href="#" title="Scroll To Top">
        <i class="icon icon-angle-up"></i>
    </a>
    <!-- loader -->
    <div class="loader-horizontal js-loader-horizontal">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div>
        </div>
    </div>
</div>
<!-- payment note -->
<div class="footer-sticky">
    <div class="payment-notification-wrap js-pn" data-visible-time="3000" data-hidden-time="3000" data-delay="500" data-from="Aberdeen,Bakersfield,Birmingham,Cambridge,Youngstown"
         data-products='[{"productname":"Leather Pegged Pants", "productlink":"product.html","productimage":"images/skins/fashion/products/product-01-1.jpg"},{"productname":"Black Fabric Backpack", "productlink":"product.html","productimage":"images/skins/fashion/products/product-28-1.jpg"},{"productname":"Combined Chunky Sneakers", "productlink":"product.html","productimage":"images/skins/fashion/products/product-23-1.jpg"}]'>
        <div class="payment-notification payment-notification--squared">
            <div class="payment-notification-inside">
                <div class="payment-notification-container">
                    <a href="#" class="payment-notification-image js-pn-link">
                        <img src="images/products/product-01.jpg" class="js-pn-image" alt="">
                    </a>
                    <div class="payment-notification-content-wrapper">
                        <div class="payment-notification-content">
                            <div class="payment-notification-text">Someone purchased</div>
                            <a href="product.html" class="payment-notification-name js-pn-name js-pn-link">Applewatch</a>
                            <div class="payment-notification-bottom">
                                <div class="payment-notification-when"><span class="js-pn-time">32</span> min ago</div>
                                <div class="payment-notification-from">from <span class="js-pn-from">Riverside</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-notification-close"><i class="icon-close-bold"></i></div>
                <div class="payment-notification-qw prd-hide-mobile js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i></div>
            </div>
        </div>
    </div>
</div>
@include('Layout.Category.Script')
