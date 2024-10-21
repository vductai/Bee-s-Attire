<?php

namespace App\Http\Controllers\admin;

use App\Events\SizeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SizeAPIController extends Controller
{


    public function index()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $sizes = Size::all();
        return view('admin.size.list-size', compact('sizes'));
//        return response()->json([
//            'message' => 'list',
//            'data' => $sizes
//        ]);
    }

    public function create(){
        $list = Size::all();
        return view('admin.size.add-size', compact('list'));
    }

    public function store(SizeRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $size = Size::create([
            'size_name' => $request->size_name
        ]);
        return redirect()->route('size.create');
    }


    public function show($size_id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }


        $size = Size::find($size_id);

        if (!$size) {
            return response()->json(['message' => 'Không tìm thấy Size.'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($size);
    }

    public function edit($id){
        $sizes = Size::all();
        $edit = Size::findOrFail($id);
        return view('admin.size.update-size', compact('edit', 'sizes'));
    }


    public function update(SizeRequest $request, $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $find = Size::findOrFail($id);

        $find->update([
           'size_name' => $request->size_name
        ]);

        broadcast(new SizeEvent($find, 'update'))->toOthers();

        return response()->json($find);


    }


    public function destroy(Size $size)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $size->delete();
        broadcast(new SizeEvent($size, 'delete'))->toOthers();
        return response()->json(['mesage' => 'done']);

    }
}
