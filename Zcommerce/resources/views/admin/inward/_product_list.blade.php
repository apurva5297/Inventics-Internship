<div class="admin-user-widget" style="height: 168px!important;font-weight: bold;">
    <span class="admin-user-widget-img">
        <img src="{{ get_storage_file_url(optional($inventory->image)->path, 'small') }}" class="thumbnail" alt="{{ trans('app.image') }}">
    </span>
    <div class="admin-user-widget-content">
        <span class="admin-user-widget-title">
            {{ $inventory->title }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ 'Sku: '.$inventory->sku }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ 'Stock: '.App\Helpers\ListHelper::inventory_bin_stock($inventory->id) }}
        </span>
         <span class="admin-user-widget-text text-muted">
            {{ 'Bar Code: '.$inventory->barcode }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ 'QR Code: '.$inventory->qrcode }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{'Purchase Price : '.floatval($inventory->purchase_price)  }}
        </span>
         <span class="admin-user-widget-text text-muted">
            {{'Sale Price : '.floatval($inventory->sale_price)  }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ trans('app.brand').': '.$inventory->brand }}
        </span>

        <span class="option-btn" style=" margin-top: -50px;">
            <span data-id="{{$inventory->id}}" onclick="addToBin(this)" class="btn bg-purple btn-flat">Add To Bin</span>
        </span>
    </div>            <!-- /.admin-user-widget-content -->
</div>          <!-- /.admin-user-widget -->