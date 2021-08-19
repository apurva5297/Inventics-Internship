@extends('Layout.ProductPage.Product')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-header">{{ __('OTP Verification') }}</div>


                    <div class="error"></div>
                    <div class="success"></div>
                    <form id="frm-mobile-verification"  method="POST" action="{{ route('verifyotp') }}">

                        {{ csrf_field() }}
                        <div class="form-group row mb-0">
                            <!-- <div class="col-md-6 offset-md-4">
                                    <label>OTP is sent to Your Mobile Number</label>
                                </div>
                            </div> -->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="hidden"  name="Phoneno" class="form-input" value="{{$phone_no}}" >
                                    <input type="number"  id="mobileOtp" name="OTP" class="form-input" placeholder="Enter the OTP">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input id="verify" type="submit" class="btn btn-primary" value="Verify;" >
                                </div>
                            </div>
                    </form>
                    <!-- <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" onClick="sendOTP()" value="send OTP;">
                            </button>
                         </div>
                    </div>

                    -->
                <!-- <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                    </button>

@if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                        </a>
@endif

                    </div>
                </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<!-- <script>
function verifyOTP() {
	$(".error").html("").hide();
	$(".success").html("").hide();
	var otp = $("#mobileOtp").val();
	var input = {
		"otp" : otp,
		"action" : "verify_otp"
	};
	if (otp == 123456 && otp != null) {
		$.ajax({
			url : 'home',
			type : 'POST',
			dataType : "json",

			data : input,
			success : function(response) {
				$("." + response.type).html(response.message)
				$("." + response.type).show();
			},
			error : function() {
				alert("successfully logged in");
			}
		});
	} else {
		$(".error").html('You have entered wrong OTP.')
		$(".error").show();
	}
}
</script> -->
