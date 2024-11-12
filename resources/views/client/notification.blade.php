@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Thông báo</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> - Thông báo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Compare -->
    <section class="section-compare padding-tb-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Compare</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Danh sách thông báo -->
            <div class="d-flex justify-content-end">
                <button id="del-all-noti" class="cr-button btn-secondary">
                    Xoá tất cả thông báo
                </button>
            </div>
            <div class="cr-tab-content-from" id="list-all-noti">
                @if(\App\Models\Notifications::where('user_id', auth()->user()->user_id)->exists())
                    @foreach($notifications as $item)
                        <div class="post rounded-2 border p-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="content">
                                    <div class="details">
                                    <span
                                        class="date">{{\Illuminate\Support\Carbon::parse($item->created_at)->diffForHumans()}}</span>
                                    </div>
                                </div>
                                <p class="text-black">
                                <span
                                    class="noti-item badge {{$item->is_read === 'Chưa đọc' ? 'text-bg-danger' : 'text-bg-success'}} mx-2"
                                    data-span-id="{{$item->id}}">{{$item->is_read === 'Chưa đọc' ? 'Mới' : 'Đã đọc'}}</span></a>
                                    {{$item->message}}
                                </p>
                            </div>
                            <div>
                                <button
                                    data-noti-id="{{$item->id}}"
                                    class="cr-button noti-button {{$item->is_read === 'Chưa đọc' ? '' : 'd-none'}}">
                                    Đánh dấu là đã đọc
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-danger text-center">Bạn không có thông báo nào</p>
                @endif
            </div>
        </div>
    </section>
@endsection
