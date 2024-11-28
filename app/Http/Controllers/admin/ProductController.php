<?php

namespace App\Http\Controllers\admin;

use App\Events\ProductUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Featured_categories;
use App\Models\Parent_Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Laravel\Facades\Image;


class ProductController extends Controller
{

    public function index()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $list = Product::orderBy('created_at', 'desc')->get();
        return view('admin.product.list-product', compact('list'));
    }


    public function edit($id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $show = Product::findOrFail($id);
        $category = Parent_Category::all();
        $color = Color::all();
        $size = Size::all();
        $featured_categories = Featured_categories::all();
        return view('admin.product.edit-product', compact(
            'show',
            'category',
            'color',
            'size',
            'featured_categories'
        ));
    }

    public function create()
    {
        $category = Parent_Category::all();
        $color = Color::all();
        $size = Size::all();
        $featured_categories = Featured_categories::all();
        return view('admin.product.add-product', compact('category', 'color', 'size', 'featured_categories'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_desc = $request->product_desc;
        $product->product_price = $request->product_price;
        $product->sale_price = $request->sale_price;
        $product->category_id = $request->category_id;
        $product->slug = $request->slug;
        if ($request->hasFile('product_avatar')) {
            $file = $request->file('product_avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('/upload');
            // Resize và lưu ảnh avatar
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
            $image = Image::read($file);
            $image->resize(600, 600)->save($path . '/' . $filename);
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
        // add tag
        if (!empty($request->tag_name)) {
            // tách chuổi = dấu , và loại bỏ khoảng trắng
            $tagArr = array_map('trim', explode(',', $request->tag_name));
            $tagId = [];
            foreach ($tagArr as $item) {
                $tag = Tag::firstOrCreate([
                    'tag_name' => $item
                ]);
                // thêm tag_id vào mảng
                $tagId[] = $tag->tag_id;
            }
            // lieen keets tag với các snar phẩm
            $product->tags()->sync($tagId);
        }
        // add featuredCategories
        if ($request->has('featuredCategories')) {
            $featuredId = $request->featuredCategories;
            $product->featuredCategories()->sync($featuredId);
        }
        if ($request->has('color_id') && $request->has('size_id')) {
            foreach ($request->color_id as $index => $color_id) {
                $size_id = $request->size_id[$index];
                if ($color_id && $size_id) {
                    $varisant = ProductVariant::create([
                        'product_id' => $product->product_id,
                        'size_id' => $size_id,
                        'color_id' => $color_id,
                        'quantity' => $request->quantity[$index] ?? 0
                    ]);
                }
            }
        }
        // Lưu các ảnh chi tiết vào bảng product_images
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                if ($image) {
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $imagePath = public_path('/upload');
                    $imageDetail = Image::read($image);
                    $imageDetail->resize(600, 600)->save($imagePath . '/' . $imageName);
                    $image = ProductImage::create([
                        'product_id' => $product->product_id,
                        'product_image' => $imageName
                    ]);
                }
            }
        }
        return response()->json([
            'product' => $product,
            'variant' => $varisant,
            'image' => $image,
            'tag' => $tag
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
    
        $product = Product::findOrFail($id);
    
        if ($request->hasFile('product_avatar')) {
            // Xóa ảnh đại diện cũ nếu tồn tại
            $oldAvatarPath = public_path('upload/' . $product->product_avatar);
            if (File::exists($oldAvatarPath)) {
                File::delete($oldAvatarPath);
            }
    
            // Lưu ảnh đại diện mới
            $file = $request->file('product_avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $product->product_avatar = $filename;
        }
    
        // Cập nhật thông tin sản phẩm
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_desc = $request->input('product_desc');
        $product->sale_price = $request->input('sale_price');
        $product->category_id = $request->input('category_id');
    
        $product->save();
    
        // Xử lý ảnh chi tiết
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $key => $image) {
                $oldImage = ProductImage::where('product_id', $product->product_id)
                    ->skip($key)
                    ->first();
    
                if ($oldImage) {
                    // Xóa ảnh cũ khỏi thư mục nếu tồn tại
                    $oldImagePath = public_path('upload/' . $oldImage->product_image);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
    
                    // Cập nhật ảnh mới
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('upload'), $imageName);
    
                    // Cập nhật thông tin ảnh trong DB
                    $oldImage->product_image = $imageName;
                    $oldImage->save();
                } else {
                    // Thêm ảnh mới nếu không tồn tại ảnh cũ
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('upload'), $imageName);
    
                    ProductImage::create([
                        'product_id' => $product->product_id,
                        'product_image' => $imageName
                    ]);
                }
            }
        }
    
        // Trả về trang chỉnh sửa sản phẩm
        $show = $product;
        $category = Parent_Category::all();
        return view('admin.product.edit-product', compact('show', 'category'));
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
            $product->tags()->detach();
            $product->delete();
        }
        return response()->json(['message' => 'delete',]);
    }
}
