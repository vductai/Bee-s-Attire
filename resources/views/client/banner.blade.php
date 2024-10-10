<div class="cr-slider swiper-container">
    <div class="swiper-wrapper">
        @php $slideCount = 0; @endphp
        @foreach ($banners as $banner)
            @foreach ($banner->imageBanners as $image)
                @if ($slideCount < 3)
                    <div class="swiper-slide">
                        <div class="banner-slide"
                            style="background-image: url('{{ asset('upload/uploads/' . $image->image_path) }}'); width: 100%; height: 900px;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cr-left-side-contain slider-animation">
                                            <h1><span>{{ $banner->banner_subtitle }}</span> {{ $banner->banner_title }}
                                            </h1>
                                            <h5>{{ $banner->banner_description }}</h5>
                                            <div class="cr-last-buttons">
                                                <a href="" class="cr-button">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $slideCount++; @endphp
                @endif
            @endforeach
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
