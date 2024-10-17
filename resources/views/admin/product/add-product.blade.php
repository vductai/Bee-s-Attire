@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Add Product</h5>
        </div>
    </div>
    <form class="row" method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
        @csrf
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
                                                       name="product_images[]"
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
                                                       name="product_images[]"
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
                                                       name="product_images[]"
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
                                                       name="product_images[]"
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
                                                       name="product_images[]"
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
                                        <input type="text" name="product_name" class="form-control slug-title"
                                               id="inputEmail4">
                                        @error('product_name')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
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
                                    <div class="col-md-12">
                                        <label class="form-label">
                                            Product Tags
                                            <span>( Type and make comma to separate tags )</span>
                                        </label>
                                        <input type="text" class="form-control" id="group_tag"
                                               name="tag_name" value="" placeholder="">
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
    </form>
    <script !src="">
        // Hàm chuyển đổi các ký tự có dấu thành không dấu
        function removeVietnameseTones(str) {
            return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Loại bỏ dấu
                .replace(/đ/g, 'd').replace(/Đ/g, 'D'); // Thay thế chữ đ/Đ thành d/D
        }

        document.getElementById('inputEmail4').addEventListener('input', function () {
            var productName = this.value;
            var slug = removeVietnameseTones(productName.toLowerCase())
                .replace(/[^a-z0-9\s-]/g, '')  // Loại bỏ ký tự đặc biệt
                .replace(/\s+/g, '-')          // Thay thế khoảng trắng bằng dấu gạch ngang
                .replace(/-+/g, '-');          // Xóa các dấu gạch ngang liên tiếp
            document.getElementById('slug').value = slug;
            document.getElementById('slugs').value = slug;
        });

        var selColor = @json($color);
        var selSize = @json($size);


        // thêm biến thể
        document.getElementById('add-variant-btn').addEventListener('click', function () {

            // Tạo một div chứa biến thể mới
            const variantDiv = document.createElement('div');

            // Tạo một ID duy nhất cho mỗi div chứa biến thể
            const variantId = `variant-${Date.now()}`;

            variantDiv.innerHTML = `
                <div id="${variantId}" class="row g-3">
                    <hr>
                    <div class="col-md-6">
                        <label class="form-label">Color</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <select name="color_id[]" id="color_id" class="form-control form-select">
                                    <option>Chọn màu sắc</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="color"  disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Size</label>
                        <select name="size_id[]" id="size_id" class="form-control form-select">
                                <option>Chọn kích thước</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity[]" class="form-control" id="price1">
                    </div>

                    <button type="button" class="remove-variant-btn cr-btn default-btn color-danger">Xóa biến thể</button>
                    <hr>
                </div>
            `;


            document.getElementById('variant-container').appendChild(variantDiv);

            // lấy ra màu
            const colorSelect = variantDiv.querySelector('select[name="color_id[]"]');
            selColor.forEach(function (color) {
                const optionColor = document.createElement('option')
                optionColor.value = color.color_id
                optionColor.text = color.color_name
                colorSelect.appendChild(optionColor)
            })

            // lấy ra size
            const sizeSelect = variantDiv.querySelector('select[name="size_id[]"]');
            selSize.forEach(function (size) {
                const optionSize = document.createElement('option')
                optionSize.value = size.size_id
                optionSize.text = size.size_name
                sizeSelect.appendChild(optionSize)
            })

            // xoá biến thể
            variantDiv.querySelector('.remove-variant-btn').addEventListener('click', function () {
                document.getElementById(variantId).remove();
            });
        });

    </script>
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
