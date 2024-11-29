@extends('layout.client.home')
@section('title', 'Đơn hàng của bạn')
@section('content_client')
    <style>
        /* Căn chỉnh cột bên phải */
        .row.align-items-center .col-md-3 {
            display: flex;
            flex-direction: column;
            justify-content: center; /* Căn giữa nội dung theo chiều dọc */
            align-items: flex-end;
        }

        /* Thiết kế badge */
        .bbb {
            font-size: 0.9rem;
            padding: 0.5rem 0.8rem;
            border-radius: 10px;
        }

        /* Thiết kế nút */
        .btn {
            font-size: 0.85rem;
            padding: 0.4rem 1rem;
            border-radius: 5px;
        }

        /* Màu nền cho đơn hàng */
        .list-group-item {
            background-color: #f1f1f1; /* Màu xanh nhạt nổi bật hơn */
            transition: background-color 0.2s ease-in-out;
            border: 1px solid #c8d8f2; /* Thêm viền để nổi bật */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Thay đổi màu khi hover */
        .list-group-item:hover {
            background-color: #ececec; /* Nền xanh đậm hơn khi hover */
        }

        /* Đảm bảo nút nằm đúng vị trí */
        .list-group-item .d-flex {
            margin-top: 10px; /* Tăng khoảng cách để cân đối */
        }
    </style>
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Đơn hàng</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Đơn hàng của bạn</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout section -->
    <section class="cr-checkout-section padding-tb-100">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="cr-checkout-rightside col-lg-4 col-md-12">
                    <div class="cr-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="cr-sidebar-block">
                            <div class="cr-sb-title">
                                <h3 class="cr-sidebar-title">Thông Tin Người Nhận</h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-checkout-summary">
                                    <div>
                                        <span class="text-left">Họ và tên</span>
                                        <span class="text-right">{{$getUser->username}}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Số điện thoại</span>
                                        <span class="text-right">{{$getUser->phone}}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Email</span>
                                        <span class="text-right">{{$getUser->email}}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Địa chỉ nhận hàng</span>
                                        <span class="text-right">{{$getUser->address}}</span>
                                    </div>
                                </div>
                                <div class="cr-checkout-pro">

                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
                <div class="cr-checkout-leftside col-lg-8 col-md-12 m-t-991">
                    <!-- checkout content Start -->
                    <div class="cr-checkout-content">
                        <div class="cr-checkout-inner">
                            <div class="cr-checkout-wrap mb-30">
                                <div class="cr-checkout-block cr-check-new">
                                    <h3 class="cr-checkout-title">Đơn hàng</h3>
                                </div>
                                <div class="cr-card-content">
                                    <div class="table-responsive">
                                        <div class="">
                                            <div class="list-group">
                                                <!-- Thêm các đơn hàng khác -->
                                                @foreach($getOrder as $item)
                                                    <div class="list-group-item shadow-sm border-0 mb-3 p-3 rounded">
                                                        <div class="row align-items-center">
                                                            <!-- Thông tin đơn hàng -->
                                                            <div class="col-md-9">
                                                                <h5 class="mb-1 text-primary">Mã đơn:
                                                                    <strong>#{{$item->order_id}}</strong></h5>
                                                                <p class="mb-1 text-muted">Ngày mua:
                                                                    <strong>{{\Illuminate\Support\Carbon::parse($item->created_at)->format('h:i d-m-Y')}}</strong>
                                                                </p>
                                                                <p class="mb-1">Tiền hàng: <span
                                                                        class="text-success fw-bold">{{number_format($item->total_price)}} đ</span>
                                                                </p>
                                                                @if(is_null($item->voucher_id))
                                                                    <p class="mb-1">Mã giảm giá: <span
                                                                            class="text-muted">Không có</span></p>
                                                                @else
                                                                    <p class="mb-1">Mã giảm giá: <span
                                                                            class="text-muted">{{$item->voucher->voucher_price}} %</span>
                                                                    </p>
                                                                @endif
                                                                <p class="mb-0">Tổng: <span
                                                                        class="text-primary fw-bold">{{number_format($item->final_price)}} đ</span>
                                                                </p>
                                                            </div>
                                                            <!-- Trạng thái và nút -->
                                                            <div class="col-md-3 text-end">
                                                                @if($item->status === 'Đang sử lý')
                                                                    <span
                                                                        data-badgeId="{{$item->order_id}}"
                                                                        class="badge bbb text-bg-warning mb-3 cancel">{{$item->status}}</span>
                                                                @elseif($item->status === 'Đã xác nhận')
                                                                    <span
                                                                        data-badgeId="{{$item->order_id}}"
                                                                        class="badge bbb text-bg-primary mb-3 cancel">{{$item->status}}</span>
                                                                @elseif($item->status === 'Đã giao hàng')
                                                                    <span
                                                                        data-badgeId="{{$item->order_id}}"
                                                                        class="badge bbb text-bg-success mb-3 cancel">{{$item->status}}</span>
                                                                @elseif($item->status === 'Yêu cầu huỷ đơn hàng')
                                                                    <span
                                                                        data-badgeId="{{$item->order_id}}"
                                                                        class="badge bbb text-bg-warning mb-3 cancel">Đã yêu cầu huỷ</span>
                                                                @endif
                                                                <div class="my-3"></div>
                                                                <div class="d-flex justify-content-center">
                                                                    @if($item->status === 'Đã giao hàng')
                                                                    @else
                                                                        <button
                                                                            style="width: 190px;"
                                                                            data-orderId="{{$item->order_id}}"
                                                                            class="{{$item->status === 'Đang sử lý' ? 'cr-button cancel-order bg-danger' : 'cr-button cancel-order disabled'}}
                                                                                dropdown-item me-2">
                                                                            {{$item->status === 'Đang sử lý' ? 'Huỷ đơn hàng' : 'Đã gửi yêu cầu huỷ đơn'}}
                                                                        </button>
                                                                    @endif
                                                                    <a href="{{route('detail-order', $item->order_id)}}"
                                                                       class="cr-button btn-secondary dropdown-item">
                                                                        Chi tiết
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <nav aria-label="" class="cr-pagination">
                                        {{$getOrder->links()}}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
@endsection
