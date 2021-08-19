@extends('Layout.ProductPage.Product')
@section('content')
<div class="page-content">
    <div class="holder breadcrumbs-wrap mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{Route('Home')}}">Home</a></li>
                <li><span>Blog Post</span></li>
            </ul>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <div class="page-title text-center">
                <h1>Blog Post</h1>
            </div>
            <div class="row">
                <div class="col-md-14 aside aside--content">
                    <div class="post-full">
                        <h2 class="post-title">Fashion Trends You Need to Follow</h2>
                        <div class="post-links">
                            <div class="post-date"><i class="icon-calendar"></i>August 27, 2020</div>
                            <a href="#" class="post-link">by John Smith</a>
                            <a href="#postComments" class="js-scroll-to"><i class="icon-chat"></i>15 Comment(s)</a>
                        </div>
                        <div class="post-img image-container" style="padding-bottom: 54.44%">
                            <img class="lazyload fade-up-fast" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/blog/blog-02.png" alt="">
                        </div>
                        <div class="post-text">
                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the
                                master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.
                                Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</p>
                            <p>To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying
                                consequences, or one who avoids a pain that produces no resultant pleasure On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                                blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and
                                pain.</p>
                            <p>These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain
                                avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these
                                matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains</p>
                            <blockquote>
                                <div>But in certain circumstances and owing to the claims of duty or obligations of business it willfrequently occur that pleasures have to be repudiated and annoyances accepted.</div>
                                <div class="blockquote-author"><a href="#">Jon Cock</a></div>
                            </blockquote>
                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the
                                master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.
                                Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</p>
                            <div class="mt-3"></div>
                            <div class="row">
                                <div class="col-sm"><img class="lazyload fade-up" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/blog/blog-04.png" alt=""></div>
                                <div class="col-sm mt-3 mt-md-0">
                                    <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter. But I must explain to you how all this mistaken idea of denouncing
                                        pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>
                                </div>
                            </div>
                            <p>Consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him
                                some great pleasure.</p>
                            <p>To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying
                                consequences, or one who avoids a pain that produces no resultant pleasure On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                                blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and
                                pain.</p>
                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the
                                master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.
                                Nor again is there anyone who loves or pursues or desires to obtain pain of itself.</p>
                        </div>
                        <div class="post-bot">
                            <ul class="tags-list post-tags-list">
                                <li><a href="#">Goodwin</a></li>
                                <li><a href="#">Seiko</a></li>
                                <li><a href="#">Banita</a></li>
                                <li><a href="#">Bigsteps</a></li>
                            </ul>
                            <a href="#" class="post-share">
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d92f2937e44d337"></script>
                                <div class="addthis_inline_share_toolbox"></div>
                            </a>
                        </div>
                    </div>
                    <div class="related-posts">
                        <div class="title-with-arrows">
                            <h3 class="h2-style">Related Posts</h3>
                            <div class="carousel-arrows"></div>
                        </div>
                        <div class="post-prws post-prws-carousel js-post-prws-carousel"
                             data-slick='{"slidesToShow": 1, "responsive": [{"breakpoint": 1024,"settings": {"slidesToShow": 1}},{"breakpoint": 768,"settings": {"slidesToShow": 1}},{"breakpoint": 480,"settings": {"slidesToShow": 1}}]}'>
                            <div class="post-prw">
                                <div class="row vert-margin-middle">
                                    <div class="post-prw-img col-md-7">
                                        <a href="blog-post.html">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/blog/blog-01.png" class="lazyload fade-up" alt="">
                                        </a>
                                    </div>
                                    <div class="post-prw-text col-md-11">
                                        <div class="post-prw-links">
                                            <div class="post-prw-date"><i class="icon-calendar"></i>November 17, 2020, 2020</div>
                                            <div class="post-prw-date"><i class="icon-chat"></i>5 comments</div>
                                        </div>
                                        <h4 class="post-prw-title"><a href="blog-post.html">Trends to Try This Season</a></h4>
                                        <div class="post-prw-teaser">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account</div>
                                        <div class="post-prw-btn">
                                            <a href="blog-post.html" class="btn btn--sm">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-prw">
                                <div class="row vert-margin-middle">
                                    <div class="post-prw-img col-md-7">
                                        <a href="blog-post.html">
                                            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/blog/blog-03.png" class="lazyload fade-up" alt="">
                                        </a>
                                    </div>
                                    <div class="post-prw-text col-md-11">
                                        <div class="post-prw-links">
                                            <div class="post-prw-date"><i class="icon-calendar"></i>November 01, 2020, 2020</div>
                                            <div class="post-prw-date"><i class="icon-chat"></i>5 comments</div>
                                        </div>
                                        <h4 class="post-prw-title"><a href="blog-post.html">Your Spring Style</a></h4>
                                        <div class="post-prw-teaser">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account</div>
                                        <div class="post-prw-btn">
                                            <a href="blog-post.html" class="btn btn--sm">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-comments mt-3 mt-md-4" id="postComments">
                        <h3 class="h2-style">Post Comments</h3>
                        <div class="post-comment">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="post-comment-author-img">
                                        <img src="images/blog/comment-author.png" alt="" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="post-comment-date"><i class="icon-calendar"></i>October 27, 2020</div>
                                    <div class="post-comment-author"><a href="#">Miles Black</a></div>
                                    <div class="post-comment-text">
                                        <p>Well how fantastic do I feel now. Awesome to say the least. The customer service was outstanding, being on the larger side I am very self conscious, your team of beautiful kind-hearted ladies made me feel very special. I
                                            actually found two wonderful outfits and couldn't be any happier.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-comment">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="post-comment-author-img">
                                        <img src="images/blog/comment-author-2.png" alt="" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="post-comment-date"><i class="icon-calendar"></i>October 15, 2020</div>
                                    <div class="post-comment-author"><a href="#">Jenny Parker</a></div>
                                    <div class="post-comment-text">
                                        <p>Customer support has been excellent, as any small issues, minor bugs or even small requests have all been catered for in a quick, professional and timely manner.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-comment-form mt-3 mt-md-4">
                        <h3 class="h2-style">Leave Your Comment</h3>
                        <form action="#" class="comment-form">
                            <div class="form-group">
                                <div class="row vert-margin-middle">
                                    <div class="col-lg">
                                        <input type="text" name="name" class="form-control form-control--sm" placeholder="Name" required>
                                    </div>
                                    <div class="col-lg">
                                        <input type="text" name="email" class="form-control form-control--sm" placeholder="Email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control form-control--sm textarea--height-200" name="message" placeholder="Message" required></textarea>
                            </div>
                            <button class="btn" type="submit">Submit Comment</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 aside aside--sidebar aside--right">
                    <div class="aside-block">
                        <h2 class="text-uppercase">Popular Tags</h2>
                        <ul class="tags-list">
                            <li><a href="#">jeans</a></li>
                            <li><a href="#">hand bags</a></li>
                            <li><a href="#">gift card</a></li>
                            <li><a href="#">goodwin</a></li>
                            <li><a href="#">seiko</a></li>
                            <li><a href="#">banita</a></li>
                            <li><a href="#">foxic</a></li>
                        </ul>
                    </div>
                    <div class="aside-block">
                        <h2 class="text-uppercase">Popular Posts</h2>
                        <div class="post-prw-simple-sm">
                            <a href="blog-post.html" class="post-prw-img">
                                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="images/blog/blog-05.png" class="lazyload fade-up" alt="">
                            </a>
                            <div class="post-prw-links">
                                <div class="post-prw-date"><i class="icon-calendar"></i>August 27, 2020</div>
                                <a href="#" class="post-prw-author">by Jon Cock</a>
                            </div>
                            <h4 class="post-prw-title"><a href="#">FOXic shopify theme</a></h4>
                            <a href="#" class="post-prw-comments"><i class="icon-chat"></i>15 comments</a>
                        </div>
                    </div>
                    <div class="aside-block">
                        <h2 class="text-uppercase">Meta</h2>
                        <ul class="list list--nomarker">
                            <li><a href="#">Log in</a></li>
                            <li><a href="#">Entries RSS</a></li>
                            <li><a href="#">Comments RSS</a></li>
                        </ul>
                    </div>
                    <div class="aside-block">
                        <h2 class="text-uppercase">Archives</h2>
                        <ul class="list list--nomarker">
                            <li><a href="#">January 2018</a></li>
                            <li><a href="#">February 2018</a></li>
                            <li><a href="#">March 2018</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
