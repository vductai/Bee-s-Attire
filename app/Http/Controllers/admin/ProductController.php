<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index()
    {

    }

    public function store(ProductRequest $request)
    {

        // Lưu product
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_desc = $request->product_desc;
        $product->sale_price = $request->sale_price;
        $product->category_id = $request->category_id;

        // Lưu ảnh đại diện
        if ($request->hasFile('product_avatar')) {
            $file = $request->file('product_avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/upload'), $filename);
            $request->merge(['product_avatar' => $filename]);
            $product->product_avatar = $filename;
        }
        $product->save(); // Lưu product trước để lấy được product_id

        // Lưu các ảnh chi tiết vào bảng product_images
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                if ($image) {
                    // Tạo tên file duy nhất cho mỗi ảnh chi tiết
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                    // Di chuyển ảnh vào thư mục public/upload
                    $image->move(public_path('/upload'), $imageName);

                    // Lưu đường dẫn ảnh vào cơ sở dữ liệu
                    ProductImage::create([
                        'product_id' => $product->product_id,
                        'product_image' => $imageName
                    ]);
                }
            }
        }


        return response()->json([
            'message' => 'add',
            'data' => $product
        ]);
    }
}
