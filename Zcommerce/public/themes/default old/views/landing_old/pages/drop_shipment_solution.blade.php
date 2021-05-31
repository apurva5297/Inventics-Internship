@extends('landing.layout')

@section('content')
<section class="wow fadeIn cover-background background-position-top top-space" style="background-image:url({{ theme_asset_url('landing/breadcrumbs_banners/banner_1920x1100___12.png')}});">
            <div class="opacity-medium bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 d-flex flex-column text-center justify-content-center page-title-large padding-30px-tb">
                        <!-- start sub title -->
                        <span class="d-block text-white-2 opacity6 alt-font margin-5px-bottom">We are awesome</span>
                        <!-- end sub title -->
                        <!-- start page title -->
                        <h1 class="alt-font text-white-2 font-weight-600 mb-0">Drop Shipment Solution</h1>
                        <!-- end page title -->
                    </div>
                </div>
            </div>
        </section>
<section class="bg-light-gray wow fadeIn" style="visibility: visible; animation-name: fadeIn; padding-top: 50px; padding-bottom: 50px">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                        <h5 class="text-extra-dark-gray alt-font font-weight-600">Marketplace/Vendor Panel Solution</h5>
                        <p class="text-medium line-height-30 text-medium-gray">We understand the ever changing ecommerce trends and challenges faced by e-tailers to code, re-create and manage a marketplace management solution, that’s why we offer cloud base marketplace panel solutions to meet the needs of dynamic ecommerce Industry.

Enable your seller to ship the product directly to the consumers Using Zcommerce Vendor panel solution.</p>
                    </div>
                </div>
            </div>
            
        </section>

        <section class="wow fadeIn" style="visibility: visible; animation-name: fadeIn; padding-top: 50px; padding-bottom: 50px">
        	<div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                    	<img src="{{ theme_asset_url('landing/img/marketplace_fbvtxa.png')}}" />
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                        <h5 class="text-extra-dark-gray alt-font font-weight-600">Returns Management</h5>
                        <p class="text-medium line-height-30 text-medium-gray">Organizations with optimized returns management has better customer experience and satisfaction score from the one’s who don’t, we understand the efforts required to acquire a customer, hence, our comprehensive returns management flow enables the companies to offer similar order and returns experience with functions to differentiate the customer initiated returns to Direct courier returns and act accordingly.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-light-gray wow fadeIn" style="visibility: visible; animation-name: fadeIn; padding-top: 50px; padding-bottom: 50px">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-5 last-paragraph-no-margin">
                        <h5 class="text-extra-dark-gray alt-font font-weight-600">Key Benefits</h5>
                        <ul>
							<li>&nbsp;Strong vendor relationship</li>
							<li>&nbsp;High product assortments</li>
							<li>&nbsp;Low inventory carrying cost</li>
							<li>&nbsp;Low stock outs</li>
							<li>&nbsp;Faster delivery time</li>
							<li>&nbsp;Investor friendly</li>
						</ul>
                    </div>
                    <div class="col-12 col-lg-7 last-paragraph-no-margin">
                    	<img src="{{ theme_asset_url('landing/img/warehouseinfographic_saoure.png')}}">
                    </div>
                </div>
            </div>
            
        </section>
@endsection