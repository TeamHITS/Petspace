<?php

namespace App\Http\Controllers\Websiteadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helpers;
use App\Models\FAQ;

class FAQSController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = FAQ::paginate( 20 );

        return view('dashboard.faq.list', ['faqs' => $faqs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'     => 'required|min:3|max:250',
            'desc'      => 'required',
            'status'    => 'required',
        ]);

        $faq            = new FAQ();
        $faq->title     = $request->input('title');
        $faq->slug      = $request->input('title');
        $faq->desc      = $request->input('desc');
        $faq->status    = $request->input('status');        
        $faq->save();

        $request->session()->flash('message', 'Successfully created.');
        return redirect()->route('faqs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = FAQ::find($id);
        return view('dashboard.faq.show', [ 'faq' => $faq ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = FAQ::find($id);

        return view('dashboard.faq.edit', [ 'faq' => $faq ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title'     => 'required|min:3|max:250',
            'desc'      => 'required',
            'status'    => 'required',
        ]);

        $faq            = FAQ::find($id);
        $faq->title     = $request->input('title');
        $faq->slug      = $request->input('title');
        $faq->desc      = $request->input('desc');
        $faq->status    = $request->input('status');
        $faq->save();

        $request->session()->flash('message', 'Successfully updated.');

        return redirect()->route('faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = FAQ::find($id);
        if($faq){
            unlink('storage/'.$faq->path.'/'.$faq->file_name);

            $faq->delete();
        }
        return redirect()->route('faqs.index');
    }
}
