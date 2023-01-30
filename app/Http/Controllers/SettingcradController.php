<?php

namespace App\Http\Controllers;

use App\Models\Settingcrad;
use App\Http\Requests\StoreSettingcradRequest;
use App\Http\Requests\UpdateSettingcradRequest;

class SettingcradController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setting.index');
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
     * @param  \App\Http\Requests\StoreSettingcradRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingcradRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settingcrad  $settingcrad
     * @return \Illuminate\Http\Response
     */
    public function show(Settingcrad $settingcrad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settingcrad  $settingcrad
     * @return \Illuminate\Http\Response
     */
    public function edit(Settingcrad $settingcrad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingcradRequest  $request
     * @param  \App\Models\Settingcrad  $settingcrad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingcradRequest $request, Settingcrad $settingcrad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settingcrad  $settingcrad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settingcrad $settingcrad)
    {
        //
    }
}
