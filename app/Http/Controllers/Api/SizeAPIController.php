<?php  

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSizeRequest;  
use App\Models\Size;  
use Illuminate\Http\JsonResponse;  
use Illuminate\Http\Response;  

class SizeAPIController extends Controller  
{  
    // Lấy danh sách tất cả kích thước  
    public function index()
    {  
        $sizes = Size::query()->latest('size_id')->paginate(5);  
        return response()->json($sizes);  
    }  

    // Tạo mới một size
    public function store(StoreSizeRequest $request)
    {  
        $size = Size::create($request->validated());  
        return response()->json($size);  
    }  

    // Lấy thông tin một size theo ID  
    public function show($size_id)
    {  
        $size = Size::find($size_id);  
        
        if (!$size) {  
            return response()->json(['message' => 'Không tìm thấy Size.'], Response::HTTP_NOT_FOUND);  
        }  

        return response()->json($size);  
    }  

    // Cập nhật thông tin một size theo ID  
    public function update(StoreSizeRequest $request, Size $size) 
    {  
        
        $data = $request->validated();  

        $size->update($data);   
        return response()->json($size);  
    }  

    // Xóa một size theo ID  
    public function destroy($id)
    {  
        $size = Size::find($id);  
        
        if (!$size) {  
            return response()->json(['message' => 'Không tìm thấy Size.']);  
        }  

        $size->delete();  
        return response()->json(['message' => 'Size deleted successfully.']);  
    }  
}