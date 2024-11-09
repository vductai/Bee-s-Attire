<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Parent_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryParentController extends Controller
{
    public function create()
    {
        $list = Parent_Category::all();
        return view('admin.category.parent-category.add-category-main', compact('list'));
    }
    public function store(Request $request){
        $request->validate([
           'category_main' => 'required'
        ],
        ['category_main.required' => 'Vui lòng nhập']);
        $create = Parent_Category::create([
            'name' => $request->category_main,
            'slug' => Str::slug($request->category_main)
        ]);
        return response()->json($create);
    }

    public function edit($id){
        $upd = Parent_Category::findOrFail($id);
        $list = Parent_Category::all();
        return view('admin.category.parent-category.update-category-main', compact('upd', 'list'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'category_main' => 'required'
        ], ['category_main.required' => 'Vui lòng nhập']);

        $upd = Parent_Category::findOrFail($id);
        $upd->update([
            'name' => $request->category_main,
            'slug' => Str::slug($request->category_main)
        ]);
        return response()->json($upd);
    }

    public function destroy($id){
        $del = Parent_Category::findOrFail($id);
        $del->delete();
        return response()->json(['message' => 'done']);
    }
}
