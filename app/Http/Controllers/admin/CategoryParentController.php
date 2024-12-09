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

    public function store(Request $request)
    {
        $request->validate([
            'category_main' => ['required','min:2','max:50','regex:/^[\pL\s]+$/u']
        ],
            [
                'category_main.required' => 'Vui lòng nhập',
                'category_main.min' => 'Nhập tối thiểu :min kí tự',
                'category_main.max' => 'Chỉ nhập tối đa :min kí tự',
                'category_main.regex' => 'Không được chứa kí tự và số',
            ]
        );
        $check = Parent_Category::where('name', $request->category_main)->exists();
        if ($check){
            return response()->json([
                'success' => false,
                'message' => 'Đã có danh mục này.'
            ]);
        }else{
            $create = Parent_Category::create([
                'name' => $request->category_main,
                'slug' => Str::slug($request->category_main)
            ]);
        }
        return response()->json($create);
    }

    public function edit($id)
    {
        $upd = Parent_Category::findOrFail($id);
        $list = Parent_Category::all();
        return view('admin.category.parent-category.update-category-main', compact('upd', 'list'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_main' => ['required','min:2','max:50','regex:/^[\pL\s]+$/u']
        ],
            [
                'category_main.required' => 'Vui lòng nhập',
                'category_main.min' => 'Nhập tối thiểu :min kí tự',
                'category_main.max' => 'Chỉ nhập tối đa :min kí tự',
                'category_main.regex' => 'Không được chứa kí tự và số',
            ]
        );
        $check = Parent_Category::where('name', $request->category_main)->exists();
        if ($check){
            return response()->json([
                'success' => false,
                'message' => 'Đã có danh mục này.'
            ]);
        }else{
            $upd = Parent_Category::findOrFail($id);
            $upd->update([
                'name' => $request->category_main,
                'slug' => Str::slug($request->category_main)
            ]);
        }
        return response()->json($upd);
    }

    public function destroy($id)
    {
        $del = Parent_Category::findOrFail($id);
        $del->children()->exists();
        if ($del) {
            return response()->json(['message' => 'Không thể xóa vì ràng buộc.'], 400);
        }
        $del->delete();
        return response()->json(['message' => 'done']);
    }
}
