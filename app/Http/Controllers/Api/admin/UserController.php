<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $this->authorize('viewAny', User::class);
        } catch (AuthorizationException $e) {
        }

        $list = User::all();
        return response()->json([
            'message' => 'list',
            'data' => $list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(UserRequest $request)
//    {
//        $user = User::create([
//            'email' => $request->email,
//            'password' => $request->password,
//            'email' => $request->email,
//            'role_id' => 3
//        ]);
//
//        return response()->json([
//           'message' => 'add',
//           'data' => $user
//        ]);
//
//    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('user_id', $id)->get();
        return response()->json([
            'message' => 'user id',
            'data' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {


        $user = User::where('user_id', $id)->update([
            'email' => $request->email,
            'password' => $request->password,
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'update',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::delete($id);

        return response()->json([
            'message' => 'delete',
            'data' => $user
        ]);
    }
}