<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-30" data-aos="fade-up" data-aos-duration="2000">
                <div class="cr-banner">
                    <h2>Những lời tuyệt vời từ mọi người</h2>
                </div>
                <div class="cr-banner-sub-title">
                    <p>Việc khách hàng nhận thức được nhu cầu của mình là rất quan trọng nhưng chúng
                        cũng diễn ra đồng thời với công việc của chủ hoặc người chủ. </p>
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
