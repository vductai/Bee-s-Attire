@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Add Product</h5>
        </div>
    </div>
    <form class="row" id="productForm" action="{{ route('storeProduct') }}" method="POST" enctype="multipart/form-data">
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
                                            <input type='file' id="product_main" name="main_image" class="cr-image-upload"
                                                   accept=".png, .jpg, .jpeg" required>
                                            <label><i class="ri-pencil-line"></i></label>
                                        </div>
                                        <div class="avatar-preview cr-preview">
                                            <div class="imagePreview cr-div-preview">
                                                <img class="cr-image-preview"
                                                     src="{{ asset('assets/admin/img/product/preview.jpg') }}"
                                                     alt="edit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thumb-upload-set colo-md-12">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <div class="thumb-upload">
                                                <div class="thumb-edit">
                                                    <input type='file' id="thumbUpload0{{ $i }}" name="thumb_images[]"
                                                           class="cr-image-upload" accept=".png, .jpg, .jpeg">
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
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="cr-vendor-upload-detail">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="productName" class="form-label">Product name</label>
                                        <input type="text" class="form-control slug-title" id="productName" name="product_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Select Categories</label>
                                        <select class="form-control form-select" name="category" required>
                                            <optgroup label="Fashion">
                                                <option value="t-shirt">T-shirt</option>
                                                <option value="dress">Dress</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Price</label>
                                        <input type="number" class="form-control" id="price" name="price" required min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sale price</label>
                                        <input type="number" class="form-control" id="salePrice" name="sale_price" min="0">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Desc</label>
                                        <textarea name="desc" id="editor1" cols="80" rows="70" required></textarea>
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
        let editor; 
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(createdEditor => {
                editor = createdEditor; 
            })
            .catch(error => {
                console.error(error);
            });

        document.getElementById('productForm').addEventListener('submit', function (event) {
            event.preventDefault(); 

         
            const productName = document.getElementById('productName').value.trim();
            const price = document.getElementById('price').value;
            const salePrice = document.getElementById('salePrice').value;
            const desc = editor.getData().trim(); 
            let isValid = true; 

            if (productName === '') {
                isValid = false;
                alert('Product name is required.');
            }
            if (price === '' || price < 0) {
                isValid = false;
                alert('Price must be a positive number.');
            }
            if (salePrice !== '' && salePrice < 0) {
                isValid = false;
                alert('Sale price cannot be negative.');
            }
            if (desc === '') {
                isValid = false;
                alert('Description cannot be empty.');
            }
            if (isValid) {
                this.submit(); 
            }
        });
    </script>
@endsection
