@extends('layout.client.home')
@section('content_client')
    <link rel="stylesheet" href="{{asset('assets/client/app.css')}}">
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="from">
                <img src="carrot-logo.png" alt="Carrot">
                <p>321, Porigo alto, new st george church,<br>
                    Nr. Jogas garden, USA.</p>
            </div>
            <div class="to">
                <p><strong>To</strong><br>
                    User: {{$detail->user->username}}<br>
                    Address: {{$detail->user->address}}<br>
                    Email: {{$detail->user->email}}<br>
                    Phone: {{$detail->user->phone}}</p>
            </div>
            <div class="details">
                <p><strong>Order ID:</strong> {{$detail->order_id}}<br>
                    <strong>Bank:</strong> Lotus bank<br>
            </div>
        </div>

        <div class="invoice-summary">
            <div><strong>Order:</strong> {{$detail->order_id}}</div>
            <div><strong>Amount:</strong> {{number_format($detail->final_price)}} đ</div>
            <div><strong>Quantity:</strong> {{$quantity}}</div>
            <div><strong>Date:</strong> {{\Carbon\Carbon::parse($detail->created_at)->format('h:m:s d-m-Y')}}</div>
        </div>

        <table class="invoice-items">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th class="item-column">Item</th>
                <th>Quantity</th>
                <th class="price-column">Price</th>
                <th class="total-column">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($detail->order_item as $item)
                <tr>
                    <td>{{$loop->index}}</td>
                    <td>
                        <img src="{{asset('upload/'. $item->product->product_avatar)}}"
                             alt="Pants">
                    </td>
                    <td>{{$item->product->product_name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{number_format($item->product->sale_price)}} đ</td>
                    <td>{{number_format($item->product->sale_price * $item->quantity)}} đ</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="invoice-bottom">
            <div class="invoice-note">
                <p><strong>Note:</strong></p>
                <p>Your country territory tax has been applied.<br>
                    Your voucher cannot be applied, because you entered the wrong code.</p>
            </div>

            <div class="invoice-total">
                <table>
                    <tr>
                        <td><strong>Subtotal</strong></td>
                        <td>{{number_format($detail->total_price)}} đ</td>
                    </tr>
                    <tr>
                        @if(is_null($detail->voucher_id))
                            <td><strong>Voucher</strong></td>
                            <td>0</td>
                        @else
                            <td><strong>Voucher</strong></td>
                            <td>{{number_format($detail->total_price * ($detail->voucher->voucher_price / 100)) }} đ</td>
                        @endif
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        @if(is_null($detail->voucher_id))
                            <td>
                                {{number_format($detail->final_price)}} đ
                            </td>
                        @else
                            <td>
                                {{number_format($detail->total_price - ($detail->total_price * ($detail->voucher->voucher_price / 100)))}} đ
                            </td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>

        {{--<div class="invoice-actions">
            <button class="save">Save</button>
            <button class="print" onclick="window.print()">Print</button>
        </div>--}}
    </div>
@endsection
