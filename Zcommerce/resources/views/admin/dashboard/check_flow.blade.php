@extends('admin.layouts.master')

@section('page-style')
	@include('plugins.ionic')
	<style type="text/css">
		.timeline-centered {
    position: relative;
    margin-bottom: 30px;
    margin-top: 13px;
}

    .timeline-centered:before, .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before, .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before {
        content: '';
        position: absolute;
        display: block;
        width: 4px;
        background: #f5f5f6;
        left: 5%;
        top: 20px;
        bottom: 20px;
        margin-left: -4px;
        border: 2px dotted #007AFF ;
    }

   div .timeline-centered:last-child:before{
         background: red;
  }

    .timeline-centered .timeline-entry {
        position: relative;
        width: 95%;
        float: right;
        margin-bottom: 70px;
        clear: both;
    }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry.begin {
            margin-bottom: 0;
        }

        .timeline-centered .timeline-entry.left-aligned {
            float: left;
        }

            .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner {
                margin-left: 0;
                margin-right: -18px;
            }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-time {
                    left: auto;
                    right: -100px;
                    text-align: left;
                }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-icon {
                    float: right;
                }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label {
                    margin-left: 0;
                    margin-right: 70px;
                }

                    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label:after {
                        left: auto;
                        right: 0;
                        margin-left: 0;
                        margin-right: -9px;
                        -moz-transform: rotate(180deg);
                        -o-transform: rotate(180deg);
                        -webkit-transform: rotate(180deg);
                        -ms-transform: rotate(180deg);
                        transform: rotate(180deg);
                    }

        .timeline-centered .timeline-entry .timeline-entry-inner {
            position: relative;
            margin-left: -22px;
        }

            .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
                content: " ";
                display: table;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:after {
                clear: both;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
                content: " ";
                display: table;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:after {
                clear: both;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time {
                position: absolute;
                left: -100px;
                text-align: right;
                padding: 10px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span {
                    display: block;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:first-child {
                        font-size: 14px;
                        font-weight: bold;
                    }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:last-child {
                        font-size: 12px;
                    }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon {
                background: #fff;
                color: #737881;
                display: block;
                width: 20px;
                height: 20px;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;
                text-align: center;
                -moz-box-shadow: 0 0 0 5px #f5f5f6;
                -webkit-box-shadow: 0 0 0 5px #f5f5f6;
                box-shadow: 0 0 0 5px #f5f5f6;
                line-height: 40px;
                font-size: 15px;
                float: left;
                margin-left: 10px;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-primary {
                    background-color: #303641;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-secondary {
                    background-color: #ee4749;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon {
                    background-color: #fff;
                    border: 5px solid #007AFF ;
                }

               

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label {
                /*position: relative;
                background: #f5f5f6;*/
                padding: 1.7em;
                margin-left: 33;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label:after {
                    content: '';
                    display: block;
                    position: absolute;
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 9px 9px 9px 0;
                    border-color: transparent #f5f5f6 transparent transparent;
                    left: 0;
                    top: 10px;
                    margin-left: -9px;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2, .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p {
                    color: #737881;
                    font-family: "Noto Sans",sans-serif;
                    font-size: 12px;
                    margin: 0;
                    line-height: 1.428571429;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p + p {
                        margin-top: 15px;
                    }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 {
                    font-size: 16px;
                    margin-bottom: 10px;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 a {
                        color: #303641;
                    }

.timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 span {
    -webkit-opacity: .6;
    -moz-opacity: .6;
    opacity: .6;
    -ms-filter: alpha(opacity=60);
    filter: alpha(opacity=60);
}

.timeline-centered:last-child {
        background-color: white;
    }

   div .timeline-centered:last-child{
         background: white;
  }
	</style>


    <style type="text/css">
        .card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  background-color: #fff;
  border-radius: 10px;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
        /* Style the tab */
.tab {
  float: left;
  border-left: 1px solid #ccc;
  order-top: 1px solid #ccc;
  order-bottom: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 30%;
  height: 300px;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
  border-style: 1px solid #ccc;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #fff;
  border-left: 4px solid #4dc1f0;
  border-top: 4px solid #4dc1f0;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 70%;
  border-left: none;
  height: 300px;
}
    </style>
@endsection

@section('content')

	@include('admin.partials._subscription_notice')
	@include('admin.dashboard.select_category_form')

    @if(! Auth::user()->isVerified())
		<div class="alert alert-info alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
			{{ trans('messages.email_verification_notice') }}
	    	<a href="{{ route('verify') }}">{{ trans('app.resend_varification_link') }}</a>
		</div>
    @endif

    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2 card">
            <div class="alert alert-info" style="border-radius: 10px">
                <h3 style="margin:0">Get ready to sale online. Try these tips to get started.</h3>
            </div>
            <div class="tab">
              <button class="tablinks" onclick="openCity(event, 'Product')" id="defaultOpen"><i class="fa fa-cube"></i> &nbsp;&nbsp; Product</button>
              <button class="tablinks" onclick="openCity(event, 'Inventory')"><i class="fa fa-cubes"></i> &nbsp;&nbsp; Inventory</button>
              <button class="tablinks" onclick="openCity(event, 'logo')"><i class="fa fa-photo"></i> &nbsp;&nbsp; Shop Logo</button>
              <button class="tablinks" onclick="openCity(event, 'shopprimaryaddress')"><i class="fa fa-university"></i> &nbsp; &nbsp; Shop Address</button>
            </div>

            <div id="Product" class="tabcontent">
              <h3>Add your first product</h3>
              <p>Add your catalog to present in your shop.</p>
              @if(count($products) < 0)
              <a href="{{ route('admin.catalog.product.create') }}" class="btn btn-success">Add Product</a>
              @endif
            </div>

            <div id="Inventory" class="tabcontent">
              <h3>Add your first inventory</h3>
              <p>Create your inventory by that your shop product ready for customer</p> 
              @if(count($inventories) < 0)
              <a href="{{ route('admin.stock.inventory.index')}}" class="btn btn-success">Add Inventory</a>
              @endif
            </div>

            <div id="logo" class="tabcontent">
              <h3>Add your shop logo</h3>
              <p>create your logo and upload to make your shop more attractive</p>
              @if(empty($shops->image))
              <a href="{{ url('admin/setting/general') }}" class="btn btn-success">Logo & Banner</a>
              @endif
            </div>

            <div id="shopprimaryaddress" class="tabcontent">
              <h3>Add your shop location</h3>
              <p>Your shop location is helpful for your customer.</p>
              @if(!$shops->primaryAddress)
              <a href="{{ url('admin/setting/general') }}" class="btn btn-success">Shop Address</a>
              @endif
            </div>
        </div>
    </div>
    
@endsection

@section('page-script')
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
   
@endsection
