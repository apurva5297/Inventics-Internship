@if(Auth::user()->merchantId() && count(Auth::user()->shopCategory()) < 1)

<div class="container" style="padding: 50px">
  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal" id="myModal" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h5>Set Your Shop</h5>
        </div>
        <div class="modal-body">
          <form class="form" action="{{url('admin/create_shop_category')}}" method="post" enctype="multipart/form-data">
          	@csrf
          	<div class="row">
          		<div class="col-md-12">
		          	<div class="form-group">
		          		<label>Main Category<sup>*</sup></label>
		          		<select onChange="getCategoryGroups(this.value);" name="master_category[]" class="form-control" required="required">
		          			<option value="">Select Main Category</option>
		          			@foreach(\ListHelper::masterCategory() as $master_category)
		          			<option value="{{$master_category->cate_id}}">{{$master_category->name}}</option>
		          			@endforeach
		          		</select>
		          	</div>
		          </div>
		      </div>
		      <div class="row">
          		<div class="col-md-12">
		          	<div class="form-group">
		          		<label>Category Group<sup>*</sup></label>
		          		<select name="category_group[]" id="category_group_id" class="form-control select2-normal" multiple="multiple" required="required">
		          			
		          		</select>
		          	</div>
		          </div>
		      </div>
		      <div class="row">
          		<div class="col-md-12">
		          	<div class="form-group">
		          		<label>Sub Category<sup>*</sup></label>
		          		<select name="sub_category[]" id="sub_category_id1" class="form-control select2-normal" multiple="multiple" required="required">
		          			
		          		</select>
		          	</div>
		          </div>
		      </div>
		      <div class="row">
          		<div class="col-md-12">
		          	<div class="form-group">
		          		<label>Shop Logo (160px X 50px)</label>
		          		<input type="file" name="image" id="image" class="form-control" onChange="validateimg(this)">
                  <span style="color: #ff0000" id="image_error"></span>
		          	</div>
		          </div>
		      </div>
		      <div class="row">
          		<div class="col-md-12">
		          	<div class="form-group">
		          		<label>Shop Banner (1368px X 305px)</label>
		          		<input type="file" name="cover_image" id="cover_image" class="form-control" onChange="validatecoverimg(this)">
                  <span style="color: #ff0000" id="cover_image_error"></span>
		          	</div>
		          </div>
		      </div>
		      <div class="row">
          		<div class="col-md-12">
		          	<div class="form-group">
		          		<center><input type="submit" value="submit" class="btn btn-primary" style="border-radius: 20px; width: 150px; height: 35px"></center>
		          	</div>
		          </div>
		      </div>
          </form>
        </div>
        <div class="model-footer"></div>
      </div>
      
    </div>
  </div>
  
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
	$(window).on('load', function() {
        $('#myModal').modal('show');
    });
  $('#myModal').modal({backdrop: 'static', keyboard: false}) 
    function getCategoryGroups(val) {
        $.ajax({
            type: "GET",
            url: "/admin/ajax-get-category_group/"+val,
            success: function (data) {
            	console.log('data');
                $("#category_group_id").html(data);
                $('#category_group_id').trigger("chosen:updated");
            }
        });
    };

    $(function() {
    $('#category_group_id').change(function(e) {
    	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var selected = $(e.target).val();
        $.ajax({
            type: "POST",
            url: "/admin/ajax-get-sub_category",
            data: {_token: CSRF_TOKEN, category_group_id : selected},
            success: function (data) {
                $("#sub_category_id1").html(data);
                $('#sub_category_id1').trigger("chosen:updated");
            }
        });
    }); 
});

function validateimg(ctrl) { 
        var fileUpload = ctrl;
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (fileUpload.files) != "undefined") {
                var reader = new FileReader();
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        var height = this.height;
                        var width = this.width;
                        if (height > 50 || width > 160) {
                            $('#image').val("");
                            $('#image_error').text("Image dimension should be less than 160px X 50px");
                            return false;
                        }else{
                            
                            e.preventDefault();
                        }
                    };
                }
            } else {
                alert("This browser does not support HTML5.");
                return false;
            }
        } else {
            alert("Please select a valid Image file.");
            return false;
        }
    }

    function validatecoverimg(ctrl) { 
        var fileUpload = ctrl;
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (fileUpload.files) != "undefined") {
                var reader = new FileReader();
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        var height = this.height;
                        var width = this.width;
                        if (height > 305 || width > 1368) {
                            $('#cover_image').val("");
                            $('#cover_image_error').text("Image dimension should be less than 1368px × 305px");
                            return false;
                        }else{
                            
                            return true;
                        }
                    };
                }
            } else {
                alert("This browser does not support HTML5.");
                return false;
            }
        } else {
            alert("Please select a valid Image file.");
            return false;
        }
    }
    
</script>
@endif