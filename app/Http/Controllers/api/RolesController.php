<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\request\RoleRequest;
use App\Models\role;
use App\Models\User;

class RolesController extends Controller
{
    public function index()
    {

        $this->authorize('viewAny', User::class);

        $list = role::all();
        return response()->json([
           'mes' => 'list',
           'data' => $list
        ]);
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('create', User::class);


        $create = role::create([
            'role_name' => $request->role_name,
            'role_desc' => $request->role_desc
        ]);

        return response()->json([
            'message' => 'fall',
            'data' => $create
        ]);
    }

    public function update(RoleRequest $request , $id){

        $this->authorize('update', User::class);


        $update = role::where('role_id',$id)->update([
            'role_name' => $request->role_name,
            'role_desc' => $request->role_desc
        ]);

        return response()->json([
            'message' => 'fall',
            'data' => $update
        ]);
    }

    public function destroy($id){

        $this->authorize('delete', User::class);

        $del = role::destroy($id);
        return response()->json([
            'message' => 'fall',
            'data' => $del
        ]);
    }
}
