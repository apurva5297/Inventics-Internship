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
                        <h1 class="alt-font text-white-2 font-weight-600 mb-0">Warehouse Management</h1>
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
                        <p class="text-medium line-height-30 text-medium-gray">Warehouse management system is an automation software that streamlines everyday operations in the warehouse.

Every business whether online or offline needs a right warehouse software to manage their distribution channel. A well-defined WMS software boosts business revenues and fosters healthy business relationships with various stakeholders of the business, such as vendors, customers, investors, and the internal team.</p>
                    </div>
                    <blockquote class="border-color-deep-pink">
                            <p>Zcommerce cloud solution is used by 10,000 + customers to automate their supply chain operations for online and offline business. It is specially customized to the needs of Manufacturers, Wholesalers, Distributors, Retail Chains and Individual Store owners to save operational costs.</p>
                            
                        </blockquote>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                    	<img src="{{ theme_asset_url('landing/img/warehouse.jpg')}}" />
                    </div>
                </div>
            </div>
        </section>

        <section class="wow fadeIn" style="visibility: visible; animation-name: fadeIn; padding-top: 50px; padding-bottom: 50px">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                        <h5 class="text-extra-dark-gray alt-font font-weight-600">Zcommerce WMS SOFTWARE</h5>
                        <p class="text-medium line-height-30 text-medium-gray">While a basic warehouse software only manages the stock location and stock level of the goods in a warehouse, an advanced warehouse management software like Uniware understands the dynamism required in a warehouse solution which operates in an omni-channel retail scenario where virtual and physical marketplaces overlap each other, and the difference between the sales channels are blurring.</p>
                    </div>
                </div>
            </div>
        </section>
        
@endsection