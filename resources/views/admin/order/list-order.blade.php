@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>List size</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="cr-card card-default product-list">
                <div class="mt-4 mx-4 header-tools d-flex justify-content-end align-items-center">
                    {{--<button class="cr-btn-primary m-r-5">Save</button>--}}
                    <a href="{{route('export-order')}}" class="cr-btn-primary">Export</a>
                </div>
                <div class="cr-card-content ">
                    <div class="table-responsive">
                        <table id="cat_data_table" class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Total price</th>
                                <th>Voucher</th>
                                <th>Final price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listOrder as $item)
                                <tr data-id="{{$item->order_id}}">
                                    <td>{{$item->order_id}}</td>
                                    <td>{{$item->user->username}}</td>
                                    <td>{{number_format($item->total_price)}} đ</td>

                                    @if(is_null($item->voucher_id))
                                        <td>Không có</td>
                                    @else
                                        <td>{{$item->voucher->voucher_price}} %</td>
                                    @endif
                                    <td>{{number_format($item->final_price)}} đ</td>
                                    <td>{{\Illuminate\Support\Carbon::parse($item->created_at)->format('H:i:s d-m-Y')}}</td>
                                    <td class="order-status" data-id="{{$item->order_id}}">
                                        @if($item->status === 'Đang sử lý')
                                            <span class="badge text-warning">{{$item->status}}</span>
                                        @elseif($item->status === 'Đã xác nhận')
                                            <span class="badge text-primary">{{$item->status}}</span>
                                        @elseif($item->status === 'Đã giao hàng')
                                            <span class="badge text-success">{{$item->status}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button"
                                                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static">
															<span class="sr-only"><i
                                                                    class="ri-settings-3-line"></i></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button
                                                    data-status="Đang sử lý" data-id="{{$item->order_id}}"
                                                    class="dropdown-item update-status btn btn-warning"
                                                >Đang sử lý
                                                </button>
                                                <button
                                                    data-status="Đã xác nhận" data-id="{{$item->order_id}}"
                                                    class="dropdown-item update-status btn btn-primary"
                                                >Đã xác nhận
                                                </button>
                                                <button
                                                    data-status="Đã giao hàng" data-id="{{$item->order_id}}"
                                                    class="dropdown-item update-status btn btn-success"
                                                >Đã giao hàng
                                                </button>
                                                <a href="{{route('admin-order-detail', $item->order_id)}}"
                                                   class="dropdown-item">Chi tiết</a>
                                                <button class="dropdown-item delete-btn" data-id="">
                                                    Delete
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
