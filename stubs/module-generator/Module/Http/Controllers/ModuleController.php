<?php

namespace Modules\{Module}\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Modules\{Module}\Models\{Model};
use Modules\{Module}\Models\{Model}EditTab;
use Modules\{Module}\Models\{Model}TemploraryFile;
use Modules\{Module}\Models\{Model}Column as colummcrad;



class {Module}Controller extends Controller
{

    public function __construct()
    {

        // Evita que los usuarios sin permiso accedan por la url
        // permisos y el array son los metodos que quieren que se ejecuten con los permisos
        $this->middleware(['permission:view {Module}'], ['only' => 'index']);
        $this->middleware(['permission:create {Module}'], ['only' => ['create', 'store','store2']]);
        $this->middleware(['permission:edit {Module}'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete {Module}'], ['only' => 'delete']);
    }


    public function index()
    {
        $this->createcache();
        $view=view('{module}::index');
        return $view->render();
    }

    public function createcache(){
        if(!Cache::has('{Model}Create'.Auth::id())){
            $Itemtabs=$this->get_tab_and_tab();
            $arrayt = ['TEXT', 'INT', 'BOOLEAN', 'DECIMAL', 'DATE', 'LIST', 'JSON', 'IMAGE', 'LONGTEXT','RELATION'];
            $hola=view('{module}::opc',compact('Itemtabs','arrayt'));
            Cache::put('{Model}Create'.Auth::id(),$hola->render());
        }

    }

    public function create()
    {
        return view('{module}::create');
    }


    public function store2(Request $request)
    {
        try {

            {Model}::create( $request->except(['_token', '_method'] ));

            notify()->success(__('The operation has been successfully completed') . ' ⚡️', __('Success'));
        } catch (\Exception $e) {
            notify()->error(__('The operation has been not completed') . $e->getMessage(), __('Error'));
        }
        return redirect()->route('app.{module}.index');
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
            Cache::pull('{Model}Create'.Auth::id());
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


    public function get_tab_and_tab()
    {
        $Itemtabs={Model}EditTab::Active()->get();
        $Itemtabs=$Itemtabs->map(function($col, $key) {
        $result =  [
                'id'          => $col->id,
                'name'    => $col->name,
                'label'     =>$col->label,
                'Items'    => colummcrad::where('user_id', Auth::id())->where('edit_tab_id',$col->id)->get()->toArray(),
            ];
            return $result;
        });
        return  $Itemtabs;
    }



    public function edit($id)
    {
        $post={Model}::findOrFail($id)->first();

        $Itemtabs=$this->get_tab_and_tab();

        return view('{module}::edit', compact( 'Itemtabs','post'));


    }

    public function update(Request $request,  $id)
    {

        $post=  {Model}::find($id)->first();

        if ($request->file('files')) {

            foreach ($request->file('files') as $key => $file) {

                $filename = $file->getClientOriginalName();
                $folder = uniqid() . '-' . now()->timestamp;
                $file->storeAs('avatars/tmp/' . $folder, $filename);

                try {
                    //code...
                    $image = Image::make($file);
                    $image->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    Storage::put('avatars/tmp/' . $folder . '/small_' . $filename, (string) $image->encode());
                } catch (\Throwable $th) {
                    //throw $th;
                }

                $riw = new {Model}TemploraryFile();
                $riw->folder = $folder;
                $riw->filename = $filename;
                $riw->nameinput = $id;
                $riw->post_id = $request->id;
                $riw->save();
            }
        }


        try {

            $post->update($request->except(['_token', '_method', 'timage', 'id']));

            notify()->success(__('The operation has been successfully completed') . ' ⚡️', __('Success'));
            //return redirect('/posts');
            return back();
        } catch (\Exception $e) {

            notify()->error(__('The operation has been not completed') . $e->getMessage(), __('Error'));
            return back();
        }
        return redirect(route('app.{module}.index'));
    }

    public function destroy($id)
    {
        /* {Model}::findOrFail($id)->delete();
        return redirect(route('app.{module}.index'));
         */
    }


}
