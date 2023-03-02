<?php

namespace Modules\{Module}\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\{Module}\Models\{Model};


use Modules\{Module}\Models\{Model}Column as colummcrad;
use App\Models\Edit_tab;
use App\Models\TemploraryFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class {Module}Controller extends Controller
{
    public function index()
    {

        //  dd(Post::query()->orderby('id','desc')->with('tempfile')->first());

        $arrayt = ['TEXT', 'INT', 'BOOLEAN', 'DECIMAL', 'DATE', 'LIST', 'JSON', 'IMAGE', 'LONGTEXT','RELATION'];
        //   dump($this->get_enum_values("users","isAdmin"));

        //${module} = {Model}::get();
        return view('{module}::index', compact('arrayt'));
    }

    public function create()
    {
        return view('{module}::create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|unique:columns|max:255',
        ]);



        DB::beginTransaction();

        try {
            //return $request->all();
            $this->CreateColumnPost($request);

            notify()->success(__('The operation has been successfully completed') . ' ⚡️', __('Success'));
            return back();
        } catch (\Exception $e) {
            // DB::rollback();
            notify()->error(__('The operation has been not completed') . $e->getMessage(), __('Error'));
            return back();
        }
    }



    public function CreateColumnPost($request)
    {
        $request->required  = ($request->required == "on" ? true : false);
        $request->name      = Str::replace(" ", "", str::upper($request->name));
        $request->list           = str::upper($request->list);


        $rowq = new colummcrad();
        $rowq->name                   = $request->name;
        $rowq->label                    = $request->label;
        $rowq->required              = ($request->required ? true : false);
        $rowq->list                       = ($request->type == "LIST" ? true : false);
        $rowq->type                    = $request->type;
        $rowq->hiddentable        = $request->hiddentable;
        $rowq->edit_tab_id          = 1;
        $rowq->list_table              = ( empty($request->listable)?"0": $request->listable);
        $rowq->user_id                = Auth::id();
        $rowq->save();



    }




    public function edit($id)
    {
        ${model} = {Model}::findOrFail($id);

        return view('{module}::edit', compact('{model}'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        {Model}::findOrFail($id)->update([
            'name' => $request->input('name')
        ]);

        return redirect(route('app.{module}.index'));
    }

    public function destroy($id)
    {
        {Model}::findOrFail($id)->delete();

        return redirect(route('app.{module}.index'));
    }
}
