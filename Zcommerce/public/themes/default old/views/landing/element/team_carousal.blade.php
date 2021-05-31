@php $teams = array([
	'name' => 'Vineet Saraogi',
	'image' => 'landing/team/vineet_sir.png',
	'designation' => 'CEO',
	],
	[
	'name' => 'Puneet R Saharey',
	'image' => 'landing/team/puneet_sir.png',
	'designation' => 'Director',
	],

	[
	'name' => 'Hermyne',
	'image' => 'landing/team/hermyne.png',
	'designation' => 'Human Resource',
	],
	[
	'name' => 'Kaushal Kumar',
	'image' => 'landing/team/kaushal.png',
	'designation' => 'SDE',
	],
	[
	'name' => 'Shakun Verma',
	'image' => 'landing/team/shakun verma.png',
	'designation' => 'Graphic Designer',
	],
	[
	'name' => 'Mayank Dixit',
	'image' => 'landing/team/mayank.png',
	'designation' => 'Backend Developer',
	],
	[
	'name' => 'Rishikesh Singh',
	'image' => 'landing/team/rishikesh.png',
	'designation' => 'Android Developer',
	],
	[
	'name' => 'Rahul',
	'image' => 'landing/team/rahul.png',
	'designation' => 'Android Developer',
	],
	[
	'name' => 'Vandana',
	'image' => 'landing/team/vandana.png',
	'designation' => 'PHP Developer',
	],
	[
	'name' => 'Harsh',
	'image' => 'landing/team/harsh.png',
	'designation' => 'Laravel Developer',
	]
);
@endphp

@section('static_array_data')
	@include('team_list')
@endsection
<div class="elementor-section elementor-top-section elementor-element elementor-element-cbf19f6 elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="cbf19f6" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}" style="width: 1364px; left: -112px;">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-row">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-36ad2c2" data-id="36ad2c2" data-element_type="column">
				<div class="elementor-column-wrap elementor-element-populated">
					<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-4c3645e elementor-widget elementor-widget-section_title" data-id="4c3645e" data-element_type="widget" data-widget_type="section_title.default">
							<div class="elementor-widget-container">
								<div class="text-center iq-title-box iq-title-default iq-title-box-1">
									<div class="iq-title-icon"></div>
									<h2 class="iq-title">Our Team</h2>
			
									<p class="iq-title-desc">If you are planning on developing a product landing app or website, take<br> a look at this beautiful-crafted</p>
								</div>
							</div>
						</div>
						<div class="elementor-element elementor-element-8ea6a0e elementor-widget elementor-widget-team" data-id="8ea6a0e" data-element_type="widget" data-widget_type="team.default">
							<div class="elementor-widget-container">
								<div class="iq-team iq-team-slider iq-team-style-6 ">
	 								<div class="owl-carousel owl-loaded owl-drag" data-dots="true" data-nav="true" data-items="4" data-items-laptop="3" data-items-tab="2" data-items-mobile="1" data-items-mobile-sm="1" data-autoplay="true" data-loop="true" data-margin="30">
									<div class="owl-stage-outer">
										@foreach($teams as $team)
										<div class="owl-stage" style="transform: translate3d(-5100px, 0px, 0px); transition: all 0.25s ease 0s; width: 9300px;">
											<div class="owl-item cloned" style="width: 270px; margin-right: 30px;">
												<div class="iq-team-blog">
													<div class="team-blog">
														<div class="iq-team-img"> 
															<img class="img-fluid" src="{{ theme_asset_url($team['image'])}}" alt="image">
														</div>

														<div class="iq-team-description">
															<div class="line"></div>

															<div class="iq-team-info">
																<h5 class="member-text">{{$team['name']}}</h5>
																<p class="designation-text">{{$team->designation}}</p>
															</div>

															
															<div class="iq-team-social">
																<ul>
																	<li><a href="#"><i class="fa fa-facebook"></i></a></li><li><a href="#"><i class="fa fa-twitter"></i></a></li><li><a href="#"><i class="fa fa-instagram"></i></a></li>								</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										@endforeach
									</div>
									<div class="owl-nav">
										<button type="button" role="presentation" class="owl-prev"><i class="fa fa-angle-left fa-2x"></i></button>
										<button type="button" role="presentation" class="owl-next"><i class="fa fa-angle-right fa-2x"></i></button>
									</div>
									<div class="owl-dots">
										<button role="button" class="owl-dot"><span></span></button>
										<button role="button" class="owl-dot"><span></span></button>
										<button role="button" class="owl-dot active"><span></span></button>
										<button role="button" class="owl-dot"><span></span></button>
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