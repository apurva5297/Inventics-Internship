<div class="product-info-price">
    <span class="old-price" style="display: {{$item->hasOffer() ? '' : 'none'}}">{!! get_formated_price($item->sale_price, 2) !!}</span>
    <?php  	
    	/*$set=$item->set_size;
    	$pp=floor($item->currnt_sale_price());
    	$total=@($pp/$set);*/
    	$total=$item->currnt_sale_price();
    ?>
    <span class="product-info-price-new">{!! get_formated_price($total ,2) !!}/-</span>

    <ul class="product-info-feature-labels hidden">
	    @if($item->free_shipping == 1)
	        <li class="">@lang('theme.free_shipping')</li>
	    @endif
	    @if($item->hasOffer())
	        <li class="">@lang('theme.percent_off', ['value' => get_percentage_of($item->sale_price, $item->offer_price)])</li>
	    @endif
	    @if($item->stuff_pick == 1)
	        <li class="">@lang('theme.stuff_pick')</li>
	    @endif
	    @if($item->orders_count >= config('system.popular.hot_item.sell_count', 3))
	        <li class="">@lang('theme.hot_item')</li>
	    @endif
	</ul>
</div>