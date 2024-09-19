<?php  

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Http\Requests\StoreSizeRequest;
use App\Models\Size;  
use Illuminate\Http\Request;  

class SizeController extends Controller  
{  

    public function index()  
    {  
        $sizes = Size::query()->latest()->paginate(10);
        return view('sizes.index', compact('sizes'));  
    }  

 
    public function create()  
    {  
        return view('sizes.create');  
    }  

 
    
    public function store(StoreSizeRequest $request)  
    {  
        // Dữ liệu đã được xác thực từ SizeRequest  
        $data = $request->validated();  
    
        // Tạo một Size mới  
        Size::query()->create($data);  
    
        // Chuyển hướng kèm thông báo thành công  
        return redirect()->route('sizes.index')->with('message', 'Create Size thành công');  
    }

 
    public function edit(Size $size)  
    {  
        return view('sizes.edit', compact('size'));  
    }  


    public function update(StoreSizeRequest $request, Size $size)  
    {  
        $data = $request->validated();  

        $size->update($data);  
        return redirect()->route('sizes.index')->with('message', 'Update Size thành công');  
    }  

    public function destroy(Size $size)  
    {  
        $size->delete();  
        return redirect()->route('sizes.index')->with('message', 'Delete Size thành công');  
    }  
}
