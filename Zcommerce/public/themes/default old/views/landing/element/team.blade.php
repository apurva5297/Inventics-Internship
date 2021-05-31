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
	'name' => 'Rajani Verma',
	'image' => 'landing/team/team/rajni.png',
	'designation' => 'Android Developer',
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
<div class="elementor-section elementor-top-section elementor-element elementor-element-f083ade elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="f083ade" data-element_type="section">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-row">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-cf01a1d" data-id="cf01a1d" data-element_type="column">
				<div class="elementor-column-wrap elementor-element-populated">
					<div class="elementor-widget-wrap">
						<div class="elementor-section elementor-inner-section elementor-element elementor-element-1d36db2 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="1d36db2" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
								<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-cbdfb6e" data-id="cbdfb6e" data-element_type="column">
									<div class="elementor-column-wrap elementor-element-populated">
										<div class="elementor-widget-wrap">
											<div class="elementor-element elementor-element-03ebb83 elementor-widget elementor-widget-section_title animated fadeInUp" data-id="03ebb83" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="section_title.default">
												<div class="elementor-widget-container">
			
													<div class="text-center iq-title-box iq-title-default iq-title-box-1">
														<div class="iq-title-icon"></div>
														<h2 class="iq-title">Meet our team	</h2>
														<p class="iq-title-desc">If you are planning on developing a product landing</p></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="elementor-section elementor-inner-section elementor-element elementor-element-b3f1514 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="b3f1514" data-element_type="section">
							<div class="elementor-container elementor-column-gap-default">
								<div class="elementor-row">
									<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-ac873e5" data-id="ac873e5" data-element_type="column">
										<div class="elementor-column-wrap elementor-element-populated">
											<div class="elementor-widget-wrap">
												<div class="elementor-element elementor-element-4b9fb22 elementor-widget elementor-widget-team animated fadeInUp" data-id="4b9fb22" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="team.default">
													<div class="elementor-widget-container">
 														<div class="iq-team iq-team-slider iq-team-style-11 ">
			 												<ul class="grid iq-col-5 grid-style 2 ">
			 													@foreach($teams as $team)
														    	<li class="item">
															    	<div class="iq-team-blog">
															    		<div class="iq-team-img">
															    			<img src="{{ theme_asset_url($team['image'])}}">
															    		</div>
															    		<div class="iq-team-info">
															    			<h5 class="member-text">{{$team['name']}}</h5>
															    			<span class="team-post designation-text">{{$team['designation']}}</span>
															    		</div> 	
															    		 <div class="share iq-team-social">
															    			<ul>
															    				<li><a href="#"><i class="fa fa-facebook"></i></a></li><li><a href="#"><i class="fa fa-twitter"></i></a></li><li><a href="#"><i class="fa fa-instagram"></i></a></li>
															    			</ul>
															    			</div>	
															    	</div>
															    </li>
															    @endforeach
															</ul>
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