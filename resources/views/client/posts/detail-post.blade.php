@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Chi tiết bài viết</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Chi tiết bài viết</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog-details -->
    <section class="blog-details padding-tb-100">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                <div class="col-lg-12">
                    <div class="cr-blog-details d-flex justify-content-center">
                        {{--<div class="cr-blog-details-image">
                            <img src="{{asset('upload/' . $detail->avatar)}}" alt="blog-1">
                        </div>--}}
                        <div class="cr-blog-details-content" style="width: 950px;">
                            <div class="cr-admin-date">
                                <span><code>Bởi Quản trị viên</code> / {{\Carbon\Carbon::parse($detail->created_at)->diffForHumans()}}</span>
                            </div>
                            <div class="cr-banner">
                                <h2>{{$detail->title}}</h2>
                            </div>
                            <p class="my-3">{{$detail->desc}}</p>
                            <div style="width: 100%;height: 1px;background-color: #c0bebe;margin-bottom: 50px;"></div>
                            <p class="mb-15">{!! $detail->content !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
