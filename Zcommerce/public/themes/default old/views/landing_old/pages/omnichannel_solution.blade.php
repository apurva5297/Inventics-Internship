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
                        <h1 class="alt-font text-white-2 font-weight-600 mb-0">Ominchannel Solution</h1>
                        <!-- end page title -->
                    </div>
                </div>
            </div>
        </section>
<section class="bg-light-gray wow fadeIn" style="visibility: visible; animation-name: fadeIn; padding-top: 50px; padding-bottom: 50px">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                        <!-- <h5 class="text-extra-dark-gray alt-font font-weight-600">What is Multichannel retailing?</h5> -->
                        <p class="text-medium line-height-30 text-medium-gray">Zcommerce Omni commerce platform enables central management of orders and inventory of online & offline stores.It also helps e-retailers in the routing of an online order to nearest store, thus providing a uniform experience to customers and also leads to minimized logistics cost.</p>
                        <h5 class="text-extra-dark-gray alt-font font-weight-600">What is Omnichannel?</h5>
                        <p>Omnichannel retail means utilising multiple sales channels to provide the customers with a seamless shopping experience.

Wikipedia defines omnichannel commerce as: “a cross-channel business model that companies use to improve their customer experience.”


End user-centric domains such as retail, financial services, healthcare, government establishments, telecommunication are the front-runners in employing omnichannel business models.</p>
                    </div>
                </div>
            </div>
            
        </section>

        <section class="wow fadeIn" style="visibility: visible; animation-name: fadeIn; padding-top: 50px; padding-bottom: 50px">
        	<div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                    	<img src="{{ theme_asset_url('landing/img/Omni-vs-Multi_g2etng.jpg')}}" />
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                        <h5 class="text-extra-dark-gray alt-font font-weight-600">Difference between Omnichannel and Multichannel</h5>
                        <p class="text-medium line-height-30 text-medium-gray">In multi-channel approach, the brand or the company’s product takes center stage and, the various means of sales and marketing (online store, physical storefront, e-commerce sites, and social network sites) provide shopping options to the customers.

In omnichannel approach, the customer takes center stage while all the above-stated multi-channels overlap to give the customer a best possible shopping experience upholding the brand value.

A multi-channel business focuses on making the product or service available to the customers in as many ways as possible and letting him choose to shop through any of them.

An omnichannel business focuses on creating an uninterrupted experience for the customer through multi-channels; irrespective of the medium he chooses to shop.</p>
                    </div>
                </div>
            </div>
        </section>
        
@endsection