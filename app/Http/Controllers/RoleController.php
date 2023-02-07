<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\module;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role as permissrole;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {

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


        $rolePermissions = Permission::select('id', 'name')
            ->join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();

        $collectiond = collect($rolePermissions);
        $collection = collect(module::where('status', 'Active')->get());

        $multiplied = $collection->map(function ($item, $key) use ($collectiond) {

            $valor[0] = $collectiond->firstWhere('name', 'view ' . $item->name);
            $valor[1] = $collectiond->firstWhere('name', 'edit ' . $item->name);
            $valor[2] = $collectiond->firstWhere('name', 'delete ' . $item->name);

            return   [
                "id" => $item->id,
                "name" => $item->name,
                "data" => [
                    "view" => ($valor[0] == null ? false : true),
                    "edit" => ($valor[1] == null ? false : true),
                    "delete" => ($valor[2] == null ? false : true),
                ]
            ];
        });


        return view('role.edit', compact('role', 'multiplied'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        try {


            $rol = permissrole::findByName($role->name);
            $iteml = [];;
            foreach ($request->except(['_token', '_method']) as $item) {

                $iteml[] = $item;
            }
            $rol->syncPermissions($iteml);


            notify()->success(__('The operation has been successfully completed') . ' ⚡️', __('Success'));
            return back();
        } catch (\Exception $e) {
            // DB::rollback();
            notify()->error(__('The operation has been not completed') . $e->getMessage(), __('Error'));
            return back();
        }
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
