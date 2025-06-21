<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('usero.roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $role = Role::create(['name' => $request->input('name')]);

        /*LOGBOOK */
        $detailconstruction = "Data= Name: ".$role->name;
        $logbook= new Logbook();
        $logbook->email_user = auth()->user()->email;
        $logbook->activity = "Create Role";
        $logbook->detail = $detailconstruction;
        $logbook->date_activity = Carbon::now();
        $logbook->save();
        /*END LOGBOOK */

        return back()->with('store','OK');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
        $permissions = Permission::all();
        return view('usero.rolepermission', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
        /* $user->roles()->sync($validated_data['roles']); */
        /* $role->syncPermissions($request->permissions); */
        $role->permissions()->sync($request->permissions);

        /*LOGBOOK */
        $detailconstruction = "Data= Role: ".$role->name;
        $logbook= new Logbook();
        $logbook->email_user = auth()->user()->email;
        $logbook->activity = "Update Role Permissions";
        $logbook->detail = $detailconstruction;
        $logbook->date_activity = Carbon::now();
        $logbook->save();
        /*END LOGBOOK */

        return redirect()->route('roles.edit', $role)->with('edit','OK');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();

        /*LOGBOOK */
        $detailconstruction = "Data= Role: ".$role->name;
        $logbook= new Logbook();
        $logbook->email_user = auth()->user()->email;
        $logbook->activity = "Delete Role";
        $logbook->detail = $detailconstruction;
        $logbook->date_activity = Carbon::now();
        $logbook->save();
        /*END LOGBOOK */


        return redirect()->route('roles.index')->with('delete','OK');
    }
}
