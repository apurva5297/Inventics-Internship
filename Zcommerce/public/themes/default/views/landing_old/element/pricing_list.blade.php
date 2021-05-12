<section class="wow fadeIn">
            <div class="container">  
            <div class="row">
                <div class="col-md-12">
                    <h6 style="text-align: center;">We have experience in working with medium and small businesses and are ready to develop a targeted strategy and plan that's just right for you.</h6>
                </div>
            </div>              
                <div class="row">
                    <!-- start price item -->
                    @foreach($subscription_plans as $plans)
                    <div class="col-12 col-lg-4 pricing-box-style1 text-center md-margin-30px-bottom wow fadeInUp">
                        <div class="pricing-box border-all border-color-extra-light-gray">
                            <div class="padding-55px-all bg-very-light-gray md-padding-30px-all sm-padding-40px-all">
                                <!-- start price title -->
                                <div class="pricing-title text-center">
                                    <i class="ti-user icon-large text-deep-pink d-inline-block padding-30px-all bg-white box-shadow-light rounded-circle margin-25px-bottom"></i>
                                </div>
                                <!-- end price title -->
                                <!-- start price price -->
                                <div class="pricing-price">
                                    <span class="alt-font text-extra-dark-gray font-weight-600 text-uppercase">{{$plans->name}}</span>
                                    <h4 class="text-extra-dark-gray alt-font font-weight-600 mb-0">{{$plans->cost == 0 ? 'Free':'&#x20B9;'.$plans->cost}}</h4>
                                    <div class="text-extra-small text-uppercase alt-font margin-5px-top">Per Month</div>
                                </div>
                                <!-- end price price -->
                            </div>
                            <!-- start price features -->
                            <div class="padding-45px-all pricing-features md-padding-20px-all sm-padding-30px-all">
                                <ul class="list-style-11">
                                    <li>Best for: {{$plans->best_for}}</li>
                                    <li>Team Size {{$plans->team_size}}</li>
                                    <li>Inventory Limit {{$plans->inventory_limit}}</li>
                                </ul>
                                <!-- start price action -->
                                <div class="pricing-action margin-35px-top md-no-margin-top">
                                    <a href="{{url('/register')}}" class="btn btn-dark-gray btn-small text-extra-small">Choose Plan</a>                                        
                                </div>
                                <!-- end price action -->
                            </div>
                            <!-- end price features -->
                        </div>
                    </div>
                    <!-- end price item -->
                    <!-- start price item -->
                    @endforeach
                </div>
            </div>
        </section>