<?php

namespace App\Http\Controllers\Websiteadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helpers;
use App\Models\Template;

class TemplatesController extends Controller
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
    public function index($page)
    {
        $templates = Template::where("slug", $page)->first();

        return view('dashboard.template.edit', ['templates' => $templates, "page" => $page]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $page)
    {
        $validatedData = $request->validate([
            'name'      => 'required|min:3|max:200',
            'html'      => 'required',
            'status'    => 'required',
        ]);

        if ($request->has("id") && !empty($request->get("id")) && $request->get("id") != null) {
            $template = Template::find($request->get("id"));

        } else {
            $template = new Template();
        }

        $template->name      = $request->input('name');
        $template->slug      = $request->input('name');
        $template->html      = $request->input('html');
        $template->status    = $request->input('status');
        $template->save();

        $request->session()->flash('message', 'Successfully created.');
        return redirect('/websiteadmin/templates/'.$page);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::find($id);
        return view('dashboard.template.show', [ 'testimonial' => $template ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = Template::find($id);

        return view('dashboard.template.edit', [ 'testimonial' => $template ]);
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

        $template            = Template::find($id);
        $template->name      = $request->input('name');
        $template->title     = $request->input('title');
        $template->slug      = $request->input('title');
        $template->desc      = $request->input('desc');
        $template->status    = $request->input('status');
        
        if ($request->has('img')) {
            unlink('storage/'.$template->path.'/'.$template->file_name);
            $img = (new Helpers)->uploadFile($request->file('img'), 'web/uploads', 'web');
            $img = str_replace('public/', '', $img);
            $img = explode('/', $img);
            
            $template->file_name = array_pop($img);
            $template->path = implode('/', $img);
        }
        $template->save();

        $request->session()->flash('message', 'Successfully updated.');

        return redirect('/websiteadmin/templates/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::find($id);
        if($template){
            unlink('storage/'.$template->path.'/'.$template->file_name);

            $template->delete();
        }
        return redirect('/websiteadmin/templates/');
    }
}
