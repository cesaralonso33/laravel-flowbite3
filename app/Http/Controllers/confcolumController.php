<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Models\ConmfigColummn;
use Illuminate\Http\Request;

class confcolumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colums=Column::all();
        return view('post.configcolumn.index',compact('colums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConmfigColummn  $conmfigColummn
     * @return \Illuminate\Http\Response
     */
    public function show(ConmfigColummn $conmfigColummn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConmfigColummn  $conmfigColummn
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request , $id)
    {

        $data = Column::find($id);
       return view('Setting.confColumns.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConmfigColummn  $conmfigColummn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConmfigColummn  $conmfigColummn
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConmfigColummn $conmfigColummn)
    {
        //
    }
}
