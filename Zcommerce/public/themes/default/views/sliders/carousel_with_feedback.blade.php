<section>
                <div class="feature">
                    <div class="container">
                        <div class="feature__inner">
                            <div class="feature__header">
                                <div class="sell-header sell-header--bold">
                                    <div class="sell-header__title">
                                        <h2>Trending Now</h2>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="feature__items">
                                <div class="feature__items-inner">
                                @foreach($products as $item)
                                <div class="recent__items-box box">
                                    <a href="{{ route('show.product', $item->slug) }}">
                                        <div class="recent__items-img box-img">
                                            <img src="@if($item->image){{ get_storage_file_url(optional($item->image)->path, 'medium') }} @else @endif {{asset('images/placeholders/no_img.png')}}" data-name="product_image" alt="{{ $item->title }}" title="{{ $item->title }}">
                                        </div>
                                    </a>

                                    <div class="recent__items-ratting box-ratting">
                                    </div>

                                    <div class="recent__items-title box-title">
                                        <a href="{{ route('show.product', $item->slug) }}">{{ $item->title }}</a>
                                    </div>

                                    <div class="recent__items-price box-price">
                                        <p class="feature__items-price-new box-price-new">
                                            {!! get_formated_price($item->currnt_sale_price() ,2) !!}
                                        </p>
                                    </div>

                                    <div class="feature__items-action box-action">
                                        <div class="feature__items-view box-view">
                                            <a class="product-link itemQuickView"
                                                href="{{ route('show.product', $item->slug) }}"><i
                                                    class="far fa-search-plus"></i></a>
                                        </div>
                                        <div class="feature__items-wishlist box-wishlist">
                                            <!-- <a href="javascript:void(0)"
                                                data-link="https://zcart.incevio.com/wishlist/42"
                                                class="add-to-wishlist"><i class="far fa-heart"></i></a> -->
                                        </div>

                                        <div class="feature__items-wishlist box-cart">
                                            <div class="feature__items-wishlist box-cart">
                                                @if($item->stock_quantity > 0)
                                                <a href="{{ route('cart.addItem', $item->slug) }}"
                                                    class="btn-primary sc-add-to-cart">@lang('theme.button.add_to_cart')</a>
                                                @else
                                                <a href=""
                                                    class="btn-primary sc-add-to-cart">Out of Stock</a>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>