@extends('landing.layout')

@section('content')

<!-- side area start-->
<div id="has-side-bar" class="iq-menu-side-bar">
<!-- side area btn container start-->
    <div class="iq-sidearea-btn-container btn-container-close" id="menu-btn-side-close">
        <span class="menu-btn d-inline-block is-active">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </span>
    </div>
<!-- side area btn container end-->
    <div id="sidebar-scrollbar">
        <div class="iq-sidebar-container">
     	  <div class="iq-sidebar-content">
     		 <div class="widget">
                <form method="get" class="search-form search__form" action="https://iqonic.design/wp-themes/sofbox-elementor/">
    	            <div class="form-row">
    	                <input type="search" id="search-form-6039fdb9bd7d9" class="search-field search__input" name="s" placeholder="sofbox Search:"/>
                        <button type="submit" class="search-submit" ><i class="fa fa-search" aria-hidden="true"></i><span class="screen-reader-text">Search</span></button> 
                    </div>
                </form>
            </div>
            <div class="widget">			
                <div class="textwidget">
                    <h4 class="iq-side-area-title">About Us</h4>
                    <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                </div>
    		</div>
            <div class="widget">
                <img width="300" height="263" src="https://iqonic.design/wp-themes/sofbox-elementor/wp-content/uploads/2020/07/about-2-300x263.png" class="image wp-image-2341  attachment-medium size-medium" alt="" loading="lazy" style="max-width: 100%; height: auto;" srcset="https://iqonic.design/wp-themes/sofbox-elementor/wp-content/uploads/2020/07/about-2-300x263.png 300w, https://iqonic.design/wp-themes/sofbox-elementor/wp-content/uploads/2020/07/about-2.png 605w" sizes="100vw" />
            </div>		
            <div class="widget">
    		    <h4 class="footer-title contact-info">Contact Info</h4>			
                <div class="row">
    				<div class="col-sm-12">
    					<ul class="iq-contact">
                            <li><a href="tel:+0123456789"><i class="fa fa-phone"></i><span>+0123456789</span></a></li>
                            <li><a href="/cdn-cgi/l/email-protection#691a1c1919061b1d290018070607000a1d010c040c1a470a0604"><i class="fa fa-envelope"></i><span><span class="__cf_email__" data-cfemail="dfacaaafafb0adab9fb6aeb1b0b1b6bcabb7bab2baacf1bcb0b2">[email&#160;protected]</span></span></a></li>
    						<li>
    							<a><i class="fa fa-home"></i><span>1234 North Avenue Luke Lane, South Bend, IN 360001</span></a>
    						</li>
                        </ul>
    				</div>
    			</div>
    		</div>	
     	</div>	 
    </div>
</div>
</div>
	<div class="site-content-contain">
		<div id="content" class="site-content">
            <div id="primary" class="content-area">
	           <main id="main" class="site-main">
		          <div class="container">
                    <article id="post-712" class="post-712 page type-page status-publish hentry">
	                   <div class="sf-content">
				            <div data-elementor-type="wp-page" data-elementor-id="712" class="elementor elementor-712" data-elementor-settings="[]">
						         <div class="elementor-inner">
							         <div class="elementor-section-wrap">
							             <div class="elementor-section elementor-top-section elementor-element elementor-element-2d90603 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2d90603" data-element_type="section">
						                      <div class="elementor-container elementor-column-gap-default">
							                     <div class="elementor-row">
					                               <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-ddacb89" data-id="ddacb89" data-element_type="column">
			                                            <div class="elementor-column-wrap elementor-element-populated">
							                                 <div class="elementor-widget-wrap">
						                                          <div class="elementor-element elementor-element-d11feaf elementor-widget elementor-widget-slider_revolution" data-id="d11feaf" data-element_type="widget" data-widget_type="slider_revolution.default">
				                                                        <div class="elementor-widget-container">
			
		                                                                      <div class="wp-block-themepunch-revslider">
			<!-- START sofbox6 REVOLUTION SLIDER 6.2.23 -->                      <p class="rs-p-wp-fix"></p>
                                                                                @include('landing.element.slider',$sliders)
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
                    
                    @include('landing.element.carousal')
                    @include('landing.element.features')

                    {{--@include('landing.element.unisaas')--}}

                    @include('landing.element.dream')

                    @include('landing.element.price')

                    <div style="width:100%; background-color: #000">@include('landing.element.testimonial_single')</div>

                    @include('landing.element.portfolio')

                    @include('landing.element.blog_list')
                                            				
                                            				
                                        
	            </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- #content -->
    </div>

<!-- Faq End -->
@endsection
