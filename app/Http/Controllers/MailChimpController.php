<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Models\Template;
use App\Models\HowItWork;
use App\Models\Testimonial;
use Newsletter;
use Illuminate\Support\Facades\Validator;

class MailChimpController extends Controller
{
    public function subscribeMailChimp (Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email:rfc,dns"
        ]);

        if ($validator->fails()) {
            return response()->json(["msg" => "Please enter valid email"], 400);
        }

        $newsLetter = Newsletter::subscribe($request->get("email"));

        return response()->json(["msg" => "We will notify you."], 200);
    }
}
