<?php

namespace App\Http\Controllers\Websiteadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helpers;
use App\Models\Testimonial;

class TestimonialsController extends Controller
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
        $testimonials = Testimonial::paginate( 20 );

        return view('dashboard.testimonial.list', ['testimonials' => $testimonials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.testimonial.create');
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
            'name'      => 'required|min:3|max:200',
            'title'     => 'required|min:3|max:250',
            'desc'      => 'required',
            'status'    => 'required',
            //'img'       => 'required|image',
        ]);

        $testimonial            = new Testimonial();
        $testimonial->name      = $request->input('name');
        $testimonial->title     = $request->input('title');
        $testimonial->slug      = $request->input('title');
        $testimonial->desc      = $request->input('desc');
        $testimonial->status    = $request->input('status');
        
        if ($request->has('img')) {
            $filename = $request->img->getClientOriginalName();
            

            $base_path = 'web/uploads';
            // return $request->folder_id;
            
            $request->img->move(public_path($base_path),$filename);
       
            
            //unlink('storage/'.$how_it_work->path.'/'.$how_it_work->file_name);
            //$img = (new Helpers)->uploadFile($request->file('img'), 'web/uploads', 'web');
            //$img = str_replace('public/', '', $img);
            //$img = explode('/', $img);
            
            $testimonial->file_name = $filename;
            $testimonial->path = $base_path;
        }
        $testimonial->save();

        $request->session()->flash('message', 'Successfully created.');
        return redirect('/websiteadmin/testimonials');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testimonial = Testimonial::find($id);
        return view('dashboard.testimonial.show', [ 'testimonial' => $testimonial ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Testimonial::find($id);

        return view('dashboard.testimonial.edit', [ 'testimonial' => $testimonial ]);
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
            'name'      => 'required|min:3|max:200',
            'title'     => 'required|min:3|max:250',
            'desc'      => 'required',
            'status'    => 'required',
        ]);

        $testimonial            = Testimonial::find($id);
        $testimonial->name      = $request->input('name');
        $testimonial->title     = $request->input('title');
        $testimonial->slug      = $request->input('title');
        $testimonial->desc      = $request->input('desc');
        $testimonial->status    = $request->input('status');
        
        if ($request->has('img')) {
            $filename = $request->img->getClientOriginalName();
           

            $base_path = 'web/uploads';
            // return $request->folder_id;
            
            $request->img->move(public_path($base_path),$filename);
       
            
            //unlink('storage/'.$how_it_work->path.'/'.$how_it_work->file_name);
            //$img = (new Helpers)->uploadFile($request->file('img'), 'web/uploads', 'web');
            //$img = str_replace('public/', '', $img);
            //$img = explode('/', $img);
            
            $testimonial->file_name = $filename;
            $testimonial->path = $base_path;
        }
        $testimonial->save();

        $request->session()->flash('message', 'Successfully updated.');
		return redirect('/websiteadmin/testimonials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        if($testimonial){
            //unlink('public/'.$testimonial->path.'/'.$testimonial->file_name);

            $testimonial->delete();
        }
        return redirect('/websiteadmin/testimonials');
    }
}
