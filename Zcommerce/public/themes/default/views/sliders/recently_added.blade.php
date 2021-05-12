<!-- Recently Added -->
    
    <section>
    <div class="neckbands">
        <div class="container">
            <div class="neckbands__inner">
                <div class="neckbands__header">
                    <div class="sell-header sell-header--bold">
                        <div class="sell-header__title">
                            <h2>Recently Added</h2>
                        </div>
                        <div class="header-line">
                            <span></span>
                        </div>
                        <div class="best-deal__arrow">
                            <ul>
                                <li><button class="left-arrow slider-arrow slick-arrow neckbands-left"><i class="fal fa-chevron-left"></i></button></li>
                                <li><button class="right-arrow slider-arrow slick-arrow neckbands-right"><i class="fal fa-chevron-right"></i></button></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="neckbands__items">
                    <div class="neckbands__items-inner">
                        @foreach($products as $item)
                        <div class="recent__items-box box">
                            <a href="{{ route('show.product', $item->slug) }}">
                                <div class="recent__items-img box-img">
                                    <img src="@if($item->image){{ get_storage_file_url(optional($item->image)->path, 'medium') }} @else @endif {{asset('images/placeholders/no_img.png')}}" data-name="product_image" alt="{{ $item->title }}" title="{{ $item->title }}">
                                </div>
                            </a>    
                            <div class="recent__items-title box-title">
                                <a href="{{ route('show.product', $item->slug) }}">{{ $item->title }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>