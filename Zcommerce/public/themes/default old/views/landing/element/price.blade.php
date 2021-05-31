<div class="container">
                    <article id="post-712" class="post-712 page type-page status-publish hentry">
	                   <div class="sf-content">
				            <div data-elementor-type="wp-page" data-elementor-id="712" class="elementor elementor-712" data-elementor-settings="[]">
						         <div class="elementor-inner">
							         <div class="elementor-section-wrap">

<div class="elementor-section elementor-top-section elementor-element elementor-element-8a8c25b elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="8a8c25b" data-element_type="section">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-row">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-bb50137" data-id="bb50137" data-element_type="column">
			    <div class="elementor-column-wrap elementor-element-populated">
					<div class="elementor-widget-wrap">

						<div class="elementor-section elementor-inner-section elementor-element elementor-element-8e4cdf0 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="8e4cdf0" data-element_type="section">
						    <div class="elementor-container elementor-column-gap-default">
							    <div class="elementor-row">
					                <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-2b51878" data-id="2b51878" data-element_type="column">
			                            <div class="elementor-column-wrap elementor-element-populated">
							                <div class="elementor-widget-wrap">
						                        <div class="elementor-element elementor-element-75cd653 elementor-invisible elementor-widget elementor-widget-section_title" data-id="75cd653" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:500}" data-widget_type="section_title.default">
				                                    <div class="elementor-widget-container">
                                                        <div class="text-center iq-title-box iq-title-default iq-title-box-1">
	                                                       <div class="iq-title-icon"></div>
                                                        	<h2 class="iq-title" >Pricing Plans </h2>	
                                                        	<p class="iq-title-desc">If you are planning on developing a product landing</p>
                                                        </div>
		                                            </div>
				                                </div>
				                                <div class="elementor-element elementor-element-685ae5b elementor-absolute elementor-hidden-tablet elementor-hidden-phone elementor-invisible elementor-widget elementor-widget-image" data-id="685ae5b" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;fadeInLeft&quot;}" data-widget_type="image.default">
				                                    <div class="elementor-widget-container">
					                                   <div class="elementor-image">
										                    <img width="594" height="568" src="https://iqonic.design/wp-themes/sofbox-elementor/wp-content/uploads/2020/03/su-1-1.png" class="attachment-full size-full" alt="images" loading="lazy" srcset="https://iqonic.design/wp-themes/sofbox-elementor/wp-content/uploads/2020/03/su-1-1.png 594w, https://iqonic.design/wp-themes/sofbox-elementor/wp-content/uploads/2020/03/su-1-1-300x287.png 300w" sizes="100vw" />
                                                        </div>
				                                    </div>
				                                </div>
						                    </div>
					                    </div>
		                            </div>
								</div>
					        </div>
		                </div>
				        <div class="elementor-section elementor-inner-section elementor-element elementor-element-fdc03c3 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="fdc03c3" data-element_type="section">
						    <div class="elementor-container elementor-column-gap-default">
							    <div class="elementor-row">
                                    @php $i = 0; @endphp
                                    @foreach($subscription_plans as $plans)
					                <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-a2e6ca5 elementor-invisible" data-id="a2e6ca5" data-element_type="column" data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;animation_delay&quot;:200}">
			                            <div class="elementor-column-wrap elementor-element-populated">
							                <div class="elementor-widget-wrap">
						                        <div class="elementor-element elementor-element-be1bbd2 elementor-widget elementor-widget-iqonic_price" data-id="be1bbd2" data-element_type="widget" data-widget_type="iqonic_price.default">
				                                    <div class="elementor-widget-container">
                                                        
                                                        <div  class="iq-price-container iq-price-table-3 text-center iq-box-shadow @if($i == 1) active @endif">
                                                            <div class="iq-price-header">  
                                                                <span class="iq-price-label"></span>
                                                                <p class="iq-price-description">{{$plans->name}}</p> 
                                                                <h2 class="iq-price">{{$plans->cost == 0 ? 'Free':'&#x20B9;'.$plans->cost}}<small></small></h2>    
                                                                <p class="iq-price-desc">/month</p>        
                                                            </div>
                                                            <div class="iq-price-body">
                                                                <ul class="iq-price-service">
                                                                	<li>
                                                                        Suitable For : {{ $plans->best_for }}
                                                                    </li>
                                                                    <li>
                                                                        Team Size : {{ $plans->team_size }}
                                                                    </li>
                                                                    <li>
                                                                        Inventory Limit : {{ $plans->inventory_limit }}
                                                                    </li>
                                                                    {!! $plans->description !!}
                                                                </ul>
                                                            </div>
                                                        <div class="iq-price-footer">        
                                                            <div class="iq-btn-container" >

                                                                <a class="iq-button iq-btn-medium iq-btn-semi-round" href="{{route('register')}}" style="@if($i==1)background-color: #fff; @endif">
                                                                    Buy Now   
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
				                            </div>
						                </div>
					                </div>
		                        </div>
                                @php $i++ @endphp
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
                                    </div>
                                </div>
                            </div><!-- .sf-content -->
                        </article><!-- #post-## -->     
                    </div><!-- .container -->