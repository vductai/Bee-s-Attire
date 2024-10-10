@extends('layout.admin.home')

@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Add Banner</h5>
        </div>
    </div>

    <form class="row" method="post" action="{{ route('banners.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <div class="cr-card card-default">
                <div class="cr-card-content">
                    <div class="row cr-product-uploads">
                        <div class="col-lg-4 mb-991">
                            <div class="cr-vendor-img-upload">
                                <div class="cr-vendor-main-img">

                                    {{-- <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' name="banner_image" id="product_main"
                                                class="cr-image-upload" accept=".png, .jpg">
                                            <label><i class="ri-pencil-line"></i></label>
                                        </div>
                                        <div class="avatar-preview cr-preview">
                                            <div class="imagePreview cr-div-preview">
                                                <img class="cr-image-preview"
                                                    src="{{ asset('assets/admin/img/product/preview.jpg') }}"
                                                    alt="edit">
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="thumb-upload-set colo-md-12">
                                        <div class="thumb-upload">
                                            <div class="thumb-edit">
                                                <input type='file' id="thumbUpload01" class="cr-image-upload"
                                                    name="image_banners[]" accept=".png, .jpg">
                                                <label><i class="ri-pencil-line"></i></label>
                                            </div>
                                            <div class="thumb-preview cr-preview">
                                                <div class="image-thumb-preview">
                                                    <img class="image-thumb-preview cr-image-preview"
                                                        src="{{ asset('assets/admin/img/product/preview-2.jpg') }}"
                                                        alt="edit">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="thumb-upload">
                                            <div class="thumb-edit">
                                                <input type='file' id="thumbUpload01" class="cr-image-upload"
                                                    name="image_banners[]" accept=".png, .jpg, .jpeg">
                                                <label><i class="ri-pencil-line"></i></label>
                                            </div>
                                            <div class="thumb-preview cr-preview">
                                                <div class="image-thumb-preview">
                                                    <img class="image-thumb-preview cr-image-preview"
                                                        src="{{ asset('assets/admin/img/product/preview-2.jpg') }}"
                                                        alt="edit">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="thumb-upload">
                                            <div class="thumb-edit">
                                                <input type='file' id="thumbUpload01" class="cr-image-upload"
                                                    name="image_banners[]" accept=".png, .jpg, .jpeg">
                                                <label><i class="ri-pencil-line"></i></label>
                                            </div>
                                            <div class="thumb-preview cr-preview">
                                                <div class="image-thumb-preview">
                                                    <img class="image-thumb-preview cr-image-preview"
                                                        src="{{ asset('assets/admin/img/product/preview-2.jpg') }}"
                                                        alt="edit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="cr-vendor-upload-detail">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="banner_title" class="form-label">Title</label>
                                        <input type="text" name="banner_title" class="form-control" id="banner_title">
                                        @error('banner_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="banner_subtitle" class="form-label">Subtitle</label>
                                        <input type="text" name="banner_subtitle" class="form-control"
                                            id="banner_subtitle">
                                        @error('banner_subtitle')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="banner_description" class="form-label">Description</label>
                                        <textarea class="form-control" id="banner_description" name="banner_description"></textarea>
                                        @error('banner_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center align-content-center">
                                        <button type="submit" class="btn cr-btn-primary">Create Banner</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
