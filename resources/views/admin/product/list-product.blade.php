@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Product List</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="cr-card card-default product-list">
                <div class="cr-card-content ">
                    <div class="table-responsive">
                        <table id="product_list" class="table" style="width:100%">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
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
                                    <td><span class="active">active</span></td>
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
                                                <a class="dropdown-item" href="{{route('product.show', $item->product_id)}}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
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