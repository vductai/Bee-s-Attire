@extends('layout.client.home')
@section('title', 'Tin tức')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Bài viết</h2>
                            <span><a href="{{route('home')}}">Trang chủ</a> / Bài viết</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog-Classic -->
    <section class="section-blog-Classic padding-tb-100">
        <div class="container">
            <div class="row mb-minus-24">
                @foreach($list as $item)
                    <div class="col-lg-6 mb-24">
                        <div class="cr-blog-classic" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                            <div class="cr-blog-classic-content">
                                <div class="cr-comment noti">
                                    <span>Bởi Quản trị viên <code> / {{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</code></span>
                                </div>
                                <h4>
                                    {{$item->title}}
                                </h4>
                                <p style="display: -webkit-box;
                                            -webkit-line-clamp: 3; -webkit-box-orient: vertical;white-space: nowrap;
                                            overflow: hidden; text-overflow: ellipsis; word-wrap: break-word"
                                >{{$item->desc}}</p>
                                <a href="{{route('detail-article', $item->slug)}}">Đọc thêm</a>
                            </div>
                            <div class="cr-blog-image" style="width: 724px;height: 306px">
                                <img style="height: 100%; width: 100%;" src="{{asset('upload/' . $item->avatar)}}"
                                     alt="blog-1">
                            </div>
                        </div>
                    </div>
                @endforeach
                <nav aria-label="..." class="cr-pagination">
                    {{$list->links()}}
                </nav>
            </div>
        </div>
    </section>
@endsection
