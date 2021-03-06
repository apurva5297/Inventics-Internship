@if($returns)
  <table class="table" id="buyer-order-table">
      <thead>
          <tr>
            <th colspan="3">@lang('theme.your_order_history')</th>
          </tr>
      </thead>
      <tbody>
        @foreach($returns as $return)
          <tr class="order-info-head">
              <td width="55%">
                <h5><span>@lang('theme.order_id'): </span>{{ $return->order_number }}</h5>
                <h5><span>Return Date: </span>{{ date('d M Y',strtotime($return->created_at)) }}</h5>
              </td>
              <td width="25%" class="store-info">
                <h5>
                  <span>@lang('theme.store'):</span>
                  @if($return->shop->name)
                    <a href="{{ route('show.store', $return->shop->slug) }}"> {{ $return->shop->name }}</a>
                  @else
                    @lang('theme.store_not_available')
                  @endif
                </h5>
                <h5>
                    <span>@lang('theme.status')</span>
                    {{ $return->ReturnStatus->name }}
                </h5>
              </td>
              <td width="20%" class="order-amount">
                <h5><span>@lang('theme.order_amount'): </span>{{ get_formated_currency($return->grand_total) }}</h5>
                <div class="btn-group" role="group">
                  <a class="btn btn-xs btn-default flat" href="{{ route('order.return', $return->id) }}">@lang('theme.button.order_detail')</a>
                  <a class="btn btn-xs btn-default flat" href="{{ route('order.return', $return->id) . '#message-section' }}">@lang('theme.button.contact_seller')</a>
                </div>
              </td>
          </tr> <!-- /.order-info-head -->

          @foreach($return->inventories as $item)
            <tr class="order-body">
              <td colspan="2">
                  <div class="product-img-wrap">
                    <img src="{{ get_storage_file_url(optional($item->image)->path, 'small') }}" alt="{{ $item->slug }}" title="{{ $item->slug }}" />
                  </div>
                  <div class="product-info">
                      <a href="{{ route('show.product', $item->slug) }}" class="product-info-title">{!!  $item->pivot->item_description !!}</a>
                      <div class="order-info-amount">
                          <span>{{ get_formated_currency($item->pivot->unit_price) }} x {{ $item->pivot->quantity }}</span>
                      </div>
                      {{--
                      <ul class="order-info-properties">
                          <li>Size: <span>L</span></li>
                          <li>Color: <span>RED</span></li>
                      </ul> --}}
                  </div>
              </td>
              @if($loop->first)
                <td rowspan="{{ $loop->count }}" class="order-actions">
                  <!-- <a href="{{ route('order.track', $return->id) }}" class="btn btn-default btn-sm btn-block flat">@lang('theme.button.track_order')</a> -->
                  @if($return->goods_received)
                    <a href="{{ route('order.feedback', $return->id) }}" class="btn btn-primary btn-sm btn-block flat">@lang('theme.button.give_feedback')</a>
                  @else
                    {!! Form::model($return->id, ['method' => 'PUT', 'route' => ['goods.received', $return->id]]) !!}
                      {!! Form::button(trans('theme.button.confirm_goods_received'), ['type' => 'submit', 'class' => 'confirm btn btn-primary btn-block flat', 'data-confirm' => trans('theme.confirm_action.goods_received')]) !!}
                    {!! Form::close() !!}
                  @endif
                  
                </td>
              @endif
            </tr> <!-- /.order-body -->
          @endforeach

          @if($return['message_to_customer'])
            <tr class="message_from_seller">
              <td colspan="3">
                <p>
                  <strong>@lang('theme.message_from_seller'): </strong> {!! $return['message_to_customer'] !!}
                </p>
              </td>
            </tr>
          @endif

          @if($return['buyer_note'])
            <tr class="order-info-footer">
              <td colspan="3">
                <p class="order-detail-buyer-note">
                  <span>@lang('theme.note'): </span> {!! $return['buyer_note'] !!}
                </p>
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
  </table>
  <div class="sep"></div>
@else
  <div class="clearfix space50"></div>
  <p class="lead text-center space50">
    @lang('theme.no_order_history')
    <a href="{{ url('/') }}" class="btn btn-primary btn-sm flat">@lang('theme.button.shop_now')</a>
  </p>
@endif

<div class="row pagenav-wrapper">
  {{ $returns->links('layouts.pagination') }}
</div><!-- /.row .pagenav-wrapper -->
<div class="clearfix space20"></div>