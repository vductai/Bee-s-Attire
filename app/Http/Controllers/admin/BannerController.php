<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;


class BannerController extends Controller
{

    public function index()
    {
        $banners = Banner::orderByDesc('id')->paginate();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
            $data['image'] = $path_image;
        } else {
            $data['image'] = '';
        }

        Banner::query()->create($data);
        return redirect()->route('banners.index')->with('message', 'Thêm banner thành công');
    }



    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }


    public function update(Request $request, Banner $banner)
    {
        $data = $request->except('image');
        $old_image = $banner->image;

        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images', 'public');
            $data['image'] = $path_image;

            $image_path = storage_path('app/public/' . $old_image);
            if (is_file($image_path) && file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $banner->update($data);
        return redirect()->route('banners.index')->with('message', 'Cập nhật banner thành công');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image != null) {
            if (file_exists('storage/' . $banner->image)) {
                unlink('storage/' . $banner->image);
            }
        }
        $banner->delete();
        return redirect()->route('banners.index')->with('message', 'Xóa banner thành công');
    }
}
