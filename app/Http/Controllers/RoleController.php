<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role as permissrole;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function mappermiss(){


        $roles=Role::all();

        $collection = collect($roles);

        $consult= DB::SELECT("SELECT role_has_permissions.*,permissions.* FROM roles inner join role_has_permissions on role_has_permissions.role_id = roles.id inner join permissions on permissions.id=role_has_permissions.permission_id");

        $multiplied = $collection->map(function ($item, $key) {
            $ret= DB::SELECT("SELECT  permissions.id,permissions.name FROM roles inner join role_has_permissions on role_has_permissions.role_id = roles.id inner join permissions on permissions.id=role_has_permissions.permission_id where role_id=".$item->id);

            $ert=[
               "id_rol"=>$item->id,
               "nombre_rol"=>$item->name,
               "Permission"=>$ret
           ];
            return $ert;//$item->name;
        });

        return $multiplied->all();


      //  return DB::SELECT("SELECT role_has_permissions.*,roles.* FROM roles  left join role_has_permissions on role_has_permissions.role_id = roles.id");

      return DB::SELECT("SELECT permissions.id,permissions.name FROM roles inner join role_has_permissions on role_has_permissions.role_id = roles.id inner join permissions on permissions.id=role_has_permissions.permission_id ORDER BY `role_has_permissions`.`permission_id` ASC");


    }

    public function index()
    {
    //    dd($this->mappermiss());
        /*
        $all_roles_except_a_and_b = permissrole::whereNotIn('name', ['Admin'])->get();
        return $all_roles_except_a_and_b;
 */

        //$itemstable=$this->mappermiss();
       // dd($itemstable);
        return view('role.index');
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
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {


        return view('role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
