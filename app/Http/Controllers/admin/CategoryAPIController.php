<?php

namespace App\Http\Controllers\admin;

use App\Events\CategoryEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Parent_Category;
use App\Models\User;
use App\Policies\CategoryPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoryAPIController extends Controller
{

    public function index()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $list = Category::all();
        return view('admin.category.list-category', compact('list'));
    }


    public function create(){
        $list = Category::all();
        $parent = Parent_Category::all();
        return view('admin.category.add-category', compact('list', 'parent'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $check = Category::where('category_name', $request->category_name)->exists();
        if ($check){
            return response()->json([
                'success' => false,
                'message' => 'Đã có danh mục này.'
            ]);
        }else{
            $category = Category::create([
                'category_name' => $request->category_name,
                'id' => $request->id
            ]);
            $parent = Parent_Category::find($request->id);
        }
        return response()->json(
            [
                'category' => $category,
                'parent' => $parent
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id )
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $categories = Category::query()->findOrFail($id );
        return response()->json([
        'message' => 'fall',
        'data' => $categories,
    ]);;
    }

    public function edit($id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $find = Category::findOrFail($id);
        $list = Category::all();
        $parent = Parent_Category::all();
        return view('admin.category.update-category', compact('find', 'list', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $check = Category::where('category_name', $request->category_name)->exists();
        if ($check){
            return response()->json([
                'success' => false,
                'message' => 'Đã có danh mục này.'
            ]);
        }else{
            $categories = Category::findOrFail($id);
            $categories->update($request->all());
            $parent = Parent_Category::find($request->id);
        }
        return response()->json(
            [
                'category' => $categories,
                'parent' => $parent
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id )
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $categories = Category::findOrFail($id );
        $categories->delete();
        return response()->json([
            'message' => 'Xoa thanh cong !',
        ]);
    }
}