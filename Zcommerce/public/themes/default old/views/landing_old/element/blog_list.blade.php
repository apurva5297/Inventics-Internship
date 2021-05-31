
        <!-- start post content section --> 
        <section class="wow fadeIn hover-option4 blog-post-style3">
            <div class="container"> 
                <div class="row">
                    @foreach($blogs as $blog)
                    <!-- start post item -->
                    <div class="col-12 col-lg-4 col-md-6 grid-item margin-30px-bottom text-center text-md-left wow fadeInUp">
                        <div class="blog-post bg-light-gray inner-match-height">
                            <div class="blog-post-images overflow-hidden position-relative">
                                <a href="blog-post-layout-01.html">
                                    <img src="{{ get_storage_file_url(optional($blog->image)->path, 'medium') }}" alt="">
                                    <div class="blog-hover-icon"><span class="text-extra-large font-weight-300">+</span></div>
                                </a>
                            </div>
                            <div class="post-details padding-40px-all md-padding-20px-all">
                                <a href="blog-post-layout-01.html" class="alt-font post-title text-medium text-extra-dark-gray width-100 d-block lg-width-100 margin-15px-bottom">{{$blog->title}}</a>
                                <p>{!! substr($blog->content,0,250) !!}</p>
                                <!-- <div class="separator-line-horrizontal-full bg-medium-gray margin-20px-tb"></div> -->
                                <!-- <div class="author">
                                    <span class="text-medium-gray text-uppercase text-extra-small d-inline-block">by <a href="" class="text-medium-gray">Jay Benjamin</a>&nbsp;&nbsp;|&nbsp;&nbsp;13 May 2017</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- end post item -->
                    @endforeach
                </div>
                
            </div>
        </section>