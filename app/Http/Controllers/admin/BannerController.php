<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Models\BannerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Intervention\Image\Laravel\Facades\Image;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::with('imageBanners')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

public function store(Request $request)
{
    try {
        $this->authorize('manageAdmin', Auth::user());
    } catch (AuthorizationException $e) {
    }

    $Path = public_path('/upload/uploads');

    $banner = new Banner();
    $banner->banner_subtitle = $request->banner_subtitle;
    $banner->banner_title = $request->banner_title;
    $banner->banner_description = $request->banner_description;

    if ($request->hasFile('banner_image')) {
        $file = $request->file('banner_image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $image = Image::read($file);
        $image->resize(1920, 900)->save($Path . '/' . $filename);
        $banner->banner_image = $filename;
    } else {
        $defaultImagePath = public_path('error-banner-image.jpg');
        $filename = time() . '-default-banner.jpg';
        $destinationPath = $Path . '/' . $filename;

        if (File::exists($defaultImagePath)) {
            File::copy($defaultImagePath, $destinationPath);
        }

        $banner->banner_image = $filename;
    }
    $banner->save();

    if ($request->hasFile('image_banners')) {
        foreach ($request->file('image_banners') as $image) {
            if ($image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('/upload/uploads');
                $imageDetail = Image::read($image);
                $imageDetail->resize(1920, 900)->save($imagePath . '/' . $imageName);

                BannerImage::create([
                    'banner_id' => $banner->banner_id,
                    'image_path' => $imageName,
                ]);
            }
        }
    }

    return redirect()->route('banners.index')->with('message', 'Create banner thành công');
}


    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        
        $data = $request->except('banner_image');
        $old_image = $banner->banner_image;
    
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $image->resize(1920, 900)->save(public_path('/upload/uploads/' . $filename));
            $data['banner_image'] = $filename;
    
            if ($old_image && file_exists(public_path('/upload/uploads/' . $old_image))) {
                unlink(public_path('/upload/uploads/' . $old_image));
            }
        } else {
            $data['banner_image'] = $old_image;
        }
    
        $banner->update($data);
    
        if ($request->hasFile('image_banners')) {
            foreach ($request->file('image_banners') as $index => $image) {
                if ($image) {
                    if (isset($banner->imageBanners[$index])) {
                        $ImageBanner = $banner->imageBanners[$index];
                        if (file_exists(public_path('/upload/uploads/' . $ImageBanner->image_path))) {
                            unlink(public_path('/upload/uploads/' . $ImageBanner->image_path));
                        }
                        $ImageBanner->delete();
                    }
    
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $imagePath = public_path('/upload/uploads');
                    $imageDetail = Image::read($image);
                    $imageDetail->resize(1920, 900)->save($imagePath . '/' . $imageName);
    
                    BannerImage::create([
                        'banner_id' => $banner->banner_id,
                        'image_path' => $imageName,
                    ]);
                }
            }
        }
    
        return redirect()->route('banners.index')->with('message', 'Cập nhật banner thành công');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->banner_image) {
            $bannerImagePath = public_path('upload/uploads/' . $banner->banner_image);
            if (file_exists($bannerImagePath)) {
                unlink($bannerImagePath);
            }
        }
        foreach ($banner->imageBanners as $imageBanner) {
            if (file_exists(public_path('upload/uploads/' . $imageBanner->image_path))) {
                unlink(public_path('upload/uploads/' . $imageBanner->image_path));
            }
            $imageBanner->delete(); 
        }
        $banner->delete();
    
        return redirect()->route('banners.index')->with('message', 'Xóa banner thành công');
    }
    
}
