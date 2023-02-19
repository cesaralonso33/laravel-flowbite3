<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use App\Models\Column as colummcrad;
use App\Models\Permission as modelpermiss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\RefreshesPermissionCache;
use Illuminate\Support\Str;


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
        $arrayt = ['TEXT', 'INT', 'DECIMAL', 'LIST','JSON','IMAGE','LONGTEXT'];
        //   dump($this->get_enum_values("users","isAdmin"));
        $view = view('post.index',compact('arrayt'));
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


    public function store(Request $request)
    {



        DB::beginTransaction();

        try {

            $this->CreateColumnPost($request);


            notify()->success(__('The operation has been successfully completed') . ' ⚡️', __('Success'));
            return back();
        } catch (\Exception $e) {
            // DB::rollback();
            notify()->error(__('The operation has been not completed') . $e->getMessage(), __('Error'));
            return back();
        }
    }




    public function CreateColumnPost(Request $request)
    {
        $request->required  = ($request->required == "on" ? true : false);
        $request->name      = Str::replace(" ","", str::upper($request->name));
        $request->list           = str::upper($request->list);
        $request->type         = ($request->required == "on" ? true : false);
        if ($request->type === "LIST" and !empty($request->list)) {
            DB::SELECT("ALTER TABLE posts ADD {$request->name} enum({$request->list}) {$request->opcval};");
        } else {
            DB::SELECT("ALTER TABLE posts ADD {$request->name} {$request->type} {$request->opcval};");
        }

        //    DB::SELECT("ALTER TABLE posts DROP COLUMN {$request->name};");

        $rowq = new colummcrad();
        $rowq->name     = $request->name;
        $rowq->label    = $request->label;
        $rowq->required = $request->required;
        $rowq->list     = ($request->type == "LIST" ? true : false);
        $rowq->type    = $request->type;
        $rowq->user_id  = Auth::id();
        $rowq->save();


        Permission::create(['name' => 'view ' . $request->name]);
        Permission::create(['name' => 'edit ' . $request->name]);
        Permission::create(['name' => 'delete ' . $request->name]);
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

        $items = colummcrad::where('user_id', Auth::id())->get();
        $view = view('post.edit', compact('items', 'post'));
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
        try {

            $post->update($request->except(['_token', '_method']));
            notify()->success(__('The operation has been successfully completed') . ' ⚡️', __('Success'));
            return redirect('/posts');
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
