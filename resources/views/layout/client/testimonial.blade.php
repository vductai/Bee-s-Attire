<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-30" data-aos="fade-up" data-aos-duration="2000">
                <div class="cr-banner">
                    <h2>Great Words From People</h2>
                </div>
                <div class="cr-banner-sub-title">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut labore lacus vel facilisis. </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="cr-testimonial-slider swiper-container">
                <div class="swiper-wrapper cr-testimonial-pt-50">
                    @foreach($comment as $item)
                        <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                            <div class="cr-testimonial">
                                <div class="cr-testimonial-image">
                                    <img src="{{asset('upload/' . $item->user->avatar)}}" alt="businessman">
                                </div>
                                <div class="cr-testimonial-inner">
                                    <h4 class="title">{{$item->user->username}}</h4>
                                    <p>
                                        “{{$item->comment}}”
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
