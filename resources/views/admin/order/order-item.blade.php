@extends('layout.admin.home')
@section('content_admin')
    <div class="row">
        <div class="col-md-12">
            <div class="cr-card cr-invoice max-width-1180">
                <div class="cr-card-header">
                    <h4 class="cr-card-title">Invoice</h4>
                    <div class="header-tools">
                        <button class="cr-btn-primary m-r-5">Save</button>
                        <button class="cr-btn-secondary">Print</button>
                    </div>
                </div>
                <div class="cr-card-content card-default">

                    <div class="invoice-wrapper">

                        <div class="row">
                            <div class="col-md-6 col-lg-3 col-sm-6">
                                <img src="{{asset('assets/admin/img/logo/full-logo.png')}}" alt="logo">

                                <address>
                                    <br> 321, Porigo alto, new st george church, Nr. Jogas garden, USA.
                                </address>
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-6">
                                <p class="text-dark mb-2">From</p>

                                <address>
                                    <span>Carrot</span>
                                    <br> 47 Elita Squre, VIP Chowk,
                                    <br> <span>Email:</span> example@gmail.com
                                    <br> <span>Phone:</span> +91 5264 251 325
                                </address>
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-6">
                                <p class="text-dark mb-2">To</p>

                                <address>
                                    <span>{{$detail->user->username}}</span>
                                    <br> {{$detail->user->address}}
                                    <br> <span>Email</span>: {{$detail->user->email}}
                                    <br> <span>Phone:</span> {{$detail->user->phone}}
                                </address>
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-6">
                                <p class="text-dark mb-2">Details</p>

                                <address>
                                    <span>Order ID:</span>
                                    <span class="text-dark">{{$detail->order_id}}</span>
                                    <br><span>Bank :</span> Lotus bank
                                </address>
                            </div>
                        </div>
                        <div class="cr-chart-header">
                            <div class="block">
                                <h6>Order</h6>
                                <h5>
                                    {{$detail->order_id}}
                                </h5>
                            </div>
                            <div class="block">
                                <h6>Amount</h6>
                                <h5>
                                    {{number_format($detail->final_price)}} đ
                                </h5>
                            </div>
                            <div class="block">
                                <h6>Quantity</h6>
                                <h5>
                                    {{$quantity}}
                                </h5>
                            </div>
                            <div class="block">
                                <h6>Date</h6>
                                <h5>
                                    {{\Carbon\Carbon::parse($detail->created_at)->format('h:m:s d-m-Y')}}
                                </h5>
                            </div>
                        </div>
                        <div class="table-responsive tbl-8000">
                            <div>
                                <table class="table-invoice table-striped" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($detail->order_item as $item)
                                        <tr>
                                            <td>{{$loop->index}}</td>
                                            <td><img class="invoice-item-img"
                                                     src="{{asset('upload/'. $item->product->product_avatar)}}"
                                                     alt="product-image"></td>
                                            <td>{{$item->product->product_name}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{number_format($item->product->sale_price)}} đ</td>
                                            <td>{{number_format($item->product->sale_price * $item->quantity)}} đ</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row justify-content-end inc-total">
                            <div class="col-lg-9 order-lg-1 order-md-2 order-sm-2">
                                <div class="note">
                                    <label>Note</label>
                                    <p>Your country territory tax has been apply.</p>
                                    <p>Your voucher cannot be applied, because you enter wrong code.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 order-lg-2 order-md-1 order-sm-1">
                                <ul class="list-unstyled">
                                    <li class="mid pb-3 text-dark"> Subtotal
                                        <span
                                            class="d-inline-block float-right text-default">{{number_format($detail->total_price)}} đ</span>
                                    </li>

                                    @if(is_null($detail->voucher_id))
                                        <li class="mid pb-3 text-dark">Voucher
                                            <span
                                                class="d-inline-block float-right text-default"
                                            >0</span>
                                        </li>
                                    @else
                                        <li class="mid pb-3 text-dark">Voucher ( {{$detail->voucher->voucher_price}} % )
                                            <span
                                                class="d-inline-block float-right text-default"
                                            >{{number_format($detail->total_price * ($detail->voucher->voucher_price / 100)) }} đ</span>
                                        </li>
                                    @endif


                                    @if(is_null($detail->voucher_id))
                                        <li class="text-dark">Total
                                            <span class="d-inline-block float-right">
                                            {{number_format($detail->final_price)}} đ
                                        </span>
                                        </li>
                                    @else
                                        <li class="text-dark">Total
                                            <span class="d-inline-block float-right">
                                            {{number_format($detail->total_price - ($detail->total_price * ($detail->voucher->voucher_price / 100)))}} đ
                                        </span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
