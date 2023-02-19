<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function __construct()
    {
        // Evita que los usuarios sin permiso accedan por la url
        // permisos y el array son los metodos que quieren que se ejecuten con los permisos
        $this->middleware(['permission:view Users'], ['only' => 'index']);
        $this->middleware(['permission:create User'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit Users'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete User'], ['only' => 'delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Toast Message when new user register

        return view('users.index' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $collection = collect( Auth::id()===1 ?  Role::select('id','name')->get() : Role::select('id','name')->where('name','<>','Super-Admin')->get() );

        $keyed = $collection->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        });

        $roles=$keyed->all();

        //$roles= Role::select('id','name')->where('Name','<>','Super-Admin')->get();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|unique:users|max:199',
            'email'=> 'required|unique:users|max:199',
            'password' => 'required|confirmed|min:8',
            'role'=>'required'
        ]);


        $jso=json_decode($request->role);
        $request->password=Hash::make($request->password);
        $newuser=user::create($request->except(['_token','password_confirmation','role']));
        $newuser->assignRole($jso->{'name'});

        return redirect('/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rowuser=user::find($id);
        $usec=$rowuser->getRoleNames(); // Returns a collection
        $selectrole=$usec[0];

//        $roles= Role::select('id','name')->get();

        $collection = collect( Role::select('id','name')->get());

        $keyed = $collection->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        });

        $roles=$keyed->all();

       // $itemselect= $selectrole[0]['id'];





        return view('users.edit',compact('rowuser','roles','selectrole'));
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



        $validated = $request->validate([
            'name'      => 'required|max:199',
            'email'     => 'required|max:199',
            'password'  => 'confirmed',
            'role'      =>'required'
        ]);

        /* $jso=json_decode($request->role);
        $newuser->assignRole($jso->{'name'});
        */
        try {

            $newuser= User::find($id);
            $newuser->name=$request->name;
            $newuser->email=$request->email;
            $newuser->active=($request->active=="on" ? 1:0);
            if(!empty($request->password) ) $newuser->password=Hash::make($request->password);
            // $newuser->assignRole($request->role);
            $newuser->syncRoles([$request->role]);
            $newuser->save();

            notify()->success(__('The operation has been successfully completed') .' ⚡️',__('Success'));

            return redirect('/users');

        } catch (\Exception $e) {



            notify()->preset(__('The operation has been not completed') .$e->getMessage(),__('Error'));

        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
