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
                    <form class="row cr-product-uploads" id="productForm" action="{{ route('updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="col-lg-4 mb-991">
                            <div class="cr-vendor-img-upload">
                                <div class="cr-vendor-main-img">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="product_main" name="main_image" class="cr-image-upload" accept=".png, .jpg, .jpeg">
                                            <label><i class="ri-pencil-line"></i></label>
                                        </div>
                                        <div class="avatar-preview cr-preview">
                                            <div class="imagePreview cr-div-preview">
                                                <img class="cr-image-preview" src="{{ $product->main_image ? asset($product->main_image) : asset('assets/admin/img/product/preview.jpg') }}" alt="edit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thumb-upload-set colo-md-12">
                                        @foreach ($product->thumb_images as $key => $thumb)
                                            <div class="thumb-upload">
                                                <div class="thumb-edit">
                                                    <input type='file' id="thumbUpload0{{ $key + 1 }}" name="thumb_images[]" class="cr-image-upload" accept=".png, .jpg, .jpeg">
                                                    <label><i class="ri-pencil-line"></i></label>
                                                </div>
                                                <div class="thumb-preview cr-preview">
                                                    <div class="image-thumb-preview">
                                                        <img class="image-thumb-preview cr-image-preview" src="{{ asset($thumb) }}" alt="edit">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="cr-vendor-upload-detail">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="productName" class="form-label">Product name</label>
                                        <input type="text" class="form-control slug-title" id="productName" name="product_name" value="{{ old('product_name', $product->name) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Select Categories</label>
                                        <select class="form-control form-select" name="category" required>
                                            <optgroup label="Fashion">
                                                <option value="t-shirt" {{ $product->category === 't-shirt' ? 'selected' : '' }}>T-shirt</option>
                                                <option value="dress" {{ $product->category === 'dress' ? 'selected' : '' }}>Dress</option>
                                            </optgroup>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="slug" class="col-12 col-form-label">Slug</label>
                                        <div class="col-12">
                                            <input id="slug" name="slug" class="form-control here set-slug" type="text" value="{{ old('slug', $product->slug) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Sort Description</label>
                                        <textarea class="form-control" rows="2" name="short_description">{{ old('short_description', $product->short_description) }}</textarea>
                                    </div>
                                    <div class="col-md-4 mb-25">
                                        <label class="form-label color-label">Colors</label>
                                        <input type="color" class="form-control form-control-color" name="color[]" value="#ff6191" title="Choose your color">
                                        <input type="color" class="form-control form-control-color" name="color[]" value="#33317d" title="Choose your color">
                                        <input type="color" class="form-control form-control-color" name="color[]" value="#56d4b7" title="Choose your color">
                                        <input type="color" class="form-control form-control-color" name="color[]" value="#009688" title="Choose your color">
                                    </div>
                                    <div class="col-md-8 mb-25">
                                        <label class="form-label">Size</label>
                                        <div class="form-checkbox-box">
                                            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="sizes[]" value="{{ $size }}" {{ in_array($size, $product->sizes) ? 'checked' : '' }}>
                                                    <label>{{ $size }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Price <span>( In USD )</span></label>
                                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required min="0">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Full Detail</label>
                                        <textarea class="form-control" rows="4" name="full_detail">{{ old('full_detail', $product->full_detail) }}</textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Product Tags <span>( Type and make comma to separate tags )</span></label>
                                        <input type="text" class="form-control" id="group_tag" name="group_tag" value="{{ old('group_tag', implode(',', $product->tags)) }}" placeholder="" data-role="tagsinput">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn cr-btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('productForm').addEventListener('submit', function (event) {
            event.preventDefault(); 

            const productName = document.getElementById('productName').value.trim();
            const price = document.getElementById('price').value;
            const quantity = document.getElementById('quantity').value;
            const shortDescription = document.querySelector('textarea[name="short_description"]').value.trim();
            const fullDetail = document.querySelector('textarea[name="full_detail"]').value.trim();

            let isValid = true; 
            if (productName === '') {
                isValid = false;
                alert('Product name is required.');
            }
            if (price === '' || price < 0) {
                isValid = false;
                alert('Price must be a positive number.');
            }
            if (quantity === '' || quantity < 0) {
                isValid = false;
                alert('Quantity must be a positive number.');
            }
            if (shortDescription === '') {
                isValid = false;
                alert('Short description cannot be empty.');
            }
            if (fullDetail === '') {
                isValid = false;
                alert('Full detail cannot be empty.');
            }

            if (isValid) {
                this.submit(); 
            }
        });
    </script>
@endsection
