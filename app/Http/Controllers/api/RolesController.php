<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\requests\RoleRequest;
use App\Models\role;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class RolesController extends Controller
{

    public function index()
    {

        try {
            $this->authorize('viewAny', User::class);
        } catch (AuthorizationException $e) {
        }

        $list = role::all();
        return response()->json([
           'mes' => 'list',
           'data' => $list
        ]);
    }


    public function store(RoleRequest $request)
    {
        try {
            $this->authorize('create', User::class);
        } catch (AuthorizationException $e) {
        }


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

        try {
            $this->authorize('update', User::class);
        } catch (AuthorizationException $e) {
        }


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

        try {
            $this->authorize('delete', User::class);
        } catch (AuthorizationException $e) {
        }

        $del = role::destroy($id);
        return response()->json([
            'message' => 'fall',
            'data' => $del
        ]);
    }
}
