<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;
use App\Policies\CategoryPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CategoryAPIController extends Controller
{

    public function index()
    {
        try {
            $this->authorize('viewAny', CategoryPolicy::class);
        } catch (AuthorizationException $e) {
        }


        $categoreis = Category::all();

        return response()->json([
            'message' => 'list',
            'data' => $categoreis
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $param = $request->all();

        $category = Category::create($param);

        return response()->json([
            'message' => 'Them moi thanh cong !',
            'data' => $category,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id )
    {
        $categories = Category::query()->findOrFail($id );

        return response()->json([
        'message' => 'fall',
        'data' => $categories,
    ]);;
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
        ]);
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