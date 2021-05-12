@if(isset($banners['best_deals']))
	<section>
	  <div class="container">
	    <div class="section-title" style="border-bottom: 0px;padding-top: 5px;"></div>
		<div class="row featured">
	        @foreach($banners['best_deals'] as $banner)
	          @include('layouts.banner', $banner)
	        @endforeach
	    </div><!-- /.row -->
	  </div><!-- /.container -->
	</section>
@endif