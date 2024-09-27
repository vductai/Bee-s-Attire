<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $list = Color::all();
        return response()->json([
            'message' => 'add',
            'data' => $list
        ]);
    }

    public function show($id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $sel = Color::where('color_id', $id)->get();
        return response()->json([
            'message' => 'add',
            'data' => $sel
        ]);
    }

    public function store(ColorRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $create = Color::create([
            'color_name' =>$request->color_name,
            'color_code' => $request->color_code
        ]);

        return response()->json([
            'message' => 'create',
            'data' => $create
        ]);
    }

    public function update(ColorRequest $request, $id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $update = Color::where('color_id', $id)->update([
           'color_code' => $request->color_code
        ]);

        return response()->json([
            'message' => 'update',
            'data' => $update
        ]);
    }

    public function destroy($id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $del = Color::where('color_id', $id)->delete();
        return response()->json([
            'message' => 'delete',
            'data' => $del
        ]);

    }

}
