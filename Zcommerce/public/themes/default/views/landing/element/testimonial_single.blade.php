@php $testimonials = array(
  ['name'=>'Anand', 'designation'=>'','message'=>'I wanted to hire the best and after looking at several other companies, I knew sweta was the perfect guy for the job. He is a true professional.','image'=>''],
  ['name'=>'Savita', 'designation'=>'','message'=>'Trust us we looked for a very long time and wasted thousands of dollars testing other teams, freelancers, and outsource companies.','image'=>''],
  ['name'=>'Mohit', 'designation'=>'','message'=>'This is an excellent company! I personally enjoyed the energy and the professional support the whole team gave to us into creating website.','image'=>''],
  ['name'=>'Himani', 'designation'=>'','message'=>'Their team are easy to work with and helped me make amazing websites in a short amount of time. Thanks again guys for all your hard work.','image'=>'']
) @endphp
<div style="width: 100%; background-image: url({{ theme_asset_url('landing/bg-testimonial-nv.jpg')}}); background-size: cover; background-repeat: no-repeat; color: #fff; padding: 50px 150px">
	<div class="elementor-column-gap-default">
		<div class="elementor-row">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-1486ae25" data-id="1486ae25" data-element_type="column">
				<div class="elementor-column-wrap elementor-element-populated">
					<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-10f0a302 elementor-widget elementor-widget-section_title" data-id="10f0a302" data-element_type="widget" data-widget_type="section_title.default">
							<div class="elementor-widget-container">
								<div class="text-center iq-title-box iq-title-default iq-title-box-1">
									<div class="iq-title-icon"></div>
									<h2 class="iq-title" style="color: #fff">What Our Clients Say About Us</h2>	
									<p class="iq-title-desc">We have received tons of awesome testimonials</p></div>
								</div>
							</div>
							<div class="elementor-element elementor-element-d704b34 elementor-widget elementor-widget-iq_testimonial" data-id="d704b34" data-element_type="widget" data-widget_type="iq_testimonial.default">
								<div class="elementor-widget-container">
									<div class="iq-testimonial text-center iq-testimonial-3">
										<div class="owl-carousel" data-dots="true" data-nav="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-autoplay="true" data-loop="true" data-margin="0" >
						    	    	@foreach($testimonials as $testimonial)
								            <div class="iq-testimonial-info">
							                	<div class="iq-testimonial-content">    
							                		<p>{{$testimonial['message']}}</p>
							            		</div>
							            		<div class="iq-testimonial-member">
							              			 <div class="avtar-name">
							                			<div class="iq-lead">
							                    			{{$testimonial['name']}}               
							                  			</div>
							                			<span class="iq-post-meta">{{$testimonial['designation']}}</span>                                  
							              			</div>
							            		</div>
							        		</div>
					        	    	@endforeach
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