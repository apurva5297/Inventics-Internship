@php $portfolios = array(
	['name'=>'Grocery 1', 'filter'=>'grocery','type'=>'Grocery','image'=>'landing/portfolio/l3-grocery3.png'],

	['name'=>'Grocery 2', 'filter'=>'grocery','type'=>'Grocery','image'=>'landing/portfolio/l3-grocery2.png'],

	['name'=>'Fashion 1', 'filter'=>'fashion','type'=>'Fashion','image'=>'landing/portfolio/l3-bags.png'],

	['name'=>'Fashion 2', 'filter'=>'fashion','type'=>'Fashion','image'=>'landing/portfolio/l3-bags.png'],

	['name'=>'Electronics 1', 'filter'=>'electronics','type'=>'Electronics','image'=>'landing/portfolio/electronics.png'],

	['name'=>'Electronics 2', 'filter'=>'electronics','type'=>'Electronics','image'=>'landing/portfolio/electronics.png'],

	['name'=>'Jewellery 1', 'filter'=>'jewellery','type'=>'Jewellery','image'=>'landing/portfolio/jewellery.png'],

	['name'=>'Jewellery 2', 'filter'=>'jewellery','type'=>'Jewellery','image'=>'landing/portfolio/jewellery.png'],

	['name'=>'Food 1', 'filter'=>'food','type'=>'Food','image'=>'landing/portfolio/food1.png'],

	['name'=>'Food 2', 'filter'=>'food','type'=>'Food','image'=>'landing/portfolio/food1.png'],

	['name'=>'Furniture 1', 'filter'=>'furniture','type'=>'Furniture','image'=>'landing/portfolio/furniture.png'],

	['name'=>'Furniture 2', 'filter'=>'furniture','type'=>'Furniture','image'=>'landing/portfolio/furniture.png'],

	['name'=>'Sports 1', 'filter'=>'sports','type'=>'Sports','image'=>'landing/portfolio/athena.png'],

	['name'=>'Sports 2', 'filter'=>'sports','type'=>'Sports','image'=>'landing/portfolio/athena.png'],

	['name'=>'Auto 1', 'filter'=>'auto','type'=>'Auto','image'=>'landing/portfolio/auto1.png'],

	['name'=>'Auto 2', 'filter'=>'auto','type'=>'Auto','image'=>'landing/portfolio/auto1.png'],

	['name'=>'Books 1', 'filter'=>'books','type'=>'Books','image'=>'landing/portfolio/books1.png'],

	['name'=>'Books 2', 'filter'=>'books','type'=>'Books','image'=>'landing/portfolio/books1.png']
) @endphp


									<div class="elementor-section elementor-top-section elementor-element elementor-element-d590138 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="d590138" data-element_type="section" style="margin-top:90px">
										<div class="elementor-container elementor-column-gap-default">
											<div class="elementor-row">
												<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-a26a628" data-id="a26a628" data-element_type="column">
													<div class="elementor-column-wrap elementor-element-populated">
														<div class="elementor-widget-wrap">
															<div class="elementor-element elementor-element-66726cd elementor-widget elementor-widget-portfolio" data-id="66726cd" data-element_type="widget" data-widget_type="portfolio.default">
																<div class="elementor-widget-container">
																	<div class="text-center iq-title-box iq-title-default iq-title-box-1">
    	                                                   				<div class="iq-title-icon"></div>
																		<h2 class="iq-title" >Portfolio</h2>
			                                                            <p class="iq-title-desc">Get our latest collection from portfolio</p>
			                                                        </div>
																	<div class="iq-masonry-block ">
																		<div class="isotope-filters isotope-tooltip">
																			
																			<button data-filter=".fashion" class="active">Fashion<span class="post_no"></span></button>
																			<button data-filter=".grocery">Grocery<span class="post_no"></span></button>

																			
																			<button data-filter=".electronics">Electronics<span class="post_no"></span></button>

																			<button data-filter=".jewellery">Jewellery<span class="post_no"></span></button>

																			<button data-filter=".food">Food<span class="post_no"></span></button>

																			<button data-filter=".furniture">Furniture<span class="post_no"></span></button>

																			<button data-filter=".sports">Sports<span class="post_no"></span></button>

																			<button data-filter=".auto">Auto<span class="post_no"></span></button>

																			<button data-filter=".books">Books<span class="post_no"></span></button>

																		</div>
																		<div class=" iq-masonry iq-columns-2" style="position: relative; height: 2166.92px;">
																			@foreach($portfolios as $portfolio)
																			<div class="iq-masonry-item {{$portfolio['filter']}}" style="position: absolute; left: 0%; top: 0px; height:350px; overflow-y: hidden; padding: 15px">
																				<div class="iq-portfolio" style=" border-radius: 5px">
	
																					<a href="{{ theme_asset_url($portfolio['image'])}}">
																						<img src="{{ theme_asset_url($portfolio['image'])}}" alt="unisaas-portfolio">		
																						<div class="portfolio-link">
																							<div class="icon">
																								<i class="fa fa-link" aria-hidden="true"></i>
																							</div>
																						</div>
																					</a>
	
																					<div class="iq-portfolio-content">
																						<div class="details-box clearfix">
																							<div class="consult-details">
																								<a href=""> 
																									<h4 class="link-color">
																										{{$portfolio['name']}}
																									</h4>
																									<p class="mb-0 iq-portfolio-desc">
																										{{$portfolio['type']}}
																									</p>
																								</a>
																							</div>
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