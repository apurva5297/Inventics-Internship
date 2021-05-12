<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="">

        <!-- Place one Banner -->
        @include('banners.place_one')

      </div>
    </div>
  </div>
</section>
        
          
          @include('sliders.recently_added', ['products' => $recent])

        
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="">
        <!-- Place Two Banner -->
        @include('banners.place_two')

        
        
      </div> <!-- /.col-md-12 -->

      
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>