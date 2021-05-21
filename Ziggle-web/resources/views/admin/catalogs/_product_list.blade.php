<div class="admin-user-widget">
    <span class="admin-user-widget-img">
        <img src="{{ get_catalog_featured_img_src($product->id, 'small') }}" class="thumbnail" alt="{{ trans('app.image') }}">
    </span>
    <div class="admin-user-widget-content">
        <span class="admin-user-widget-title">
            {{ $product->name }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ $product->gtin_type ?? 'GTIN: ' }} {{ ': '.$product->gtin }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ trans('app.model_number').': '.$product->model_number }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ trans('app.brand').': '.$product->brand }}
        </span>

        <span class="option-btn" style=" margin-top: -50px;">

            @if(!empty($p))
            <div id="button_delete_id<?=$product->id?>">
            <button type="submit"  class="btn bg-purple btn-flat" onclick="delete_catalogs({{$product->id}},{{$catalog_id}})"> <span > Added </span></button>
            </div>
            @else
            <div id="button_id<?=$product->id?>">
            <button type="submit"  class="btn bg-purple btn-flat" onclick="add_catalogs({{$product->id}},{{$catalog_id}})"><span > Add to Catalogs</span> </button>
            </div>
            @endif            
        </span>
    </div>            <!-- /.admin-user-widget-content -->
</div>          <!-- /.admin-user-widget -->
<script>
function add_catalogs(product_id,cat_id)
{ 
    $.ajax({
				type : "GET",
				data : {product_id:product_id,cat_id:cat_id},
                url : "/admin/catalog/test",
				success:function(response)
				{
				//	console.log(response);
                $("#button_id"+product_id).html("<div id='button_delete_id"+product_id+"'><button type='submit' class='btn bg-purple btn-flat' onclick='delete_catalogs("+product_id+','+cat_id+")'><span >Added</span></button></div>");
                }
			});

}
function delete_catalogs(product_id,cat_id)
{
    $.ajax({
				type : "GET",
				data : {product_id:product_id,cat_id:cat_id},
                url : "/admin/catalog/test_delete",
				success:function(response)
				{
				//	console.log(response);
               // $("#button_delete_id"+product_id).html("Add to Catalogs");
               $("#button_delete_id"+product_id).html("<div id='button_id"+product_id+"'><button type='submit' class='btn bg-purple btn-flat' onclick='add_catalogs("+product_id+','+cat_id+")'><span>Add to Catalogs</span></button></div>");
                }
			});

}
</script>