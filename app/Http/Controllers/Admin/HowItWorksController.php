<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helpers;
use App\Models\HowItWork;
use App\Models\Status;

class HowItWorksController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $howitworks = HowItWork::paginate( 20 );
        return view('dashboard.how-it-work.list', ['howitworks' => $howitworks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.how-it-work.create');
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
            'title'     => 'required|min:10|max:250',
            'desc'      => 'required',
            'status'    => 'required',
            'img'       => 'required|image',
        ]);

        $how_it_work = new HowItWork();
        $how_it_work->title = $request->input('title');
        $how_it_work->slug = $request->input('title');
        $how_it_work->desc = $request->input('desc');
        $how_it_work->status = $request->input('status');
        
        if ($request->has('img')) {
            $img = (new Helpers)->uploadFile($request->file('img'), 'web/uploads', 'web');
            $img = str_replace('public/', '', $img);
            $img = explode('/', $img);
            
            $how_it_work->file_name = array_pop($img);
            $how_it_work->path = implode('/', $img);
        }
        $how_it_work->save();

        $request->session()->flash('message', 'Successfully created.');
        return redirect()->route('how-it-works.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $how_it_work = HowItWork::find($id);
        return view('dashboard.how-it-work.show', [ 'how_it_work' => $how_it_work ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $how_it_work = HowItWork::find($id);

        return view('dashboard.how-it-work.edit', [ 'how_it_work' => $how_it_work ]);
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
            'title'     => 'required|min:10|max:250',
            'desc'      => 'required',
            'status'    => 'required',
        ]);

        $how_it_work            = HowItWork::find($id);
        $how_it_work->title     = $request->input('title');
        $how_it_work->slug      = $request->input('title');
        $how_it_work->desc      = $request->input('desc');
        $how_it_work->status    = $request->input('status');
        
        if ($request->has('img')) {
            unlink('storage/'.$how_it_work->path.'/'.$how_it_work->file_name);
            $img = (new Helpers)->uploadFile($request->file('img'), 'web/uploads', 'web');
            $img = str_replace('public/', '', $img);
            $img = explode('/', $img);
            
            $how_it_work->file_name = array_pop($img);
            $how_it_work->path = implode('/', $img);
        }
        $how_it_work->save();

        $request->session()->flash('message', 'Successfully updated.');

        return redirect()->route('website/admin/how-it-works.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $how_it_work = HowItWork::find($id);
        if($how_it_work){
            unlink('storage/'.$how_it_work->path.'/'.$how_it_work->file_name);

            $how_it_work->delete();
        }
        return redirect()->route('how-it-work.index');
    }
}
