<?php

namespace App\Http\Controllers;

use App\Models\module;
use App\Http\Requests\StoremoduleRequest;
use App\Http\Requests\UpdatemoduleRequest;

class ModuleController extends Controller
{

/*
    public function __construct()
    {
        // Evita que los usuarios sin permiso accedan por la url
        // permisos y el array son los metodos que quieren que se ejecuten con los permisos
        $this->middleware(['permission:view Roles'], ['only' => 'index']);
        $this->middleware(['permission:create Roles'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit Roles'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete Roles'], ['only' => 'delete']);
    }
 */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoremoduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoremoduleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatemoduleRequest  $request
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatemoduleRequest $request, module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(module $module)
    {
        //
    }
}
