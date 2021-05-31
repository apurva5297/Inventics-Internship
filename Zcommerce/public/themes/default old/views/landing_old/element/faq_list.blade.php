<section class="wow fadeIn bg-light-gray" style="visibility: visible; animation-name: fadeIn;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-uppercase alt-font text-extra-dark-gray font-weight-600 margin-four-bottom">Have a question? Check out our frequently asked questions to find your answer.</h6>
                        <p class="text use-text-subtitle2 text-lg-start text-center"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- start accordion -->
                        <div class="panel-group accordion-style1" id="accordion-two">
                            <!-- accordion item -->
                            @php $count_faq = 1; @endphp
                            @foreach($faqs as $faq)
                            <div class="panel">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion-two" href="#accordion-two-link{{$count_faq}}" class="collapsed" aria-expanded="false"><div class="panel-title font-weight-500 text-uppercase position-relative padding-20px-right">{{$faq->question}}<span class="position-absolute right-0 top-0"><i class="ti-plus"></i></span></div></a>
                                </div>
                                <div id="accordion-two-link{{$count_faq}}" data-parent="#accordion-two" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>{!! $faq->answer !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion item -->
                            @php $count_faq++; @endphp
                            @endforeach
                        </div>
                        <!-- end accordion -->
                    </div>
                </div>
            </div>
        </section>