@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Contact Us</h2>
                            <span> <a href="index.html">Home</a> - Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="section-Contact padding-tb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Get in Touch</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Prepared is me marianne pleasure likewise debating. Wonder an unable except better stairs
                                do ye
                                admire. His secure called esteem praise.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-minus-24">
                <div class="col-lg-4 col-md-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="2000"
                     data-aos-delay="400">
                    <div class="cr-info-box">
                        <div class="cr-icon">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div class="cr-info-content">
                            <h4 class="heading">Contact</h4>
                            <p><a href="javascript:void(0)"><i class="ri-phone-line"></i> &nbsp; (+91)-9876XXXXX</a></p>
                            <p><a href="javascript:void(0)"><i class="ri-phone-line"></i> &nbsp; (+91)-987654XXXX</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="2000"
                     data-aos-delay="600">
                    <div class="cr-info-box">
                        <div class="cr-icon">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div class="cr-info-content">
                            <h4 class="heading">Mail & Website</h4>
                            <p><a href="javascript:void(0)"><i class="ri-mail-line"></i> &nbsp;
                                    mail.example@gmail.com</a></p>
                            <p><a href="javascript:void(0)"><i class="ri-globe-line"></i> &nbsp; www.yourdomain.com</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-24" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="800">
                    <div class="cr-info-box">
                        <div class="cr-icon">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <div class="cr-info-content">
                            <h4 class="heading">Address</h4>
                            <p><a href="javascript:void(0)"><i class="ri-map-pin-line"></i> &nbsp; 140 Ruami Moraes
                                    Filho,
                                    987 - Salvador - MA, 40352, Brazil.</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row padding-t-100 mb-minus-24">
                <div class="col-md-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2965.0824050173574!2d-93.63905729999999!3d41.998507000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sWebFilings%2C+University+Boulevard%2C+Ames%2C+IA!5e0!3m2!1sen!2sus!4v1390839289319"
                        title="maps">
                    </iframe>
                </div>
                <div class="col-md-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="800">
                    <form class="cr-content-form">
                        <div class="form-group">
                            <input type="text" placeholder="Full Name" class="cr-form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Email" class="cr-form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Phone" class="cr-form-control">
                        </div>
                        <div class="form-group">
                            <textarea class="cr-form-control" id="exampleFormControlTextarea1" rows="4"
                                      placeholder="Message"></textarea>
                        </div>
                        <button type="button" class="cr-button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
