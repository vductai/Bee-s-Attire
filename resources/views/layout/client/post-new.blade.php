<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-30" data-aos="fade-up" data-aos-duration="2000">
                <div class="cr-banner">
                    <h2><a href="{{route('list-article')}}">Bài viết</a></h2>
                </div>
                <div class="cr-banner-sub-title">
                    <p>Những thông tin về thời trang, xu hướng hiện đại sẻ được chúng tôi cập nhật hằng ngày</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="cr-blog-slider swiper-container">
                <div class="swiper-wrapper">
                    @foreach($posts as $post)
                        <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                            <div class="cr-blog">
                                <div class="cr-blog-content">
                                    <h5 style="display: -webkit-box;
                                            -webkit-line-clamp: 3; -webkit-box-orient: vertical;white-space: nowrap;
                                            overflow: hidden; text-overflow: ellipsis; word-wrap: break-word">
                                        {{$post->title}}
                                    </h5>
                                    <a class="read" href="{{route('detail-article', $post->slug)}}">Đọc thêm</a>
                                </div>
                                <div class="cr-blog-image" style="width: 414px; height: 232px">
                                    <img src="{{asset('upload/' . $post->avatar)}}" class="w-100 h-100" alt="blog-2">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
