<?php

namespace App\Http\Controllers\admin;

use App\Events\ColorEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use App\Models\ProductVariant;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $listColor = Color::all();
        return view('admin.color.list-color', compact('listColor'));
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

    public function create(){
        $listColor = Color::all();
        return view('admin.color.add-color',compact('listColor'));
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
        return response()->json($create);
    }

    public function edit($id){
        $edit = Color::findOrFail($id);
        $listColor = Color::all();
        return view('admin.color.update-color', compact('edit', 'listColor'));
    }

    public function update(ColorRequest $request, $id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $find = Color::findOrFail($id);
        $find->update([
            'color_name' => $request->color_name,
           'color_code' => $request->color_code
        ]);
        return response()->json($find);
    }

    public function destroy(Color $color){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $color->delete();
        return response()->json(['message' => 'done']);
    }
}
