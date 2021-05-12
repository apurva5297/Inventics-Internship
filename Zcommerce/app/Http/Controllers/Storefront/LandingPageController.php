<?php

namespace App\Http\Controllers\Storefront;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\Blog;
use App\Faq;
use App\SubscriptionPlan;
use App\Slider;
use Session;
use App\ScheduleDemo;

class LandingPageController extends Controller
{
    public function index()
    {
    	$sliders = Slider::with('featuredImage:path,imageable_id,imageable_type')->orderBy('order', 'asc')->get()->toArray();
    	$subscription_plans = SubscriptionPlan::orderBy('cost','asc')->get();
    	$faqs = Faq::orderBy('created_at','desc')->orderBy('id','desc')->limit(5)->get();
    	$blogs = Blog::where(['user_id'=>1,'status'=>1,'approved'=>1])->orderBy('id','desc')->limit(6)->get();
    	$copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
    	$other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
    	return view('landing_page',compact('sliders','copyright_page','other_page','blogs','faqs','subscription_plans'));
    }

    public function landing_old()
    {
        $sliders = Slider::with('featuredImage:path,imageable_id,imageable_type')->orderBy('order', 'asc')->get()->toArray();
        $subscription_plans = SubscriptionPlan::orderBy('cost','asc')->get();
        $faqs = Faq::orderBy('created_at','desc')->orderBy('id','desc')->limit(5)->get();
        $blogs = Blog::where(['user_id'=>1,'status'=>1,'approved'=>1])->orderBy('id','desc')->limit(6)->get();
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_page_old2',compact('sliders','copyright_page','other_page','blogs','faqs','subscription_plans'));
    }

    public function Blogs()
    {
    	$blogs = Blog::where(['user_id'=>1,'status'=>1,'approved'=>1])->paginate(12);
    	$copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
    	$other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
    	return view('landing.pages.blog',compact('blogs','copyright_page','other_page'));
    }

    public function Pricing()
    {
    	$subscription_plans = SubscriptionPlan::orderBy('cost','asc')->get();
    	$copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
    	$other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
    	return view('landing.pages.pricing',compact('subscription_plans','copyright_page','other_page'));
    }

    public function ContactUs()
    {
    	$copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
    	$other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
    	return view('landing.pages.contact-us',compact('copyright_page','other_page'));
    }

    public function Faqs()
    {
    	$faqs = Faq::orderBy('created_at','desc')->get();
    	$copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
    	$other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
    	return view('landing.pages.faqs',compact('faqs','copyright_page','other_page'));
    }

    public function Manage()
    {
    	$copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
    	$other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
    	return view('landing.pages.manage',compact('copyright_page','other_page'));
    }

    public function Market()
    {
    	$copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
    	$other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
    	return view('landing.pages.market',compact('copyright_page','other_page'));
    }

    public function About()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing.pages.about',compact('copyright_page','other_page'));
    }

    public function SellYourBusiness()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing.pages.sell_business',compact('copyright_page','other_page'));
    }

    public function sell()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing.pages.sell',compact('copyright_page','other_page'));
    }

    public function career()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        $pages = Page::where('slug','career')->first();
        return view('landing.pages.career',compact('copyright_page','other_page','pages'));
    }

    public function contact()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing.pages.contact',compact('copyright_page','other_page'));
    }

    public function multichennelSolution()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing.pages.multichannel_solution',compact('copyright_page','other_page'));
    }
    public function warehouseManagement()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing.pages.warehouse_management',compact('copyright_page','other_page'));
    }
    public function omnichannelSolution()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing.pages.omnichannel_solution',compact('copyright_page','other_page'));
    }
    public function dropShipmentSolution()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing.pages.drop_shipment_solution',compact('copyright_page','other_page'));
    }
    public function erpIntegration()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing.pages.erp_integration',compact('copyright_page','other_page'));
    }

    public function bannerEmailForm(Request $request)
    {
        Session::put('email',$request->email);
        return redirect('/register');
    }

    public function DemoContact(Request $request)
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing.pages.demo_contact',compact('copyright_page','other_page'));
    }

    public function scheduleDemo(Request $request)
    {
        $data = array(
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'schedule_date' => $request->schedule_date,
        );
        ScheduleDemo::create($data);
        return redirect()->back()->with('success_message','Your request submit successfull. We will get in touch soon...');
    }










    public function landing_Blogs()
    {
        $blogs = Blog::where(['user_id'=>1,'status'=>1,'approved'=>1])->paginate(12);
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.blog',compact('blogs','copyright_page','other_page'));
    }

    public function landing_Pricing()
    {
        $subscription_plans = SubscriptionPlan::orderBy('cost','asc')->get();
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.pricing',compact('subscription_plans','copyright_page','other_page'));
    }

    public function landing_ContactUs()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.contact-us',compact('copyright_page','other_page'));
    }

    public function landing_Faqs()
    {
        $faqs = Faq::orderBy('created_at','desc')->get();
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.faqs',compact('faqs','copyright_page','other_page'));
    }

    public function landing_Manage()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.manage',compact('copyright_page','other_page'));
    }

    public function landing_Market()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.market',compact('copyright_page','other_page'));
    }

    public function landing_About()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.about',compact('copyright_page','other_page'));
    }

    public function landing_SellYourBusiness()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.sell_business',compact('copyright_page','other_page'));
    }

    public function landing_sell()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.sell',compact('copyright_page','other_page'));
    }

    public function landing_career()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        $pages = Page::where('slug','career')->first();
        return view('landing_old.pages.career',compact('copyright_page','other_page','pages'));
    }

    public function landing_multichennelSolution()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.multichannel_solution',compact('copyright_page','other_page'));
    }
    public function landing_warehouseManagement()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.warehouse_management',compact('copyright_page','other_page'));
    }
    public function landing_omnichannelSolution()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.omnichannel_solution',compact('copyright_page','other_page'));
    }
    public function landing_dropShipmentSolution()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.drop_shipment_solution',compact('copyright_page','other_page'));
    }
    public function landing_erpIntegration()
    {
        $copyright_page = Page::where(['author_id'=>1,'position'=>'copyright_area'])->get();
        $other_page = Page::where(['author_id'=>1])->where('position','!=','copyright_area')->get();
        return view('landing_old.pages.erp_integration',compact('copyright_page','other_page'));
    }
}
