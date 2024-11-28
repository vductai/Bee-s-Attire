@extends('layout.admin.home')
@include('toast.admin-toast')

@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Danh sách sản phẩm</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="cr-card card-default product-list">
                <div class="cr-card-content ">
                    <div class="table-responsive">
                        <table id="cat_data_table" class="table" style="width:100%">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Danh mục</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr data-id="{{$item->product_id}}">
                                    <td>{{$loop->index}}</td>
                                    <td>
                                        <img class="tbl-thumb"
                                             src="{{asset('upload/'. $item->product_avatar)}}"
                                             alt="Product Image">
                                    </td>
                                    <td>
                                        {{$item->product_name}}
                                    </td>
                                    <td>
                                        <p class="ppp">
                                            <span class="new-price">
                                                {{number_format($item->sale_price)}} đ
                                            </span>
                                            <span
                                                class="old-price">
                                                {{number_format($item->product_price)}} đ
                                            </span>
                                        </p>
                                    </td>
                                    <td>{{$item->category->category_name}}</td>
                                    <td>
                                        <span class="badgeProduct badge {{ $item->action ? 'text-bg-success' : 'text-bg-danger' }}"
                                              data-status="{{ $item->action ? 'active' : 'inactive' }}">
                                            {{$item->action ? 'Public' : 'Private'}}
                                        </span>
                                    </td>
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
                                                <a class="dropdown-item" href="{{route('product.edit', $item->product_id)}}">Chỉnh sửa</a>
                                                <a class="dropdown-item" href="#">Xoá</a>
                                                <button class="dropdown-item toggleButton" data-id="{{$item->product_id}}">
                                                    {{$item->action ? 'Private' : 'Public'}}
                                                </button>
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
