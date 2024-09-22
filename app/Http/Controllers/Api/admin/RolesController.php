<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\role;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class RolesController extends Controller
{

    public function index()
    {

        try {
            $this->authorize('viewAny', role::class);
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
            $this->authorize('create', role::class);
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
            $this->authorize('update', role::class);
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
            $this->authorize('delete', role::class);
        } catch (AuthorizationException $e) {
        }

        $del = role::destroy($id);
        return response()->json([
            'message' => 'fall',
            'data' => $del
        ]);
    }
}
