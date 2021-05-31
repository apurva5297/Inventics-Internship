<div class="container">
                    <article id="post-712" class="post-712 page type-page status-publish hentry">
	                   <div class="sf-content">
				            <div data-elementor-type="wp-page" data-elementor-id="712" class="elementor elementor-712" data-elementor-settings="[]">
						         <div class="elementor-inner">
							         <div class="elementor-section-wrap">
<div class="elementor-section elementor-top-section elementor-element elementor-element-718c22e elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="718c22e" data-element_type="section" style="margin-top:90px">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-row">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-0164e6a" data-id="0164e6a" data-element_type="column">
				<div class="elementor-column-wrap elementor-element-populated">
					<div class="elementor-widget-wrap">
						<div class="elementor-section elementor-inner-section elementor-element elementor-element-691b0a3 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="691b0a3" data-element_type="section">
							<div class="elementor-container elementor-column-gap-default">
								<div class="elementor-row">
									<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-ca93833" data-id="ca93833" data-element_type="column">
										<div class="elementor-column-wrap elementor-element-populated" style="margin-bottom: 0">
											<div class="elementor-widget-wrap">
												<div class="elementor-element elementor-element-876530e elementor-invisible elementor-widget elementor-widget-section_title" data-id="876530e" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="section_title.default">
													<div class="elementor-widget-container">
			
														<div class="text-center iq-title-box iq-title-default iq-title-box-1">
															<div class="iq-title-icon"></div>
															<h2 class="iq-title" >Latest Posts </h2>
															<p class="iq-title-desc">
																If you are planning on developing a product landing
															</p>
														</div>
													</div>
												</div>
												<div class="elementor-element elementor-element-fa03019 elementor-absolute elementor-hidden-tablet elementor-hidden-phone elementor-invisible elementor-widget elementor-widget-image" data-id="fa03019" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;fadeInRight&quot;}" data-widget_type="image.default">
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="elementor-element elementor-element-9a9531a elementor-widget elementor-widget-iqonic_blog" data-id="9a9531a" data-element_type="widget" data-widget_type="iqonic_blog.default">
							<div class="elementor-widget-container">
								<div class=""> 
	 								<div  class="blog-carousel owl-carousel" data-dots="false" data-nav="false" data-items="3" data-items-laptop="3" data-items-tab="2" data-items-mobile="1" data-items-mobile-sm="1" data-autoplay="true" data-loop="true" data-margin="30">
									    @foreach($blogs as $blog)
										<div class="item">
											<div class="iq-blog-box">
												<div class="iq-blog-image clearfix">
														<img src="{{ get_storage_file_url(optional($blog->image)->path) }}" style="height: 200px" alt="unisaas-blog"/>					
													</div>
													<div class="iq-blog-detail">
														<div class="blog-title">
															<a href="{{url('blog',$blog->slug)}}">
															<h5 class="iq-blog-title mb-2">{{$blog->title}}</h5>
															</a>

														</div>
														
														
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


</div>
                                    </div>
                                </div>
                            </div><!-- .sf-content -->
                        </article><!-- #post-## -->     
                    </div><!-- .container -->