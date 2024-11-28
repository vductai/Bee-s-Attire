@extends('layout.admin.home')
@include('toast.admin-toast')

@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Danh sách biến thể</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="cr-card card-default product-list">
                <div class="cr-card-content ">
                    <div class="table-responsive">
                        <table id="product_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Màu</th>
                                    <th>Kích thước</th>
                                    <th>Số lượng</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->product ? $item->product->product_name : 'Không có tên sản phẩm' }}</td>
                                    <td>
                                        <input id="text" name="color_code" class="form-control here slug-title" type="color" 
                                            value="{{ $item->color ? $item->color->color_code : '#000000' }}" disabled>
                                    </td>
                                    <td>{{ $item->size ? $item->size->size_name : 'Không có kích thước' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">  
                                            <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"  
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">  
                                                <span class="sr-only"><i class="ri-settings-3-line"></i></span>  
                                            </button>  
                                            <div class="dropdown-menu">  
                                                <a class="dropdown-item" href="{{ route('product-variant.create') }}">Tạo Biến Thể</a>  <!-- Link to create page -->  
                                                <a class="dropdown-item" href="#">Chỉnh sửa</a>  
                                                <a class="dropdown-item" href="#">Xoá</a>  
                                            </div>  
                                        </div>  
                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form tạo mới sản phẩm -->
        <div class="col-md-12 mt-4">
            <div class="cr-card card-default">
                <div class="cr-card-content">
                    <form id="formVariant">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Tên sản phẩm</label>
                            <input type="text" name="product_name" id="product_name" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                            <label for="color_code" class="form-label">Mã màu</label>
                            <input type="color" name="color_code" id="color_code" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                            <label for="size_name" class="form-label">Tên kích thước</label>
                            <input type="text" name="size_name" id="size_name" class="form-control">
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
@endsection

@section('script')
    <script>
        const formVariant = document.getElementById('formVariant');

        if (formVariant) {
            formVariant.addEventListener('submit', function(e) {
                e.preventDefault();

                const productName = document.getElementById('product_name');
                const color = document.getElementById('color_code');
                const size = document.getElementById('size_name'); 
                const quantity = document.getElementById('quantity');
                // Gửi dữ liệu
                const createVariant = new FormData();
                createVariant.append('product_name', productName.value);
                
                createVariant.append('color_code', color.value);
                createVariant.append('size_name', size.value);
                createVariant.append('quantity', quantity.value);

                axios.post('/admin/product-variant', createVariant, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(res => {
                        const data = res.data;
                        window.location.href = '/admin/product-variant'; 
                    }).catch(err => {
                        if (err.response && err.response.data.errors) {
                            let errors = err.response.data.errors;
                            for (let field in errors) {
                                const errorElement = document.querySelector(`#${field}-error`);
                                if (errorElement) {
                                    errorElement.textContent = errors[field][0];
                                }
                            }
                        }
                    });
            });
        }
    </script>
@endsection
