<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use App\Models\Column as colummcrad;
use App\Models\Edit_tab;
use App\Models\Permission as modelpermiss;
use App\Models\TemploraryFile;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\RefreshesPermissionCache;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function __construct()
    {

        // Evita que los usuarios sin permiso accedan por la url
        // permisos y el array son los metodos que quieren que se ejecuten con los permisos
        $this->middleware(['permission:view Posts'], ['only' => 'index']);
        $this->middleware(['permission:create Posts'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit Posts'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete Posts'], ['only' => 'delete']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  dd(Post::query()->orderby('id','desc')->with('tempfile')->first());

        $arrayt = ['TEXT', 'INT', 'BOOLEAN', 'DECIMAL', 'DATE', 'LIST', 'JSON', 'IMAGE', 'LONGTEXT'];
        //   dump($this->get_enum_values("users","isAdmin"));
        $view = view('post.index', compact('arrayt'));
        return $view->render(); // Hello, World!
        return view('post.index');
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
     * @param  \App\Http\Requests\StorepostRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function dropzonedelete()
    {
    }

    public function  dropzone(Request $request)
    {


        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('avatars/tmp/' . $folder, $filename);

            return $folder;
        }
        return '';
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
        $rowq->list_table        = $request->listable;
        $rowq->user_id                = Auth::id();
        $rowq->save();



    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        $Itemtabs=Edit_tab::Active()->get();

        $Itemtabs=$Itemtabs->map(function($col, $key) {

            $result =  [
                    'id'          => $col->id,
                    'name'    => $col->name,
                    'label'     =>$col->label,
                    'Items'    => colummcrad::where('user_id', Auth::id())->where('edit_tab_id',$col->id)->get()->toArray(),
                ];

                return $result;

            });

     /*     foreach ($Itemtabs as $key ) {
             //  dump($key['Items'] );
                foreach ($key['Items'] as $key1 ) {
                            dump($key1['name'] );
                        }
            } */


        $view = view('post.edit', compact( 'Itemtabs','post'));
        return $view->render(); // Hello, World!

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepostRequest  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {

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

                $riw = new TemploraryFile();
                $riw->folder = $folder;
                $riw->filename = $filename;
                $riw->nameinput = $post->id;
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
