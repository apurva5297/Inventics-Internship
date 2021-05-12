<div class="row">
  	<div class="col-md-6 nopadding-right">
	    <div class="form-group">
	    	<label>Marketplace</label>
	    	<select name="marketplace_id" class="form-control" required="required">
	    		<option>Select Marketplace</option>
	    		@foreach($marketplaces as $marketplace)
	    		@if(isset($a) && $marketplace->id == $a->marketplace_id)
	    		<option value="{{$marketplace->id}}" selected="selected">{{$marketplace->name}}</option>
	    		@else
	    		<option value="{{$marketplace->id}}">{{$marketplace->name}}</option>
	    		@endif
	    		@endforeach
	    	</select>
	    </div>
	</div>
	<div class="col-md-6 padding-right">
	    <div class="form-group">
	    	<label>Marketplace Module</label>
	    	<select id="marketplace_module_id" onChange="getModuleField(this.value);" name="marketplace_module_id" class="form-control" required="required">
	    		<option>Select Marketplace Module</option>
	    		
	    		@foreach($marketplace_modules as $marketplace_module)
	    		@if(isset($a) && $marketplace_module->id == $a->marketplace_module_id)
	    		<option value="{{$marketplace_module->id}}" selected="selected">{{ $marketplace_module->name }}</option>
	    		@else
	    		<option value="{{$marketplace_module->id}}">{{ $marketplace_module->name }}</option>
	    		@endif
	    		@endforeach
	    	</select>
	    </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered" id="module_field">
			<thead>
				<tr>
					<td>S.No</td>
					<td>Name</td>
					<td>Mapping Name</td>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>

<!-- <script>
    $('#marketplace_module_id').change(function(){
       var ids = $(this).val();
       
       //console.log(ids);
       $.ajax({
          type: "GET",
          url: "/admin/admin/marketplace-module-mapping/module_field/"+$.param({ids}),
          success: function (data) {
          	console.log(data);
              $("#module_field").html(data);
              $('#module_field').trigger("chosen:updated");
          }
       });
    });
</script>
 -->
<script>
    function getModuleField(val) {
        $.ajax({
            type: "GET",
            url: "/admin/admin/marketplace-module-mapping/module_field/"+val,
            success: function (data) {
                //$("#category_id").remove();
                $("#module_field tbody").html(data);
                $('#module_field tbody').trigger("chosen:updated");
            }
        });
    }
</script>

