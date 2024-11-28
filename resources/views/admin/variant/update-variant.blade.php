@extends('layout.admin.home')
@include('toast.admin-toast')

@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Cập nhật Biến Thể</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="cr-card card-default product-list">
                <div class="cr-card-content">
                    <form id="formUpdateVariant" method="POST" action="{{ route('product-variant.update', $variant->product_variant_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="product_id">Sản phẩm</label>
                            <select name="product_id" id="product_id" class="form-control">
                                @foreach($list as $prod)
                                    <option value="{{ $prod->id }}" {{ $prod->id == $variant->product_id ? 'selected' : '' }}>
                                        {{ $prod->product_name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="product_id_error" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label for="color_code">Màu</label>
                            <input type="color" class="form-control" id="color_code" name="color_code" value="{{ $variant->color->color_code }}">
                            <span id="color_code_error" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label for="size_name">Kích thước</label>
                            <input type="text" class="form-control" id="size_name" name="size_name" value="{{ $variant->size->size_name }}">
                            <span id="size_name_error" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $variant->quantity }}">
                            <span id="quantity_error" class="text-danger"></span>
                        </div>

                        <button type="submit" class="btn btn-success">Cập nhật Biến Thể</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const formUpdateVariant = document.getElementById('formUpdateVariant');

        if (formUpdateVariant) {
            formUpdateVariant.addEventListener('submit', function (e) {
                e.preventDefault(); 

                document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

                const variantId = "{{ $variant->product_variant_id }}";

                const productId = document.getElementById('product_id').value;
                const colorCode = document.getElementById('color_code').value;
                const sizeName = document.getElementById('size_name').value;
                const quantity = document.getElementById('quantity').value;

   
                const updateVariant = new FormData();
                updateVariant.append('product_id', productId);
                updateVariant.append('color_code', colorCode);
                updateVariant.append('size_name', sizeName);
                updateVariant.append('quantity', quantity);
                updateVariant.append('_method', 'PUT');

                // Gửi request qua Axios
                axios.post(`/admin/product-variant/${variantId}`, updateVariant, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {

                    alert('Cập nhật biến thể thành công!');
       
                    window.location.href = '/admin/product-variant';
                })
                .catch(error => {
                    // Xử lý lỗi
                    if (error.response && error.response.data.errors) {
                        const errors = error.response.data.errors;
                        for (const field in errors) {
                            const errorField = document.getElementById(`${field}_error`);
                            if (errorField) {
                                errorField.textContent = errors[field][0]; 
                            }
                        }
                    } else {
              
                        alert('Đã xảy ra lỗi trong quá trình cập nhật. Vui lòng thử lại.');
                    }
                });
            });
        }
    });
</script>
@endsection
