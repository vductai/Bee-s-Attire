<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $list = Product::all();
        return response()->json([
            'message' => 'list all',
            'data' => $list
        ]);
    }



    public function show($id){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $show = Product::where('product_id', $id)->get();
        return response()->json([
            'message' => 'show',
            'data' => $show
        ]);
    }

    public function store(ProductRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_desc = $request->product_desc;
        $product->sale_price = $request->sale_price;
        $product->category_id = $request->category_id;

        if ($request->hasFile('product_avatar')) {
            $file = $request->file('product_avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/upload'), $filename);
            $request->merge(['product_avatar' => $filename]);
            $product->product_avatar = $filename;
        } else {
            $defaultAvatarPath = public_path('error-image-default.jpg');
            $filename = time() . '-default-avatar.jpg';
            $destinationPath = public_path('/upload/' . $filename);

            if (File::exists($defaultAvatarPath)) {
                File::copy($defaultAvatarPath, $destinationPath);
            }
            $product->product_avatar = $filename;
        }
        $product->save(); // Lưu product trước để lấy được product_id
        // Lưu các ảnh chi tiết vào bảng product_images
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                if ($image) {
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/upload'), $imageName);
                    ProductImage::create([
                        'product_id' => $product->product_id,
                        'product_image' => $imageName
                    ]);
                }
            }
        } else {
            $defaultImagePath = public_path('error-image-default.jpg');
            for ($i = 0; $i < 5; $i++) {
                $imageName = time() . '-' . uniqid() . '-default-avatar.jpg';
                $destinationImagePath = public_path('upload/' . $imageName);

                if (File::exists($defaultImagePath)) {
                    File::copy($defaultImagePath, $destinationImagePath);
                }
                ProductImage::create([
                    'product_id' => $product->product_id,
                    'product_image' => $imageName
                ]);
            }
        }
        return response()->json([
            'message' => 'add',
            'data' => $product
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $product = Product::find($id);
        if ($request->hasFile('product_avatar')) {
            if (File::exists(public_path('upload/' . $product->product_avatar))) {
                File::delete(public_path('upload/' . $product->product_avatar));
            }
            $file = $request->file('product_avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/upload'), $filename);
            $request->merge(['product_avatar' => $filename]);
            $product->product_avatar = $filename;
        } else {
            $filename = $product->product_avatar;
        }
        $update = Product::where('product_id', $id)->update([
            'product_name' => $request->product_name,
            'product_avatar' => $filename,
            'product_price' => $request->product_price,
            'product_desc' => $request->product_desc,
            'sale_price' => $request->sale_price,
            'category_id' => $request->category_id
        ]);

        // Lưu các ảnh chi tiết vào bảng product_images
        if ($request->hasFile('product_images')) {
            // Xóa tất cả các hình ảnh cũ trước khi thêm hình mới
            $proImage = ProductImage::where('product_id', $product->product_id)->get();
            foreach ($proImage as $item) {
                if (File::exists(public_path('upload/' . $item->product_image))) {
                    File::delete(public_path('upload/' . $item->product_image));
                }
                $item->delete(); // Xóa bản ghi khỏi cơ sở dữ liệu
            }

            // Thêm các hình ảnh mới
            foreach ($request->file('product_images') as $image) {
                if ($image) {
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/upload'), $imageName);
                    ProductImage::create([
                        'product_id' => $product->product_id,
                        'product_image' => $imageName
                    ]);
                }
            }
        } else {
            // Xóa tất cả các hình ảnh cũ
            $proImage = ProductImage::where('product_id', $product->product_id)->get();
            foreach ($proImage as $item) {
                if (File::exists(public_path('upload/' . $item->product_image))) {
                    File::delete(public_path('upload/' . $item->product_image));
                }
                $item->delete();
            }


            $defaultImagePath = public_path('error-image-default.jpg');
            $imageName = time() . '-' . uniqid() . '-default-avatar.jpg';
            $destinationImagePath = public_path('upload/' . $imageName);

            if (File::exists($defaultImagePath)) {
                File::copy($defaultImagePath, $destinationImagePath);
            }

            ProductImage::create([
                'product_id' => $product->product_id,
                'product_image' => $imageName
            ]);
        }

        return response()->json([
            'message' => 'update',
            'data' => $update
        ]);
    }


    public function destroy($id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $product = Product::find($id);
        if ($product) {
            if (File::exists(public_path('upload/' . $product->product_avatar))) {
                File::delete(public_path('upload/' . $product->product_avatar));
            }

            foreach ($product->product_image as $item) {
                if (File::exists(public_path('upload/' . $item->product_image))) {
                    File::delete(public_path('upload/' . $item->product_image));
                }
            }
            $product->product_image()->delete();
            $product->variants()->delete();
            $product->delete();
        }
        return response()->json([
            'message' => 'delete',
            'data' => $product
        ]);
    }
}
