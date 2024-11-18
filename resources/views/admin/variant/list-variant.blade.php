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
                            @foreach($list as $item)
                                <tr>
                                    <td>{{$loop->index}}</td>
                                    <td>{{$item->product->product_name}}</td>
                                    <td><input id="text" name="color_code"
                                               class="form-control here slug-title"
                                               type="color"
                                               value="{{$item->color->color_code}}" disabled></td>
                                    <td>{{$item->size->size_name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="button"
                                                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static">
															<span class="sr-only"><i
                                                                    class="ri-settings-3-line"></i></span>
                                            </button>
                                            <div class="dropdown-menu">
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
    </div>
@endsection
