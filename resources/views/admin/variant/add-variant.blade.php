@extends('layout.admin.home')
@include('toast.admin-toast')

@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Thêm Biến Thể</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="cr-card card-default product-list">
                <div class="cr-card-content">
                       <!-- Form tạo mới sản phẩm -->
        <div class="col-md-12 mt-4">
            <div class="cr-card card-default">
                <div class="cr-card-content">
                    <form id="formVariant" action="{{ route('product-variant.store') }}">
      
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Tên sản phẩm</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="color_code" class="form-label">Mã màu</label>
                            <input type="color" name="color_code" id="color_code" class="form-control" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="size_name" class="form-label">Tên kích thước</label>
                            <input type="text" name="size_name" id="size_name" class="form-control" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Tạo biến thể</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
         document.getElementById('formVariant').addEventListener('submit', function(e) {
        e.preventDefault(); // Ngừng submit form mặc định

        let productName = document.getElementById('product_name').value;
        let colorCode = document.getElementById('color_code').value;
        let sizeName = document.getElementById('size_name').value;
        let quantity = document.getElementById('quantity').value;

        let formData = new FormData();
        formData.append('product_name', productName);
        formData.append('color_code', colorCode);
        formData.append('size_name', sizeName);
        formData.append('quantity', quantity);

        axios.post('/admin/product-variant', formData)
            .then(response => {
       
                window.location.href = '/admin/product-variant';
            })
            .catch(error => {
                alert('Có lỗi xảy ra');
                console.error(error);
            });
    });
    </script>
@endsection
