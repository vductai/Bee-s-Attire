<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('sizes.index', compact('sizes'));
    }


    public function create()
    {
        return view('sizes.create');
    }

public function store(Request $request)  
{  
    $request->validate([  
        'size_name' => 'required|string|max:255',  
    ]);  

    // Kiểm tra xem kích thước với tên giống nhau đã tồn tại hay chưa  
    $existingSize = Size::where('size_name', $request->size_name)->first();  

    if ($existingSize) {  
        // Nếu đã tồn tại, quay lại trang tạo với thông báo lỗi  
        return redirect()->back()->withErrors(['size_name' => 'Tên Size đã tồn tại.'])->withInput();  
    } 

    Size::create([  
        'size_name' => $request->size_name,  
    ]);  
    return redirect()->route('sizes.index')->with('success', 'Create Size thành công');  
}
public function edit($size_id)  
{  
    $size = Size::find($size_id);
    return view('sizes.edit', compact('size'));  
} 
    public function update(Request $request, $size_id)
    {
        $size = Size::find($size_id);
        $size->update([
            'size_name' => $request->size_name,
        ]);
        return redirect()->route('sizes.index')->with('success', 'Update Size thành công');
    }

    public function destroy($size_id)
    {
        $size = Size::find($size_id);
        $size->delete();
        return redirect()->route('sizes.index')->with('success', 'Delete Size thành công');
    }
}
