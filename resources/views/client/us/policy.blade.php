@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Privacy Policy</h2>
                            <span> <a href="index.html">Home</a> - Privacy Policy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Policy section -->
    <section class="cr-policy padding-tb-100" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30">
                        <div class="cr-banner">
                            <h2>Privacy Policy</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Check ou Privacy Policy and Conditions</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">

                    <div class="cr-common-wrapper spacing-991">
                        @foreach ($firstPolicies as $value)
                            <div class="col-sm-12 cr-cgi-block">
                                <div class="cr-cgi-block-inner">
                                    <h5 class="cr-cgi-block-title">{{ $value->title }}</h5>
                                    <p>{{ strip_tags($value->content_post) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 m-t-991">
                    <div class="cr-common-wrapper">
                        @foreach ($lastPolicies as $value)
                            <div class="col-sm-12 cr-cgi-block">
                                <div class="cr-cgi-block-inner">
                                    <h5 class="cr-cgi-block-title">{{ $value->title }}</h5>
                                    <p>{{ strip_tags($value->content_post) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Policy section End -->
@endsection
