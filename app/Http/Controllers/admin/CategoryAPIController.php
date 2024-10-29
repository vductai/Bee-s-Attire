<?php

namespace App\Http\Controllers\admin;

use App\Events\CategoryEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;
use App\Policies\CategoryPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.category.add-category', compact('list'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $category = Category::create($request->all());
        return response()->json($category);
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
        $find = Category::findOrFail($id);
        $list = Category::all();
        return view('admin.category.update-category', compact('find', 'list'));
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
        $categories = Category::findOrFail($id);
        $categories->update($request->all());
        return response()->json($categories);
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
        $categories = Category::query()->findOrFail($id );
        $categories->delete();
        return response()->json([
            'message' => 'Xoa thanh cong !',
        ]);
    }
}
