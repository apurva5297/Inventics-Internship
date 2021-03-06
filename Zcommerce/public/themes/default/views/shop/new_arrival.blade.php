<div class="holder">
    <div class="container">
      <div class="title-wrap text-center">
        <h2 class="h1-style">New arrival</h2>
        <div class="h-sub maxW-825">Hurry up! Limited</div>
      </div>
      <div class="prd-grid-wrap position-relative">
       <div class="prd-grid data-to-show-4 data-to-show-lg-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-2 js-category-grid" data-grid-tab-content>
        
         @foreach($products as $item)
          <div class="prd prd--style2 prd-labels--max prd-labels-shadow sc-product-item">
            <div class="prd-inside">
              <div class="prd-img-area">
                <a href="product.html" class="prd-img image-hover-scale image-container">
                  <img  src="{{get_product_img_src($item, 'medium') }}" alt="{{ $item->title }}" title="{{ $item->title }}" class="js-prd-img lazyload fade-up">
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
                  <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                  {{-- <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a> --}}
                </div>
                {{-- <ul class="list-options color-swatch">
                  <li data-image="images/skins/fashion/products/product-03-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ get_storage_file_url(optional($item->image)->path, 'small') }}" data-src="images/skins/fashion/products/product-03-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-03-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-03-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-03-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-03-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                </ul> --}}
              </div>
              <div class="prd-info">
                <div class="prd-info-wrap">
                  <div class="prd-info-top">
                    <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  </div>
                  <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  <div class="prd-tag"><a href="#">{{ $item->brand }}</a></div>
                  <h2 class="prd-title"><a href="product.html">{{ $item->title }}</a></h2>
                  <div class="prd-description">
                    Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                  </div>
                  <div class="prd-action">
                    <form action="#">
                      {{-- <button class="btn js-prd-addtocart" data-product='{"name": "Oversized Cotton Blouse", "path":"images/skins/fashion/products/product-03-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button> --}}
                    </form>
                  </div>
                </div>
                <div class="prd-hovers">
                    @if($item->count())
                  <div class="prd-circle-labels">
                    <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                    {{-- <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div> --}}
                  </div>
                  <div class="prd-price">
                    {{-- <div class="price-old">$ 200</div> --}}
                    @php
                      $item->purchase_price= round($item->purchase_price,2);
                    @endphp
                    <div class="price-new">&#8377;{{ $item->purchase_price}}</div>
                  </div>
                  <div class="prd-action">
                    <div class="prd-action-left">

                      
                        {{-- Including data for Add-to-Cart --}}
                         @php
                         $shipping_country_id = get_id_of_model('countries', 'iso_3166_2', $geoip->iso_code);
                         $shipping_state_id = $geoip->state;
        
                         $shipping_zone = get_shipping_zone_of($item->shop_id, $shipping_country_id, $shipping_state_id);
                         $shipping_options = isset($shipping_zone->id) ? getShippingRates($shipping_zone->id) : 'NaN';
                         @endphp
      

                        <input class="product-info-qty product-info-qty-input" data-name="product_quantity" data-min="{{$item->min_order_quantity}}" data-max="{{$item->stock_quantity}}" type="hidden" value="{{$item->min_order_quantity}}">
                        <select hidden name="ship_to" class="ship_to" id="shipTo">
                        @foreach($countries as $country_id => $country_name)
                        <option hidden value="{{$country_id}}" {{$country_id == $shipping_country_id ? 'selected' : ''}}>{{$country_name}}</option>
                        @endforeach
                        </select>
                       {{ Form::hidden('shipping_zone_id', Null, ['id' => 'shipping-zone-id']) }}
                       {{ Form::hidden('shipping_rate_id', Null, ['id' => 'shipping-rate-id']) }}
                       {{-- End --}}

                        @if($item->stock_quantity > 0)
                  
                        <input type="hidden" id="have-link" value="{{ route('cart.addItem', $item->slug) }}">
                        <button  class="btn js-prd-addtocart sc-add-to-cart btn-block"  data-product='{"name":"{{( $item->title) }}", "path":"{{get_product_img_src($item, 'medium') }}", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                
                     
                      @endif
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @endforeach
          {{-- <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
            <div class="prd-inside">
              <div class="prd-img-area">
                <a href="product.html" class="prd-img image-hover-scale image-container">
                  <img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-06-1.jpg" alt="Midi Dress with Belt" class="js-prd-img lazyload fade-up">
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
                      <li data-image="images/skins/fashion/products/product-06-1.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="{{ theme_asset_url('images/colorswatch/color-grey.png')}}" alt=""></a></li>
                      <li data-image="images/skins/fashion/products/product-06-color-2.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="{{ theme_asset_url('images/colorswatch/color-green.png')}}" alt=""></a></li>
                      <li data-image="images/skins/fashion/products/product-06-color-3.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="{{ theme_asset_url('images/colorswatch/color-black.png')}}" alt=""></a></li>
                    </ul>
                  </div>
                </div>
                <ul class="list-options color-swatch">
                  <li data-image="images/skins/fashion/products/product-06-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-06-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-06-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-06-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-06-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-06-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                </ul>
              </div>
              <div class="prd-info">
                <div class="prd-info-wrap">
                  <div class="prd-info-top">
                    <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  </div>
                  <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
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
                    <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
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
          <div class="prd prd--style2 prd-labels--max prd-labels-shadow ">
            <div class="prd-inside">
              <div class="prd-img-area">
                <a href="product.html" class="prd-img image-hover-scale image-container">
                  <img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-10-1.jpg" alt="Short Sleeve Blouse" class="js-prd-img lazyload fade-up">
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
                  <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                  <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                </div>
                <ul class="list-options color-swatch">
                  <li data-image="images/skins/fashion/products/product-10-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-10-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-10-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-10-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-10-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-10-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                </ul>
              </div>
              <div class="prd-info">
                <div class="prd-info-wrap">
                  <div class="prd-info-top">
                    <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  </div>
                  <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
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
                    <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
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
                  <img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-13-1.jpg" alt="Peg Cropped Cuffed Pants" class="js-prd-img lazyload fade-up">
                  <div class="foxic-loader"></div>
                  <div class="prd-big-squared-labels">
                    <div class="label-new"><span>New</span></div>
                  </div>
                </a>
                <div class="prd-circle-labels">
                  <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                  <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                </div>
                <ul class="list-options color-swatch">
                  <li data-image="images/skins/fashion/products/product-13-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-13-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-13-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-13-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-13-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-13-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                </ul>
              </div>
              <div class="prd-info">
                <div class="prd-info-wrap">
                  <div class="prd-info-top">
                    <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  </div>
                  <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  <div class="prd-tag"><a href="#">FOXic</a></div>
                  <h2 class="prd-title"><a href="product.html">Peg Cropped Cuffed Pants</a></h2>
                  <div class="prd-description">
                    Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                  </div>
                  <div class="prd-action">
                    <form action="#">
                      <button class="btn js-prd-addtocart" data-product='{"name": "Peg Cropped Cuffed Pants", "path":"images/skins/fashion/products/product-13-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                    </form>
                  </div>
                </div>
                <div class="prd-hovers">
                  <div class="prd-circle-labels">
                    <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                    <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                  </div>
                  <div class="prd-price">
                    <div class="price-new">$ 180</div>
                  </div>
                  <div class="prd-action">
                    <div class="prd-action-left">
                      <form action="#">
                        <button class="btn js-prd-addtocart" data-product='{"name": "Peg Cropped Cuffed Pants", "path":"images/skins/fashion/products/product-13-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
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
                  <img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-16-1.jpg" alt="Cascade Casual Shirt" class="js-prd-img lazyload fade-up">
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
                      <li data-image="images/skins/fashion/products/product-16-1.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="{{ theme_asset_url('images/colorswatch/color-grey.png')}}" alt=""></a></li>
                      <li data-image="images/skins/fashion/products/product-16-color-2.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="{{ theme_asset_url('images/colorswatch/color-green.png')}}" alt=""></a></li>
                      <li data-image="images/skins/fashion/products/product-16-color-3.jpg"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="{{ theme_asset_url('images/colorswatch/color-black.png')}}" alt=""></a></li>
                    </ul>
                  </div>
                </div>
                <ul class="list-options color-swatch">
                  <li data-image="images/skins/fashion/products/product-16-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-16-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-16-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-16-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-16-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-16-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                </ul>
              </div>
              <div class="prd-info">
                <div class="prd-info-wrap">
                  <div class="prd-info-top">
                    <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  </div>
                  <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  <div class="prd-tag"><a href="#">FOXic</a></div>
                  <h2 class="prd-title"><a href="product.html">Cascade Casual Shirt</a></h2>
                  <div class="prd-description">
                    Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                  </div>
                  <div class="prd-action">
                    <form action="#">
                      <button class="btn js-prd-addtocart" data-product='{"name": "Cascade Casual Shirt", "path":"images/skins/fashion/products/product-16-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                    </form>
                  </div>
                </div>
                <div class="prd-hovers">
                  <div class="prd-circle-labels">
                    <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                    <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                  </div>
                  <div class="prd-price">
                    <div class="price-new">$ 180</div>
                  </div>
                  <div class="prd-action">
                    <div class="prd-action-left">
                      <form action="#">
                        <button class="btn js-prd-addtocart" data-product='{"name": "Cascade Casual Shirt", "path":"images/skins/fashion/products/product-16-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
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
                  <img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-18-1.jpg" alt="Sport Cotton T-shirt" class="js-prd-img lazyload fade-up">
                  <div class="foxic-loader"></div>
                  <div class="prd-big-squared-labels">
                    <div class="label-new"><span>New</span></div>
                    <div class="label-outstock"><span>Sold Out</span></div>
                  </div>
                </a>
                <div class="prd-circle-labels">
                  <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                  <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                </div>
              </div>
              <div class="prd-info">
                <div class="prd-info-wrap">
                  <div class="prd-info-top">
                    <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  </div>
                  <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  <div class="prd-tag"><a href="#">FOXic</a></div>
                  <h2 class="prd-title"><a href="product.html">Sport Cotton T-shirt</a></h2>
                  <div class="prd-description">
                    Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                  </div>
                  <div class="prd-action">
                    <form action="#">
                      <button class="btn js-prd-addtocart" data-product='{"name": "Sport Cotton T-shirt", "path":"images/skins/fashion/products/product-18-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                    </form>
                  </div>
                </div>
                <div class="prd-hovers">
                  <div class="prd-circle-labels">
                    <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                    <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                  </div>
                  <div class="prd-price">
                    <div class="price-new">$ 180</div>
                  </div>
                  <div class="prd-action">
                    <div class="prd-action-left">
                      <form action="#">
                        <button class="btn js-prd-addtocart" data-product='{"name": "Sport Cotton T-shirt", "path":"images/skins/fashion/products/product-18-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
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
                  <img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-21-1.jpg" alt="Genuine Leather Strap Watch" class="js-prd-img lazyload fade-up">
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
                  <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                  <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                </div>
                <ul class="list-options color-swatch">
                  <li data-image="images/skins/fashion/products/product-21-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-21-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-21-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-21-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-21-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-21-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                </ul>
              </div>
              <div class="prd-info">
                <div class="prd-info-wrap">
                  <div class="prd-info-top">
                    <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  </div>
                  <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  <div class="prd-tag"><a href="#">FOXic</a></div>
                  <h2 class="prd-title"><a href="product.html">Genuine Leather Strap Watch</a></h2>
                  <div class="prd-description">
                    Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                  </div>
                  <div class="prd-action">
                    <form action="#">
                      <button class="btn js-prd-addtocart" data-product='{"name": "Genuine Leather Strap Watch", "path":"images/skins/fashion/products/product-21-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                    </form>
                  </div>
                </div>
                <div class="prd-hovers">
                  <div class="prd-circle-labels">
                    <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                    <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                  </div>
                  <div class="prd-price">
                    <div class="price-old">$ 200</div>
                    <div class="price-new">$ 180</div>
                  </div>
                  <div class="prd-action">
                    <div class="prd-action-left">
                      <form action="#">
                        <button class="btn js-prd-addtocart" data-product='{"name": "Genuine Leather Strap Watch", "path":"images/skins/fashion/products/product-21-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
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
                  <img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-25-1.jpg" alt="Fashion Waist Bag" class="js-prd-img lazyload fade-up">
                  <div class="foxic-loader"></div>
                  <div class="prd-big-squared-labels">
                  </div>
                </a>
                <div class="prd-circle-labels">
                  <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                  <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                </div>
                <ul class="list-options color-swatch">
                  <li data-image="images/skins/fashion/products/product-25-1.jpg" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-25-1.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-25-2.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-25-2.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                  <li data-image="images/skins/fashion/products/product-25-3.jpg"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="{{ theme_asset_url('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==')}}" data-src="images/skins/fashion/products/product-25-3.jpg" class="lazyload fade-up" alt="Color Name"></a></li>
                </ul>
              </div>
              <div class="prd-info">
                <div class="prd-info-wrap">
                  <div class="prd-info-top">
                    <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  </div>
                  <div class="prd-rating justify-content-center"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                  <div class="prd-tag"><a href="#">FOXic</a></div>
                  <h2 class="prd-title"><a href="product.html">Fashion Waist Bag</a></h2>
                  <div class="prd-description">
                    Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                  </div>
                  <div class="prd-action">
                    <form action="#">
                      <button class="btn js-prd-addtocart" data-product='{"name": "Fashion Waist Bag", "path":"images/skins/fashion/products/product-25-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                    </form>
                  </div>
                </div>
                <div class="prd-hovers">
                  <div class="prd-circle-labels">
                    <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                    <div class="prd-hide-mobile"><a href="#" class="circle-label-qview js-prd-quickview" data-src="ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                  </div>
                  <div class="prd-price">
                    <div class="price-new">$ 180</div>
                  </div>
                  <div class="prd-action">
                    <div class="prd-action-left">
                      <form action="#">
                        <button class="btn js-prd-addtocart" data-product='{"name": "Fashion Waist Bag", "path":"images/skins/fashion/products/product-25-1.jpg", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>


  {{-- ajax for Add-to-cart --}}
  <script> 
    $(document).ready(function () {
      $(".sc-add-to-cart").click(function () {
        var item = $(this).closest('.sc-product-item');
               var qtt = item.find('input.product-info-qty-input').val();
               var shipTo = item.find('select#shipTo').val();
               var shippingZoneId = item.find('input#shipping-zone-id').val();
               var shippingRateId = item.find('input#shipping-rate-id').val();
               var product_link=item.find('input#have-link').val();
               $.ajax({
                   url: product_link,
                   type: 'POST',
                   data: {
                       'shipTo' : shipTo,
                       'shippingZoneId' : shippingZoneId,
                       'shippingRateId' : shippingRateId,
                       'quantity': qtt ? qtt : 1
                   },
                   complete: function (xhr, textStatus) {
                    if(textStatus=="error"){
                      document.getElementById("stickymess").innerHTML="Already exist";

                    }
                    else{
                      document.getElementById("stickymess").innerHTML="Added to cart";
                    }
                  
                   },
               });
          }); 
        }); 
  
     </script>