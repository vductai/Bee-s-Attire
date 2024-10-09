<div class="cr-slider swiper-container">
    <div class="swiper-wrapper">
        @foreach ($banners as $banner)
            <div class="swiper-slide">
                <div class="banner-slide" style="background-image: url('{{ asset('storage/' . $banner->image) }}'); width: 100%; height: 900px; background-size: cover; background-position: center;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cr-left-side-contain slider-animation">
                                    <h1><span>{{ $banner->subtitle }}</span> {{ $banner->title }}</h1>
                                    <h5>{{ $banner->description }}</h5>
                                    <div class="cr-last-buttons">
                                        <a href="" class="cr-button">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>


