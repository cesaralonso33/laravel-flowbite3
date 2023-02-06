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


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     //   dump($this->get_enum_values("users","isAdmin"));
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

     public function crearcolumna($name,$label,$req,$type){
        try{
            if(!(colummcrad::where('name',$name)->where('user_id',Auth::id())->first())){

                $rowq=new colummcrad();
                $rowq->name=$name;
                $rowq->label=$label;
                $rowq->required=$req;
                $rowq->list=($type=="LIST"? true:false);
                $rowq->user_id=Auth::id();
                $rowq->save();

                return true;

            }else{return false;}
        } catch (\Exception $e) {
            return false;
         }
    }

        public function crearoles($name,$creat=true){
            try{
                    if(!$creat){
                        Permission::whereIn('name',['view '.$name,'edit '.$name,'delete '.$name])->destroy();
                    }
                    //::create(['name' =>  $request->name,'user_id' => Auth::id()]);
                    Permission::create(['name' => 'view '.$name]);
                    Permission::create(['name' => 'edit '.$name]);
                    Permission::create(['name' => 'delete '.$name]);

                return true;
            } catch (\Exception $e) {
                return false;
            }
        }

        public function  AddColummnPost($name,$type,$label,$req,$list){
            try{

                $opcval=($req ? 'NOT NULL':'NULL');
                if($type==="LIST" AND !empty($list))
                    {
                        DB::SELECT("ALTER TABLE posts ADD {$name} enum({$list}) {$opcval};");

                    }else{
                        DB::SELECT("ALTER TABLE posts ADD {$name} {$type} {$opcval};");
                    }

                    if($this->crearcolumna($name,$label,$req,$type)){ //agrega el nombre de la columna en la tabla **columnns**
                        return $this->crearoles($name);
                    }else{
                        DB::SELECT("ALTER TABLE posts DROP COLUMN {$name};");
                    return false;
                    }

                return true;
            } catch (\Exception $e) {
                return false;
            }
        }


    public function store(Request $request)
    {

       $request->required = ($request->required=="on"?true:false);

       try{


        if($this->AddColummnPost($request->name,$request->type,$request->label,$request->required,$request->list)){
            notify()->success(__('The operation has been successfully completed') .' ⚡️',__('Success'));
            return back();

        }else{

            notify()->error(__('The operation has been not completed') .' function FALSE',__('Error') );
            return back();

        }



            } catch (\Exception $e) {

                notify()->error(__('The operation has been not completed') .$e->getMessage(),__('Error') );
                return back();
            }


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

       $items= colummcrad::where('user_id',Auth::id())->get();

        return view('post.edit',compact('items','post'));
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
        try{

                $post->update($request->except(['_token','_method']));
                notify()->success(__('The operation has been successfully completed') .' ⚡️',__('Success'));
                return redirect('/posts');

        } catch (\Exception $e) {

            notify()->error(__('The operation has been not completed') .$e->getMessage(),__('Error') );
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
