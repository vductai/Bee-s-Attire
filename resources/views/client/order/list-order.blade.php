@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Checkout</h2>
                            <span> <a href="index.html">Home</a> - Checkout</span>
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
                                <div class="cr-card-content ">
                                    <div class="table-responsive">
                                        <table id="cat_data_table" class="table">
                                            <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Tiền hàng</th>
                                                <th>Mã giảm giá</th>
                                                <th>Tổng</th>
                                                <th>Ngày mua</th>
                                                <th>Trạng thái</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($getOrder as $item)
                                                <tr>
                                                    <td>{{$item->order_id}}</td>
                                                    <td>{{number_format($item->total_price)}} đ</td>
                                                    @if(is_null($item->voucher_id))
                                                        <td>Không có</td>
                                                    @else
                                                        <td>{{$item->voucher->voucher_price}} %</td>
                                                    @endif
                                                    <td>{{number_format($item->final_price)}} đ</td>
                                                    <td>{{\Illuminate\Support\Carbon::parse($item->created_at)->format('h:i:s d-m-Y')}}</td>
                                                    <td>
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
                                                                <a class="dropdown-item" href="{{route('detail-order', $item->order_id)}}">Chi tiết</a>
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
                    <!--cart content End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
@endsection