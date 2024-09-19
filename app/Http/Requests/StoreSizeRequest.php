<?php  

namespace App\Http\Requests;  

use Illuminate\Foundation\Http\FormRequest;  

class StoreSizeRequest extends FormRequest  
{  
    /**  
     * Xác định xem người dùng có quyền thực hiện yêu cầu này hay không.  
     *  
     * @return bool  
     */  
    public function authorize(): bool  
    {  
        return true; // Bạn có thể thêm logic xác thực ở đây nếu cần  
    }  

    /**  
     * Lấy các quy tắc xác thực cho yêu cầu.  
     *  
     * @return array  
     */  
    public function rules(): array  
    {  
        return [  
            'size_name' => 'required|string|max:225', // Quy tắc xác thực cho size_name  
        ];  
    }  

    /**  
     * Thông báo lỗi tùy chỉnh (nếu cần).  
     *  
     * @return array  
     */  
    public function messages(): array  
    {  
        return [  
            'size_name.required' => 'Tên kích thước là bắt buộc.',  
            'size_name.string' => 'Tên kích thước phải là một chuỗi.',  
            'size_name.max' => 'Tên kích thước không được vượt quá 225 ký tự.',  
        ];  
    }  
}