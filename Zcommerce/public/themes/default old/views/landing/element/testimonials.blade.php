@php $testimonials = array(
  ['name'=>'Anand', 'designation'=>'','message'=>'I wanted to hire the best and after looking at several other companies, I knew sweta was the perfect guy for the job. He is a true professional.','image'=>''],
  ['name'=>'Savita', 'designation'=>'','message'=>'Trust us we looked for a very long time and wasted thousands of dollars testing other teams, freelancers, and outsource companies.','image'=>''],
  ['name'=>'Mohit', 'designation'=>'','message'=>'This is an excellent company! I personally enjoyed the energy and the professional support the whole team gave to us into creating website.','image'=>''],
  ['name'=>'Himani', 'designation'=>'','message'=>'Their team are easy to work with and helped me make amazing websites in a short amount of time. Thanks again guys for all your hard work.','image'=>'']
) @endphp

<div class="elementor-section elementor-top-section elementor-element elementor-element-0737957 elementor-section-content-middle elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="0737957" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}" style="width: 1364px; left: -112px;">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-row">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-0b0fd8a" data-id="0b0fd8a" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
				  <div class="elementor-section elementor-inner-section elementor-element elementor-element-0982665 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="0982665" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
      					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-73284ca" data-id="73284ca" data-element_type="column">
      			      <div class="elementor-column-wrap elementor-element-populated">
      							<div class="elementor-widget-wrap">
      						    <div class="elementor-element elementor-element-786da20 elementor-widget elementor-widget-section_title animated fadeInUp" data-id="786da20" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="section_title.default">
      				          <div class="elementor-widget-container">		
                          <div class="text-center iq-title-box iq-title-default iq-title-box-1">
      	                    <div class="iq-title-icon"></div>
                          	<h2 class="iq-title">What people say</h2>
                          	<p class="iq-title-desc">We have received tons of awesome testimonials</p>
                          </div>
      		              </div>
      				        </div>
      						  </div>
      					</div>
      		    </div>
						</div>
					</div>
		    </div>
				<div class="elementor-section elementor-inner-section elementor-element elementor-element-28e3da4 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="28e3da4" data-element_type="section">
					<div class="elementor-container elementor-column-gap-default">
						<div class="elementor-row">
					    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-7f612c5" data-id="7f612c5" data-element_type="column">
			         <div class="elementor-column-wrap elementor-element-populated">
							   <div class="elementor-widget-wrap">
						        <div class="elementor-element elementor-element-8b41aa2 animated-slow elementor-widget elementor-widget-iq_testimonial animated fadeIn" data-id="8b41aa2" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:500}" data-widget_type="iq_testimonial.default">
				              <div class="elementor-widget-container">
			                   <div class="iq-testimonial text-left iq-testimonial-2">
 
	                         <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="false" data-items="2" data-items-laptop="2" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-autoplay="true" data-loop="true" data-margin="30">

        	                 <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(-2280px, 0px, 0px); transition: all 0.25s ease 0s; width: 3990px;">
                              @foreach($testimonials as $testimonial)
                              <div class="owl-item cloned" style="width: 540px; margin-right: 30px;">
                                <div class="iq-testimonial-info">
                                  
                                  <div class="iq-testimonial-member">
            	          			      <div class="iq-testimonial-quote">
          				                    <i aria-hidden="true" class="fas fa-quote-left"></i> 
          			                    </div>
       			                          <h5 class="content">{{$testimonial['name']}}</h5>
                                      <span class="sub-title"><span class="content-sub mr-2 ml-2">-</span>{{$testimonial['designation']}}</span>
                                    </div>
                                    <p>{{$testimonial['message']}}</p>
                                  </div>
                                </div>
                                @endforeach
                              </div>
                            </div>
                            <div class="owl-nav disabled">
                              <button type="button" role="presentation" class="owl-prev"><i class="fa fa-angle-left fa-2x"></i></button>
                              <button type="button" role="presentation" class="owl-next"><i class="fa fa-angle-right fa-2x"></i></button>
                            </div>
                            <div class="owl-dots disabled"></div>
                          </div>
                        </div>	
                      </div>
                    </div>
						      </div>
					      </div>
		          </div>
						</div>
					</div>
		    </div>
			</div>
		</div>
	</div>
</div>
					</div>
		</div>