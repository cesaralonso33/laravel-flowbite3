<?php

namespace App\Http\Controllers;

use App\Models\ListTable;
use App\Http\Requests\StoreListTableRequest;
use App\Http\Requests\UpdateListTableRequest;

class ListTableController extends Controller
{
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
     * @param  \App\Http\Requests\StoreListTableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListTableRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListTable  $listTable
     * @return \Illuminate\Http\Response
     */
    public function show(ListTable $listTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListTable  $listTable
     * @return \Illuminate\Http\Response
     */
    public function edit(ListTable $listTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateListTableRequest  $request
     * @param  \App\Models\ListTable  $listTable
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateListTableRequest $request, ListTable $listTable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListTable  $listTable
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListTable $listTable)
    {
        //
    }
}
