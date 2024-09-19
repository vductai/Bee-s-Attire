<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoreis = Category::query()->get();

        return CategoryResource::collection($categoreis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $param = $request->all();

        $category = Category::create($param);

        return response()->json([
            'data' => new CategoryResource(resource: $category),

            'message' => 'Them moi thanh cong !',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id )
    {
        $categories = Category::query()->findOrFail($id );
        
        return new CategoryResource($categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categories = Category::query()->findOrFail($id);

        $param = $request->all();

        $categories->update($param);

        return response()->json([
            'data' => new CategoryResource($categories),
            'message' => 'Sua thanh cong !',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id )
    {
        $categories = Category::query()->findOrFail($id );

        $categories->delete();

        return response()->json([
            
            'message' => 'Xoa thanh cong !',
        ]);
    }
}
