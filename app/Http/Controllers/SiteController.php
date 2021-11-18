<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Models\Template;
use App\Models\HowItWork;
use App\Models\Testimonial;
use Mail;

class SiteController extends Controller
{
    public function index ()
    {
        $how_it_works = HowItWork::where("status", 1)->get();
        $testimonials = Testimonial::where("status", 1)->get();
        $faqs = FAQ::where("status", 1)->get();
        return view("site.index", [
            "how_it_works" => $how_it_works,
            "testimonials" => $testimonials,
            "faqs" => $faqs,
        ]);
    }

    public function about ()
    {
        return view("site.about");
    }

    public function beAPartner ()
    {
        return view("site.be-a-partner");
    }

    public function contact ()
    {
        return view("site.contact");
    }
    
    public function policy ()
    {
        $templates = Template::where("slug", 'privacy-policy')->first();

        return view("site.policy", ["templates" => $templates]);
    }

    public function terms ()
    {
        $templates = Template::where("slug", 'terms')->first();

        return view("site.terms", ["templates" => $templates]);
    }
    
    
    
    public function storeContactForm(Request $request)
    {
    	
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required|numeric',
            'business_name' => 'required',
            'business' => 'required',
        ]);


        //  Send mail to admin
        \Mail::send('site.contactMail', array(
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'business_name' => $request->business_name,
            'business' => $request->business,
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('info@petspace.app', 'Admin')->subject('New Partner Request');
        });
        
        if (Mail::failures()) {
        	$jsondata = array(
        					 	'success'	=> false,
        					 	'message'	=> 'Email Not Sent',
        					 );
        	return json_encode($jsondata);				 
	        //return redirect()->back()->with(['success' => 'Email Not Sent']);
	    }else
	    {
	    	$jsondata = array(
        					 	'success'	=> true,
        					 	'message'	=> 'Thank you! A  representative from Petspace will contact you soon 😄',
        					 );
        	return json_encode($jsondata);	
	    	//return redirect()->back()->with(['success' => 'Thank you! A  representative from Petspace will contact you soon 😄']);
	    }

        
    }
}
