@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Update Product</h5>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="cr-card card-default">
                    <div class="cr-card-content">
                        <div class="row cr-product-uploads">
                            <div class="col-lg-4 mb-991">
                                <div class="cr-vendor-img-upload">
                                    <div class="cr-vendor-main-img">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' name="product_avatar" id="product_main"
                                                       class="cr-image-upload"
                                                       accept=".png, .jpg, .jpeg">
                                                <label><i class="ri-pencil-line"></i></label>
                                            </div>
                                            <div class="avatar-preview cr-preview">
                                                <div class="imagePreview cr-div-preview">
                                                    <img class="cr-image-preview"
                                                         src=""
                                                         alt="edit">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="thumb-upload-set colo-md-12">
                                                <div class="thumb-upload">
                                                    <div class="thumb-edit">
                                                        <input type='file' id="thumbUpload01"
                                                               class="cr-image-upload"
                                                               name="product_images[]"
                                                               accept=".png, .jpg, .jpeg">
                                                        <label><i class="ri-pencil-line"></i></label>
                                                    </div>
                                                    <div class="thumb-preview cr-preview">
                                                        <div class="image-thumb-preview">
                                                            <img class="image-thumb-preview cr-image-preview"
                                                                 src=""
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
                                            <input type="text" name="product_name" class="form-control slug-title"
                                                   id="inputEmail4">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Select Categories</label>
                                            <select name="category_id" class="form-control form-select">
                                                @foreach($category as $item)
                                                    <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="slug" class="col-12 col-form-label">Slug</label>
                                            <div class="col-12">
                                                <input name="slug" id="slug" class="form-control here set-slug"
                                                       type="hidden">
                                                <input id="slugs" class="form-control here set-slug" type="text" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Price</label>
                                            <input type="number" name="product_price" class="form-control" id="price1">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Sale price</label>
                                            <input type="number" name="sale_price" class="form-control" id="price1">
                                        </div>
                                        <div id="variant-container">
                                            {{--biến thể--}}
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-center align-content-center">
                                            <button type="button" id="add-variant-btn" class="btn cr-btn-primary">
                                                Thêm biến thể
                                            </button>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Desc</label>
                                            <textarea name="product_desc" id="editor1" cols="80" rows="70"></textarea>
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
        </div>
    @endforeach

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