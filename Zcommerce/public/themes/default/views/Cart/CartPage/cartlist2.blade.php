@foreach($carts as $cart)
<div class="col-lg-11 col-xl-13">
    <div class="cart-table {{$expressId == $cart->id ? 'selected' : ''}}" id="cartId{{$cart->id}}" data-cart="{{$cart->id}}">

      <div class="cart-table-prd cart-table-prd--head py-1 d-none d-md-flex">
        <div class="cart-table-prd-image text-center">
          Image
        </div>
        <div class="cart-table-prd-content-wrap">
          <div class="cart-table-prd-info">Name</div>
          <div class="cart-table-prd-qty">Qty</div>
          <div class="cart-table-prd-price">Price</div>
          <div class="cart-table-prd-action">&nbsp;</div>
        </div>
      </div>
 
 @if($cart->is_sample == 1)
 @foreach($cart->inventories as $item)
      <div class="cart-table-prd " id="cartId{{$cart->id}}">
        <div class="cart-table-prd-image">
          <a href="product.html" class="prd-img"><img class="lazyload fade-up" src="{{ get_storage_file_url(optional($item->image)->path, 'mini') }}" alt="{{ $item->slug }}" title="{{ $item->slug }}"  data-src="images/skins/fashion/products/product-01-1.jpg" alt=""></a>
        </div>
        <div class="cart-table-prd-content-wrap">
          <div class="cart-table-prd-info">
            <div class="cart-table-prd-price">
              {{-- <div class="price-old">$200.00</div> --}}
              <div> 
              {{-- id="item-price{{$cart->id}}-{{$item->id}}" data-value="{{$unit_price}}">{{ number_format($unit_price, 2, '.', '') }} --}}
            </div>
            </div>
            <h2 class="cart-table-prd-name"><a href="product.html">{{ $item->pivot->item_description }}</a></h2>
          </div>
          <div class="cart-table-prd-qty">
            <div class="qty qty-changer">
              <button class="decrease"></button>
              <input type="text" class="qty-input" value="2" data-min="0" data-max="1000">
              <button class="increase"></button>
            </div>
          </div>
          <div class="cart-table-prd-price-total">
            $360.00
          </div>
        </div>
        <div class="cart-table-prd-action">
          <a href="#" class="cart-table-prd-remove" data-tooltip="Remove Product"><i class="icon-recycle"></i></a>
        </div>
      </div>
 @endforeach   
 @else
 @foreach($cart->inventories as $item)
 <div class="cart-table-prd " id="cartId{{$cart->id}}">
   <div class="cart-table-prd-image">
     <a href="product.html" class="prd-img"><img class="lazyload fade-up" src="{{ get_storage_file_url(optional($item->image)->path, 'mini') }}" alt="{{ $item->slug }}" title="{{ $item->slug }}"  data-src="images/skins/fashion/products/product-01-1.jpg" alt=""></a>
   </div>
   <div class="cart-table-prd-content-wrap">
     <div class="cart-table-prd-info">
       <div class="cart-table-prd-price">
         {{-- <div class="price-old">$200.00</div> --}}
         <div> 
         {{-- id="item-price{{$cart->id}}-{{$item->id}}" data-value="{{$unit_price}}">{{ number_format($unit_price, 2, '.', '') }} --}}
       </div>
       </div>
       <h2 class="cart-table-prd-name"><a href="product.html">{{ $item->pivot->item_description }}</a></h2>
     </div>
     <div class="cart-table-prd-qty">
       <div class="qty qty-changer">
         <button class="decrease"></button>
         <input type="text" class="qty-input" value="2" data-min="0" data-max="1000">
         <button class="increase"></button>
       </div>
     </div>
     <div class="cart-table-prd-price-total">
       $360.00
     </div>
   </div>
   <div class="cart-table-prd-action">
     <a href="#" class="cart-table-prd-remove" data-tooltip="Remove Product"><i class="icon-recycle"></i></a>
   </div>
 </div>
 @endforeach
 @endif


      {{-- <div class="cart-table-prd">
        <div class="cart-table-prd-image">
          <a href="product.html" class="prd-img"><img class="lazyload fade-up" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-16-1.jpg" alt=""></a>
        </div>
        <div class="cart-table-prd-content-wrap">
          <div class="cart-table-prd-info">
            <div class="cart-table-prd-price">
              <div class="price-new">$220.00</div>
            </div>
            <h2 class="cart-table-prd-name"><a href="product.html">Cascade Casual Shirt</a></h2>
          </div>
          <div class="cart-table-prd-qty">
            <div class="qty qty-changer">
              <button class="decrease"></button>
              <input type="text" class="qty-input" value="2" data-min="0" data-max="1000">
              <button class="increase"></button>
            </div>
          </div>
          <div class="cart-table-prd-price-total">
            $360.00
          </div>
        </div>
        <div class="cart-table-prd-action">
          <a href="#" class="cart-table-prd-remove" data-tooltip="Remove Product"><i class="icon-recycle"></i></a>
        </div>
      </div>
      <div class="cart-table-prd">
        <div class="cart-table-prd-image">
          <a href="product.html" class="prd-img"><img class="lazyload fade-up" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/skins/fashion/products/product-02-1.jpg" alt=""></a>
        </div>
        <div class="cart-table-prd-content-wrap">
          <div class="cart-table-prd-info">
            <div class="cart-table-prd-price">
              <div class="price-new">$75.00</div>
            </div>
            <h2 class="cart-table-prd-name"><a href="product.html">Oversize Cotton Dress</a></h2>
          </div>
          <div class="cart-table-prd-qty">
            <div class="qty qty-changer">
              <button class="decrease"></button>
              <input type="text" class="qty-input" value="2" data-min="0" data-max="1000">
              <button class="increase"></button>
            </div>
          </div>
          <div class="cart-table-prd-price-total">
            $360.00
          </div>
        </div>
        <div class="cart-table-prd-action">
          <a href="#" class="cart-table-prd-remove" data-tooltip="Remove Product"><i class="icon-recycle"></i></a>
        </div>
      </div> --}}
    </div>
    </div>
    @endforeach