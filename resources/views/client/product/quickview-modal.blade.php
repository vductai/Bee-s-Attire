<link rel="stylesheet" href="{{asset('assets/client/css/voucher-item.css')}}">
<div class="modal fade quickview-modal" id="quickview" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered cr-modal-dialog">
        <div class="modal-content">
            @if(auth()->check())
                <button type="button" class="cr-close-model btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <h3 class="text-center">Mã giảm giá của bạn</h3>
                        @if(\App\Models\user_voucher::where('user_id', auth()->user()->user_id)->exists())
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach($voucher as $item)
                                    <div class="col">
                                        <div class="voucher-card">
                                            <div class="voucher-title">{{$item->voucher->voucher_desc}}</div>
                                            <p class="voucher-span">Tối đa {{number_format($item->voucher->max_discount)}} đ</p>
                                            <div class="voucher-discount">{{$item->voucher->voucher_price}}% OFF</div>
                                            <div class="voucher-details">Code: <strong>{{$item->voucher->voucher_code}}</strong></div>
                                            <div class="voucher-expiry mb-3">
                                                Hạn dùng mã: <br>
                                                <b>{{\Illuminate\Support\Carbon::parse($item->end_date)->format('d-m-Y') }}</b>
                                            </div>
                                            <button class="use-btn rounded-2" data-copys="{{$item->voucher->voucher_code}}">Copy code</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h3 class="text-danger text-center" style="margin: 80px 0;">Bạn không có mã giảm giá nào</h3>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
