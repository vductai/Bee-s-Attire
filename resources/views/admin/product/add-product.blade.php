@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Add Product</h5>
        </div>
    </div>
    <form class="row">
        <div class="col-md-12">
            <div class="cr-card card-default">
                <div class="cr-card-content">
                    <div class="row cr-product-uploads">
                        <div class="col-lg-4 mb-991">
                            <div class="cr-vendor-img-upload">
                                <div class="cr-vendor-main-img">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="product_main" class="cr-image-upload"
                                                   accept=".png, .jpg, .jpeg">
                                            <label><i class="ri-pencil-line"></i></label>
                                        </div>
                                        <div class="avatar-preview cr-preview">
                                            <div class="imagePreview cr-div-preview">
                                                <img class="cr-image-preview"
                                                     src="{{asset('assets/admin/img/product/preview.jpg')}}"
                                                     alt="edit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thumb-upload-set colo-md-12">
                                        <div class="thumb-upload">
                                            <div class="thumb-edit">
                                                <input type='file' id="thumbUpload01"
                                                       class="cr-image-upload"
                                                       accept=".png, .jpg, .jpeg">
                                                <label><i class="ri-pencil-line"></i></label>
                                            </div>
                                            <div class="thumb-preview cr-preview">
                                                <div class="image-thumb-preview">
                                                    <img class="image-thumb-preview cr-image-preview"
                                                         src="{{asset('assets/admin/img/product/preview-2.jpg')}}"
                                                         alt="edit">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="thumb-upload">
                                            <div class="thumb-edit">
                                                <input type='file' id="thumbUpload02"
                                                       class="cr-image-upload"
                                                       accept=".png, .jpg, .jpeg">
                                                <label><i class="ri-pencil-line"></i></label>
                                            </div>
                                            <div class="thumb-preview cr-preview">
                                                <div class="image-thumb-preview">
                                                    <img class="image-thumb-preview cr-image-preview"
                                                         src="{{asset('assets/admin/img/product/preview-2.jpg')}}"
                                                         alt="edit">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="thumb-upload">
                                            <div class="thumb-edit">
                                                <input type='file' id="thumbUpload03"
                                                       class="cr-image-upload"
                                                       accept=".png, .jpg, .jpeg">
                                                <label><i class="ri-pencil-line"></i></label>
                                            </div>
                                            <div class="thumb-preview cr-preview">
                                                <div class="image-thumb-preview">
                                                    <img class="image-thumb-preview cr-image-preview"
                                                         src="{{asset('assets/admin/img/product/preview-2.jpg')}}"
                                                         alt="edit">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="thumb-upload">
                                            <div class="thumb-edit">
                                                <input type='file' id="thumbUpload04"
                                                       class="cr-image-upload"
                                                       accept=".png, .jpg, .jpeg">
                                                <label><i class="ri-pencil-line"></i></label>
                                            </div>
                                            <div class="thumb-preview cr-preview">
                                                <div class="image-thumb-preview">
                                                    <img class="image-thumb-preview cr-image-preview"
                                                         src="{{asset('assets/admin/img/product/preview-2.jpg')}}"
                                                         alt="edit">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="thumb-upload">
                                            <div class="thumb-edit">
                                                <input type='file' id="thumbUpload05"
                                                       class="cr-image-upload"
                                                       accept=".png, .jpg, .jpeg">
                                                <label><i class="ri-pencil-line"></i></label>
                                            </div>
                                            <div class="thumb-preview cr-preview">
                                                <div class="image-thumb-preview">
                                                    <img class="image-thumb-preview cr-image-preview"
                                                         src="{{asset('assets/admin/img/product/preview-2.jpg')}}"
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
                                        <label for="inputEmail4" class="form-label">Product name</label>
                                        <input type="text" class="form-control slug-title" id="inputEmail4">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Select Categories</label>
                                        <select class="form-control form-select">
                                            <optgroup label="Fashion">
                                                <option value="t-shirt">T-shirt</option>
                                                <option value="dress">Dress</option>
                                            </optgroup>
                                            <optgroup label="Fashion">
                                                <option value="t-shirt">T-shirt</option>
                                                <option value="dress">Dress</option>
                                            </optgroup>
                                            <optgroup label="Fashion">
                                                <option value="t-shirt">T-shirt</option>
                                                <option value="dress">Dress</option>
                                            </optgroup>
                                        </select>
                                    </div>
{{--                                        <div class="col-md-4 mb-25">
                                            <label class="form-label color-label">Colors</label>
                                            <input type="color" class="form-control form-control-color"
                                                   id="exampleColorInput1" value="#ff6191"
                                                   title="Choose your color">
                                            <input type="color" class="form-control form-control-color"
                                                   id="exampleColorInput1" value="#ff6191"
                                                   title="Choose your color">
                                            <input type="color" class="form-control form-control-color"
                                                   id="exampleColorInput1" value="#ff6191"
                                                   title="Choose your color">
                                            <input type="color" class="form-control form-control-color"
                                                   id="exampleColorInput1" value="#ff6191"
                                                   title="Choose your color">
                                        </div>
                                        <div class="col-md-8 mb-25">
                                            <label class="form-label">Size</label>
                                            <div class="form-checkbox-box">
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="size1" value="size">
                                                    <label>S</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="size1" value="size">
                                                    <label>M</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="size1" value="size">
                                                    <label>L</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="size1" value="size">
                                                    <label>XL</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="size1" value="size">
                                                    <label>XXL</label>
                                                </div>
                                            </div>
                                        </div>--}}
                                        <div class="col-md-6">
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control" id="price1">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Sale price</label>
                                            <input type="number" class="form-control" id="price1">
                                        </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Desc</label>
                                        <textarea name="desc" id="editor1" cols="80" rows="70"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn cr-btn-primary">Submit</button>
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
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
