<!-- FOOTER -->
<div class="main-footer" style="background: linear-gradient(to bottom right, #983EA0 0%, #6B1C9B 100%); color: #fff">
  <div class="container">
    <div class="col-xs-12 col-sm-12 col-md-5">
      <div class="footer-subscribe-form">
       @if(isset($shop))
      <a class="navbar-brand" href="{{ url('/shop',$shop->slug) }}">
        <img src="{{ get_storage_file_url(optional($shop->logo)->path, 'small') }}"><br />
      </a>
      <p style="text-align: justify;">{!! $shop->description !!}</p>

      @elseif(Session::get('shop') != array(['','null']))
      <div>
        <a class="navbar-brand" href="{{ url('/shop',Session::get('shop')->slug) }}">
        <img src="{{ get_storage_file_url(optional(Session::get('shop')->logo)->path, 'small') }}">
      </a>
    </div>
      <p style="text-align: justify;">{!! Session::get('shop')->description !!}</p>
      @else
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ theme_asset_url('img/z commerce_logo.png')}}" class="img-rounded">
      </a>
      @endif
      </div>
    </div>

    <!-- <div class="col-xs-12 col-sm-4 col-md-2">
      <h3 style="color: #fff">@lang('theme.nav.let_us_help')</h3>
      <ul class="footer-link-list">
        <li><a href="{{ route('account', 'dashboard') }}" rel="nofollow">@lang('theme.nav.your_account')</a></li>
        <li><a href="{{ route('account', 'orders') }}" rel="nofollow">@lang('theme.nav.your_orders')</a></li>
        @foreach($pages->where('position', 'footer_1st_column') as $page)
          <li><a href="{{ get_page_url($page->slug) }}" rel="nofollow" target="_blank">{{ $page->title }}</a></li>
        @endforeach
        {{-- <li><a href="{{ url('/blog') }}" target="_blank">@lang('theme.nav.blog')</a></li> --}}
      </ul>
    </div> -->

    <div class="col-xs-12 col-sm-4 col-md-3">
      <h3 style="color: #fff">Help Center</h3>
      <ul class="footer-link-list">
        @if(isset($shop))
        <li><i class="fa fa-phone"></i> {{$shop->owner->phone}}</li>
        <li><i class="fa fa-envelope"></i> {{$shop->email}}</li>
        @elseif(Session::get('shop') != array(['','null']))
        <li><i class="fa fa-phone"></i> {{Session::get('shop')->phone}}</li>
        <li><i class="fa fa-envelope"></i> {{Session::get('shop')->email}}</li>
        @else
        <li></li>
        @endif
      </ul>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-3">
      <h3 style="color: #fff">Localtion</h3>
      <ul class="footer-link-list" style="color: #fff">
        @if(isset($shop))
        <li>@if($shop->primaryAddress){!! $shop->primaryAddress->toHtml() !!}@endif</li>
        @elseif(Session::get('shop') != array(['','null']))
        <li> @if(Session::get('shop')->primaryAddress){!! Session::get('shop')->primaryAddress->toHtml() !!}@endif</li>
        @else
        <li></li>
        @endif
      </ul>
    </div>
  </div>
</div><!-- /.container -->

<!-- SECONDARY FOOTER -->
<footer class="user-helper-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div><!-- /.main-footer -->
</footer>