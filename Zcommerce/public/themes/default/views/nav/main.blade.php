<header class="header">
            @if(Session::has('global_announcement'))
            <div id="global-announcement">
                {!! session('global_announcement')->parsed_body !!}
                @if(session('global_announcement')->action_url)
                  <span class="indent10">
                    <a href="{{ session('global_announcement')->action_url }}" class="btn btn-primary flat btn-sm">
                        {{ session('global_announcement')->action_text }}
                    </a>
                  </span>
                @endif
            </div>
            @endif

            <div class="header__top">
                <div class="container">
                    <div class="header__top-inner">
                        <div class="header__top-welcome">
                            <h3>Welcome @if(isset($shop)) To {{$shop->name}} @endif</h3>
                        </div>

                        <div class="header__top-utility">
                            <ul>
                                @auth('customer')
                                <li class="image-icon">
                                   <a href="{{ route('customer.logout') }}">
                                    <i class="fal fa-power-off"></i>
                                    <span>{{ trans('theme.logout') }}</span>
                                  </a>
                                </li>
                                @else
                                <li class="image-icon">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                                        <i class="fal fa-user"></i>
                                        <span>{{ trans('theme.sing_in') }}</span>
                                    </a>
                                </li>
                                @endauth



                                <!-- <li class="image-icon">
                                    <a href="https://zcart.incevio.com/my/orders">
                                        <i class="fal fa-map-marker-alt"></i> Track Your Order
                                    </a>
                                </li> -->
                                <li class="image-icon">
                                    <a href="{{ get_page_url(\App\Page::PAGE_CONTACT_US) }}">
                                        <i class="fal fa-life-ring"></i> {{ trans('theme.nav.support') }}
                                    </a>
                                </li>



                                <!-- <li class="language">
                                    <select name="lang" id="languageChange">
                                        <option dd-link="https://zcart.incevio.com/locale/en" value="en"
                                            data-imagesrc="https://zcart.incevio.com/images/flags/US.png" selected>
                                            English
                                        </option>
                                        <option dd-link="https://zcart.incevio.com/locale/es" value="es"
                                            data-imagesrc="https://zcart.incevio.com/images/flags/ES.png">
                                            Spanish
                                        </option>
                                        <option dd-link="https://zcart.incevio.com/locale/fa" value="fa"
                                            data-imagesrc="https://zcart.incevio.com/images/flags/IR.png">
                                            Persian
                                        </option>
                                        <option dd-link="https://zcart.incevio.com/locale/bn" value="bn"
                                            data-imagesrc="https://zcart.incevio.com/images/flags/BD.png">
                                            Bangla (Bangali)
                                        </option>
                                    </select>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header__main">
                <div class="container">
                    <div class="header__main-inner">
                        <div class="header__menu-icon">
                            <div class="menu-icon">
                                <a class="main-menu-toggle"><i class="fal fa-bars"></i></a>
                            </div>
                        </div>
                        <div class="header__logo">
                            @if(isset($shop))
                            <a href="{{ url('/shop',$shop->slug) }}">
                                <img src="{{ get_storage_file_url(optional($shop->logo)->path, 'full') }}" class="brand-logo" alt="Logo"
                                    title="Logo">
                            </a>
                            @elseif(Session::get('shop') != array(['','null']))
                            <a href="{{ url('/shop',Session::get('shop')->slug) }}">
                            <img src="{{ get_storage_file_url(optional(Session::get('shop')->logo)->path, 'full') }}" class="brand-logo">
                          </a>
                          @else
                          <a href="{{ url('/') }}">
                            <img src="{{ theme_asset_url('img/z commerce_logo.png')}}" class="brand-logo">
                          </a>
                          @endif
                        </div>

                        <div class="header__search">
                            
                            {!! Form::open(['route' => 'inCategoriesSearch', 'method' => 'GET', 'id' => 'search-categories-form', 'class' => 'navbar-left navbar-form navbar-search', 'role' => 'search']) !!}
                                <div class="search-box">
                                    <div class="search-box__select">
                                        <i class="fas fa-chevron-down"></i>
                                        <select class="category search-category-select" name="insubgrp">
                                            <option value="all">{{ trans('theme.all_categories') }}</option>

                                            @foreach($search_category_list as $slug => $category)
                                              <option value="{{ $slug }}"
                                                @if(Request::has('in'))
                                                 {{ Request::get('in') == $slug ? ' selected' : '' }}
                                                @endif
                                              >{{ $category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="search-box__input">
                                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => trans('theme.main_searchbox_placeholder')]) !!}
                                    </div>
                                    <div class="search-box__button">
                                        <button type="submit" class="navbar-search-submit"
                                            onclick="document.getElementById('search-categories-form').submit()">

                                            <i class="fal fa-search"></i>

                                        </button>

                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="header__utility">
                            <ul>
                                <!-- <li>
                                    <a href="https://zcart.incevio.com/my/account">
                                        <i class="fal fa-user"></i>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="{{ route('account', 'wishlist') }}">
                                        <i class="fal fa-heart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cart.index') }}">
                                        <i class="fal fa-shopping-basket"></i>
                                        <!-- <img src="images/shopping-bag.svg" alt=""> -->
                                        <span id="globalCartItemCount" class="badge">{{ cart_item_count() }}</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header__navigation">
                <div class="container">
                    <div class="header__navigation-inner">
                        <ul class="menu-dropdown-list header__navigation-category">
                            <li>
                                <a href="{{ route('categories') }}" class="menu-link" data-menu-link>

                                    <i class="fas fa-stream" style="margin-right: 10px;"></i>
                                    <span>{{ trans('theme.shop_by') }}</span>{{ trans('theme.category') }}
                                </a>
                                <ul class="menu-cat" data-menu-toggle>
                                    @foreach($all_categories as $catGroup)
                                    @if($catGroup->subGroups->count())
                                    <li>
                                        <a href="{{ route('categoryGrp.browse', $catGroup->slug) }}">
                                            <i class="fal fa {{ $catGroup->icon or 'fa-cube' }}"></i>
                                            <span>{{ $catGroup->name }}</span>
                                            <i class="fal fa-chevron-right"></i>
                                        </a>

                                        <div class="mega-dropdown">

                                            <div class="row">
                                                @foreach($catGroup->subGroups as $subGroup)
                                                <div class="col-lg-6">

                                                    <div class="mega-dropdown__item">
                                                        <h3><a
                                                                href="{{ route('categories.browse', $subGroup->slug) }}">{{ $subGroup->name }}</a></h3>
                                                        <ul>
                                                            @foreach($subGroup->categories as $cat)
                                                            <li><a
                                                                    href="{{ route('category.browse', $cat->slug) }}">{{ $cat->name }}</a>
                                                                @if($cat->description)
                                                                  <p>{{ $cat->description }}</p>
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                                @if($loop->iteration % 2 == 0)
                                                  <div class="clearfix"></div>
                                                @endif
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                                </ul>
                            </li>
                        </ul>

                        <ul class="header__menu">

                            <li>
                                <a class="menu-link" href="https://zcart.incevio.com/brands">
                                    <i class="fal fa-crown menu-icon"></i> Brands
                                </a>
                            </li>

                            <li>
                                <a class="menu-link" href="https://zcart.incevio.com/shops">
                                    <i class="fal fa-store menu-icon"></i> Vendors
                                </a>
                            </li>

                            <li>
                                <a class="menu-link" href="https://zcart.incevio.com/selling">
                                    <i class="fal fa-seedling menu-icon"></i> Sell On zCart
                                </a>
                            </li>


                        </ul>

                        <div class="shale-text">
                            <!-- <a style="text-decoration: none" href="/">
                                <p>40% off on kids item only</p>
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>


            <div class="main-menu mobile-mega-menu">
                <nav>
                    <div class="main-menu__top">
                        <div class="main-menu__top-inner">
                            <div class="main-menu__top-box">
                                <!-- <div class="main-menu__top-item"><a href="#"><i class="fal fa-user"></i></a></div> -->
                                <div class="main-menu__top-item">
                                    <a href="{{ route('account', 'wishlist') }}">
                                        <i class="fal fa-heart"></i>
                                    </a>
                                </div>
                                <!-- <div class="main-menu__top-item"><a href="#"><i class="fal fa-wallet"></i></a></div> -->
                                <div class="main-menu__top-item">
                                    <div class="form-group">
                                        <!-- <select name="" id="mobile-lang">
                                            <option value="en"
                                                data-imagesrc="https://zcart.incevio.com/images/flags/US.png">
                                                English
                                            </option>
                                            <option value="es"
                                                data-imagesrc="https://zcart.incevio.com/images/flags/ES.png">
                                                Spanish
                                            </option>
                                            <option value="fa"
                                                data-imagesrc="https://zcart.incevio.com/images/flags/IR.png">
                                                Persian
                                            </option>
                                            <option value="bn"
                                                data-imagesrc="https://zcart.incevio.com/images/flags/BD.png">
                                                Bangla (Bangali)
                                            </option>
                                        </select> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <ul class="main-menu-nav">
                        @foreach($all_categories as $catGroup)
                        @if($catGroup->subGroups->count())
                        <li>
                            <a href="{{ route('categoryGrp.browse', $catGroup->slug) }}">
                                {{ $catGroup->name }}
                            </a>
                            <ul>
                                @foreach($catGroup->subGroups as $subGroup)
                                <li>
                                    <a href="{{ route('categories.browse', $subGroup->slug) }}">{{ $subGroup->name }}</a>
                                    <ul>
                                        @foreach($subGroup->categories as $cat)
                                        <li> <a href="https://zcart.incevio.com/category/dslr">DSLR</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach
                    </ul>

                    <div class="main-menu__bottom">
                        <div class="main-menu__bottom-inner">
                            <div class="main-menu__bottom-box">
                                <!-- <div class="main-menu__bottom-item" ><a href="#"><i class="fal fa-map-marker-alt"></i><span>Store Location</span></a></div> -->
                                <div class="main-menu__bottom-item">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                                        <i class="fal fa-user"></i>
                                    </a>
                                </div>


                                <div class="main-menu__bottom-item"><a href=""><i
                                            class="fal fa-truck"></i></a></div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- Header end -->

        <div class="close-sidebar">
            <strong><i class="fal fa-times"></i></strong>
        </div>