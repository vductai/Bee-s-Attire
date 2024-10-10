<?php

namespace App\Http\Controllers\admin;

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
        $sizes = Size::all();
        return view('admin.size.add-size', compact('sizes'));
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
        return redirect()->route('size.create')->with('success', 'Thêm thành công');
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
        $edit = Size::where('size_id', $id)->get();
        return view('admin.size.update-size', compact('edit'));
    }


    public function update(SizeRequest $request, $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $find = Size::find($id);

        $find->update([
           'size_name' => $request->size_name
        ]);

        return redirect()->route('size.index');


    }


    public function destroy($id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $del = ProductVariant::where('size_id', $id)->exists();
        if ($del){
            return redirect()->back()->with('errorSize', 'Sản phẩm này đang có biến thể không thể xoá');
        }else{
            Size::where('size_id', $id)->delete();
            return redirect()->route('size.index');
        }

    }
}
