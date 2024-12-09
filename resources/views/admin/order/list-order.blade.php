@extends('layout.admin.home')
@include('toast.admin-toast')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Danh sách đơn hàng</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="cr-card card-default product-list">
                <div class="mt-4 mx-4 header-tools d-flex justify-content-end align-items-center">
                    <button id="reloadButton" class="cr-btn-primary m-r-5">Làm mới</button>
                    <a href="{{route('export-order')}}" class="cr-btn-primary">Export</a>
                </div>
                <div class="cr-card-content">
                    <div class="table-responsive">
                        <table id="cat_data_table" class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã đơn hàng</th>
                                <th>Người mua</th>
                                <th>Tiền hàng</th>
                                <th>Voucher</th>
                                <th>Thành tiền</th>
                                <th>Ngày mua</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listOrder as $item)
                                <tr data-id="{{$item->order_id}}">
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$item->order_id}}</td>
                                    <td>{{$item->user->username}}</td>
                                    <td>{{number_format($item->total_price)}} đ</td>
                                    @if(is_null($item->voucher_id))
                                        <td>Không có</td>
                                    @else
                                        <td>{{$item->voucher->voucher_price}} %</td>
                                    @endif
                                    <td>{{number_format($item->final_price)}} đ</td>
                                    <td>{{\Illuminate\Support\Carbon::parse($item->created_at)->format('H:i / d-m-Y')}}</td>
                                    <td>
                                        @if($item->payment_status === 'Đã thanh toán')
                                            <span
                                                data-payment="{{$item->order_id}}"
                                                class="badge text-bg-success payment-status">Đã thanh toán</span>
                                        @else
                                            <span
                                                data-payment="{{$item->order_id}}"
                                                class="badge text-bg-danger payment-status">Chưa thanh toán</span>
                                        @endif
                                    </td>
                                    <td class="order-status" data-id="{{$item->order_id}}">
                                        @if($item->status === 'Đang sử lý')
                                            <span
                                                data-orId="{{$item->order_id}}"
                                                class="badge text-bg-warning oro">{{$item->status}}</span>
                                        @elseif($item->status === 'Đã xác nhận')
                                            <span
                                                data-orId="{{$item->order_id}}"
                                                class="badge text-bg-primary oro">{{$item->status}}</span>
                                        @elseif($item->status === 'Đã giao hàng')
                                            <span
                                                data-orId="{{$item->order_id}}"
                                                class="badge text-bg-success oro">{{$item->status}}</span>
                                        @elseif($item->status === 'Yêu cầu huỷ đơn hàng')
                                            <span
                                                data-orId="{{$item->order_id}}"
                                                class="badge text-bg-danger oro">{{$item->status}}</span>
                                        @elseif($item->status === 'Hủy đơn hàng')
                                            <span
                                                data-orId="{{$item->order_id}}"
                                                class="badge text-bg-danger oro">Đã hủy</span>
                                        @elseif($item->status === 'Đã nhận được hàng')
                                            <span
                                                data-orId="{{$item->order_id}}"
                                                class="badge text-bg-success oro">{{$item->status}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" data-display="static">
															<span class="sr-only"><i
                                                                    class="ri-settings-3-line"></i></span>
                                        </button>
                                        <div class="dropdown-menu" data-dropId="{{$item->order_id}}">
                                            @if($item->status === 'Yêu cầu huỷ đơn hàng')
                                                <button
                                                    data-status="Hủy đơn hàng" data-id="{{$item->order_id}}"
                                                    class="dropdown-item {{$item->status != 'Yêu cầu huỷ đơn hàng' ? 'd-none' : ''}} update-status btn btn-warning"
                                                >Hủy đơn hàng
                                                </button>
                                                <a href="{{route('admin-order-detail', $item->order_id)}}"
                                                   class="dropdown-item">Chi tiết</a>
                                            @elseif($item->status === 'Hủy đơn hàng')
                                                <a href="{{route('admin-order-detail', $item->order_id)}}"
                                                   class="dropdown-item">Chi tiết</a>
                                            @elseif($item->status === 'Đã giao hàng')
                                                <a href="{{route('admin-order-detail', $item->order_id)}}"
                                                   class="dropdown-item">Chi tiết</a>
                                            @elseif($item->status === 'Đã nhận được hàng')
                                                <a href="{{route('admin-order-detail', $item->order_id)}}"
                                                   class="dropdown-item">Chi tiết</a>
                                            @elseif($item->status === 'Đang sử lý')
                                                <button
                                                    data-status="Hủy đơn hàng" data-id="{{$item->order_id}}"
                                                    class="dropdown-item {{$item->status != 'Yêu cầu huỷ đơn hàng' ? 'd-none' : ''}} update-status btn btn-warning"
                                                >Hủy đơn hàng
                                                </button>
                                                <button
                                                    data-status="Đã xác nhận" data-id="{{$item->order_id}}"
                                                    class="dropdown-item update-status btn btn-primary"
                                                >Đã xác nhận
                                                </button>
                                                <a href="{{route('admin-order-detail', $item->order_id)}}"
                                                   class="dropdown-item">Chi tiết</a>
                                            @elseif($item->status === 'Đã xác nhận')
                                                <button
                                                    data-status="Đã giao hàng" data-id="{{$item->order_id}}"
                                                    class="dropdown-item update-status btn btn-success"
                                                >Đã giao hàng
                                                </button>
                                                {{--<button
                                                    data-status="Hủy đơn hàng" data-id="{{$item->order_id}}"
                                                    class="dropdown-item {{$item->status != 'Yêu cầu huỷ đơn hàng' ? 'd-none' : ''}} update-status btn btn-warning"
                                                >Hủy đơn hàng
                                                </button>--}}
                                                <a href="{{route('admin-order-detail', $item->order_id)}}"
                                                   class="dropdown-item">Chi tiết</a>
                                                {{--<button class="dropdown-item delete-order"
                                                        data-id="{{$item->order_id}}">
                                                    Xóa đơn hàng
                                                </button>--}}
                                            @endif
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
    <script !src="">
        document.getElementById('reloadButton').addEventListener('click', function () {
            location.reload();
        });
    </script>
@endsection
