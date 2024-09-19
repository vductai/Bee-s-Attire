<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    
    protected $table = 'sizes';
        // Chỉ định cột khóa chính  
        protected $primaryKey = 'size_id';  
    
        // Nếu bạn không muốn Laravel tự động thêm timestamp cho created_at và updated_at,  
        // bạn có thể tắt nó đi  
        public $timestamps = true; // Đây là mặc định, có thể bỏ qua nếu sử dụng timestamps  
    protected $fillable = [
        'size_id',
        'size_name'
    
    ];
   
}






