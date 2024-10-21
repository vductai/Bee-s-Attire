<?php

namespace App\Http\Controllers\admin;

use App\Events\ColorEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use App\Models\ProductVariant;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
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
        //        return response()->json([
//            'message' => 'add',
//            'data' => $list
//        ]);
    }

    public function show($id)
    {
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

    public function create()
    {
        $listColor = Color::all();
        return view('admin.color.add-color', compact('listColor'));
    }

    public function store(ColorRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
            // dd($e);
            
        }

        $create = Color::create([
            'color_name' =>$request->color_name,
            'color_code' => $request->color_code
        ]);

        return redirect()->route('color.index');

//        return response()->json([
//            'message' => 'create',
//            'data' => $create
//        ]);
    }

    public function edit($id){
        $edit = Color::where('color_id', $id)->get();
        return view('admin.color.update-color', compact('edit'));
    }

    public function update(ColorRequest $request, $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $find = Color::findOrFail($id);

        $find->update([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code
        ]);

//        return response()->json([
//            'message' => 'update',
//            'data' => $update
//        ]);
        return redirect()->route('color.index');
    }

    public function destroy($id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }


        $colorVariant = ProductVariant::where('color_id', $id)->exists();
        if ($colorVariant){
            return redirect()->back()->with('errorColor', 'Đang có biến thể của màu này, không thể thực hiện');
        }else{
            Color::where('color_id', $id)->delete();
            return redirect()->route('color.index');
        }
//        return response()->json([
//            'message' => 'delete',
//            'data' => $del
//        ]);
    }
}
