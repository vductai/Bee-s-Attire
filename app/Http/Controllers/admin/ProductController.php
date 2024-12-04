<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Jobs\CreateProductJob;
use App\Models\Category;
use App\Models\Color;
use App\Models\Featured_categories;
use App\Models\Parent_Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\Tag;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return view('admin.product.edit-product', compact('show',
            'category', 'color', 'size', 'featured_categories'));
    }

    public function create()
    {
        $category = Parent_Category::all();
        $color = Color::all();
        $size = Size::all();
        $featured_categories = Featured_categories::all();
        return view('admin.product.add-product', compact('category',
            'color', 'size', 'featured_categories'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        if ($request->sale_price > $request->product_price) {
            return response()->json([
                'success' => false,
                'messages' => 'Giá khuyến mãi không được cao hơn giá gốc'
            ]);
        }
        DB::transaction(function () use ($request) {
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
                //$product->product_avatar = $filename;
            } else {
                $defaultAvatarPath = public_path('error-image-default.jpg');
                $filename = time() . '-default-avatar.jpg';
                $destinationPath = public_path('/upload/' . $filename);
                if (File::exists($defaultAvatarPath)) {
                    File::copy($defaultAvatarPath, $destinationPath);
                }
                //$product->product_avatar = $filename;
            }
            $product = Product::create([
                'product_name' => $request->product_name,
                'product_desc' => $request->product_desc,
                'product_price' => $request->product_price,
                'sale_price' => $request->sale_price,
                'category_id' => $request->category_id,
                'slug' => $request->slug,
                'product_avatar' => $filename
            ]);
            //$product->save();
            // add tag
            $tagNames = $request->tag_name ? explode(',', $request->tag_name) : [];
            $featuredCategories = $request->featuredCategories ?? [];
            /*$tagArr = array_map('trim', explode(',', $request->tag_name));
            // Lấy các tag đã tồn tại
            $existingTags = Tag::whereIn('tag_name', $tagArr)->pluck('tag_id', 'tag_name')->toArray();
            // Lấy các tag chưa tồn tại
            $newTags = array_diff($tagArr, array_keys($existingTags));
            // Thêm các tag mới vào cơ sở dữ liệu
            if (!empty($newTags)) {
                Tag::insert(array_map(fn($name) => ['tag_name' => $name], $newTags));
                $newTagsIds = Tag::whereIn('tag_name', $newTags)->pluck('tag_id', 'tag_name')->toArray();
                $existingTags = array_merge($existingTags, $newTagsIds);
            }
            // Gán tag cho sản phẩm
            $product->tags()->sync(array_values($existingTags));
            // add featuredCategories
            if ($request->has('featuredCategories')) {
                $featuredId = $request->featuredCategories;
                $product->featuredCategories()->sync($featuredId);
            }*/
            // Chuẩn bị biến thể
            $variants = [];
            if ($request->has('color_id') && $request->has('size_id')) {
                foreach ($request->color_id as $index => $color_id) {
                    $size_id = $request->size_id[$index];
                    if ($color_id && $size_id) {
                        $variants[] = [
                            'size_id' => $size_id,
                            'color_id' => $color_id,
                            'quantity' => $request->quantity[$index] ?? 0
                        ];
                    }
                }
            }
            CreateProductJob::dispatch($product, $tagNames, $featuredCategories, $variants);
            // Lưu các ảnh chi tiết vào bảng product_images
            if ($request->hasFile('product_images')) {
                $images = [];
                foreach ($request->file('product_images') as $image) {
                    if ($image) {
                        $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $imagePath = public_path('/upload');
                        Image::read($image)->resize(600, 600)->save($imagePath . '/' . $imageName);

                        $images[] = [
                            'product_id' => $product->product_id,
                            'product_image' => $imageName
                        ];
                    }
                }
                ProductImage::insert($images);
            }
            return response()->json(['message' => 'done']);
            throw new \Exception('error');
        });
    }


    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        if ($request->sale_price > $request->product_price) {
            return response()->json([
                'success' => false,
                'messages' => 'Giá khuyến mãi không được cao hơn giá gốc'
            ]);
        }
        DB::transaction(function () use ($request, $id) {
            $product = Product::findOrFail($id);
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
            $product->update([
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
            }
            return response()->json($product);
        });
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
