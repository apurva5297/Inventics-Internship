@extends('landing.layout')

@section('content')

@include('landing.element.breadcum.demo-contact')
<style type="text/css">
    .form-field-wrap
    {
        margin-bottom: 40px;
    }
</style>

<div class="site-content-contain">
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="container">

                    <article id="post-1083" class="post-1083 page type-page status-publish hentry">
                        <div class="sf-content">
                            <div data-elementor-type="wp-page" data-elementor-id="1083" class="elementor elementor-1083"
                                data-elementor-settings="[]">
                                <div class="elementor-inner">
                                    <div class="elementor-section-wrap">
                                        <div class="elementor-section elementor-top-section elementor-element elementor-element-77467f2c elementor-section-stretched elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                            data-id="77467f2c" data-element_type="section"
                                            data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}"
                                            style="width: 1368px; left: -114px;">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                                                    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-35a17162"
                                                        data-id="35a17162" data-element_type="column">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-27574d03 elementor-widget__width-initial elementor-widget elementor-widget-image animated zoomIn"
                                                                    data-id="27574d03" data-element_type="widget"
                                                                    data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_delay&quot;:500}"
                                                                    data-widget_type="image.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-image">
                                                                            <img width="519" height="609"
                                                                                src="https://iqonic.design/wp-themes/sofbox-elementor/wp-content/uploads/2020/07/about-1.png"
                                                                                class="attachment-full size-full" alt=""
                                                                                loading="lazy"
                                                                                srcset="https://iqonic.design/wp-themes/sofbox-elementor/wp-content/uploads/2020/07/about-1.png 519w, https://iqonic.design/wp-themes/sofbox-elementor/wp-content/uploads/2020/07/about-1-256x300.png 256w"
                                                                                sizes="100vw"> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-26c90f98 animated fadeInRight"
                                                        data-id="26c90f98" data-element_type="column"
                                                        data-settings="{&quot;animation&quot;:&quot;fadeInRight&quot;,&quot;animation_delay&quot;:500}">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <!-- <div class="elementor-element elementor-element-10c57936 elementor-widget elementor-widget-section_title"
                                                                    data-id="10c57936" data-element_type="widget"
                                                                    data-widget_type="section_title.default">
                                                                    <div class="elementor-widget-container">

                                                                        <div
                                                                            class=" text-left iq-title-box iq-title-default iq-title-box-1">
                                                                            <div class="iq-title-icon">
                                                                            </div>

                                                                            <h2 class="iq-title">Schedule Demo</h2>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                                <div class="elementor-element elementor-element-225cae7f elementor-widget elementor-widget-iqonic_icon_box"
                                                                    data-id="225cae7f" data-element_type="widget"
                                                                    data-widget_type="iqonic_icon_box.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div
                                                                            class="iq-icon-box iq-icon-box-style-2  active ">


                                                                            
                                                                                
        
<form class="form" action="{{url('schedule-demo')}}" method="post" style="width: 100%">
    @csrf
    <h4 style="text-align: center;"> <a href="#" style="text-align: center;">Schedule A Demo</a></h4>
    @if(session()->has('success_message'))
        <div class="alert alert-success fadeout_message">
            {{ session()->get('success_message') }}
        </div>
    @endif

    <div class="form-field-wrap">
        <div class="form-group">
            <input type="text" name="name" placeholder="Enter your name*" title="Atleast 3 character required" pattern="([A-z\s]){3,}" required="required" class="form-control">
        </div>
    </div>
    <br />
    <div class="form-field-wrap">
        <div class="form-group">
            <input type="text" name="company_name" placeholder="Enter company name*" pattern="([A-z0-9\s]){3,}" required="required" class="form-control">
        </div>
    </div>
    <br />
    <div class="form-field-wrap">
        <div class="form-group">
            <input type="email" name="email" placeholder="Enter email*" required="required" class="form-control">
        </div>
    </div>
    <br />
    <div class="form-field-wrap">
        <div class="form-group">
            <input type="text" name="phone" placeholder="Enter your phone*" pattern="[0-9]{10}" title="Only 10 digit mobile number supported" required="required" class="form-control">
        </div>
    </div>
    <br />
    <div class="form-field-wrap">
        <div class="form-group">
            <!-- <input type="datetime-local" name="name" placeholder="Name*" class="form-control"> -->
            <input type="text" name="schedule_date" placeholder="Schedule Date & Time" class="form-control date_time">
        </div>
    </div>
    <br /><br />
   <div class="form-field-wrap">
        <div class="form-group">
            <input type="submit" class="btn btn-info" style="margin-left: 40%">
        </div>
    </div>
</form>
                                                                        
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
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- #content -->
    @endsection