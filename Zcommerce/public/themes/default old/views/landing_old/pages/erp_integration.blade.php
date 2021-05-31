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
                        <h1 class="alt-font text-white-2 font-weight-600 mb-0">ERP Integration</h1>
                        <!-- end page title -->
                    </div>
                </div>
            </div>
        </section>
<section class="bg-light-gray wow fadeIn" style="visibility: visible; animation-name: fadeIn; padding-top: 50px; padding-bottom: 50px">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                        
                        <p class="text-medium line-height-30 text-medium-gray">Many times the business organisations have to maintain a range of software solutions for each function and employ resources to update those systems. Since backend operations have a lot of processes to take care of manual data updations in each system is a huge task! Manual data handling has the risk of errors and duplications.

Zcommerce is one such complete operations management solution that seamlessly integrates with various functions and ERPs in an organisation. This e-commerce solution is designed to assimilate and share process data without error or duplication on all the other existing ERP platforms.</p>
                    </div>
                </div>
            </div>
            
        </section>

        <section class="wow fadeIn" style="visibility: visible; animation-name: fadeIn; padding-top: 50px; padding-bottom: 50px">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                        <h5 class="text-extra-dark-gray alt-font font-weight-600">Solution Overview:</h5>
                        <p class="text-medium line-height-30 text-medium-gray">
                        	<img src="{{ theme_asset_url('landing/img/ERP-Intigration_gzfnpj.png')}}" style="float: left; padding:0 50px 0 0">
                        	The Zcommerce is feature rich.

It comes pre-loaded with GST compliances
                        <ul>
<li>You can update your GSTIN, GST tax class, and HSN codes in Zcommerce.</li>
<li>You can access GST ready invoice templates for B2B and B2C businesses.</li>
<li>You can upload signature in the Zcommerce solution.</li>
<li>You can fetch marketplace invoices with their invoice series and date of creation in Zcommerce.</li>
</ul>
Zcommerce is an e-commerce solution that has an inbuilt ecosystem to impeccably capture the online business information regarding orders, inventory, returns, shipment etc. across 40+ marketplaces into your existing ERP ( Navision, Oracle, SAP and any other).</p>
                    </div>
                </div>
            </div>
        </section>
        
@endsection