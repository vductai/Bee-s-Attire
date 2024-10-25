<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }


        $list = User::where('role_id', '=', 3)->get();
        return view('admin.user.list-user', compact('list'));
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
    public function store(UserRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 3
        ]);

        return response()->json([
           'message' => 'add',
           'data' => $user
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
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

        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $user = User::where('user_id', $id)->update([
            'email' => $request->email,
            'password' => $request->password,
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
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        // $user = User::delete($id);

        // return response()->json([
        //     'message' => 'delete',
        //     'data' => $user
        // ]);
    }
}
