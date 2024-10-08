@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>About Us</h2>
                            <span> <a href="index.html">Home</a> - About Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="section-about padding-tb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cr-about" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <h4 class="heading">About The Carrot</h4>
                        <div class="cr-about-content">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione, recusandae
                                necessitatibus quasi incidunt alias adipisci pariatur earum iure beatae assumenda
                                rerum quod. Tempora magni autem a voluptatibus neque.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut vitae rerum cum
                                accusamus magni consequuntur architecto, ipsum deleniti expedita doloribus suscipit
                                voluptatum eius perferendis amet!.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, maxime amet
                                architecto est exercitationem optio ea maiores corporis beatae, dolores doloribus libero
                                nesciunt qui illum? Voluptates deserunt adipisci voluptatem magni sunt
                                sed blanditiis quod aspernatur! Iusto?</p>
                            <div class="elementor-counter">
                                <div class="row">
                                    <div class="col-sm-4 col-12 margin-575">
                                        <h4 class="elementor">
                                            <span class="elementor-counter-number">1.2</span>
                                            <span class="elementor-suffix">k</span>
                                        </h4>
                                        <div class="elementor-counter-title">
                                            <span>Vendors</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-12 margin-575">
                                        <h4 class="elementor">
                                            <span class="elementor-counter-number">410</span>
                                            <span class="elementor-suffix">k</span>
                                        </h4>
                                        <div class="elementor-counter-title">
                                            <span>Customers</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-12 margin-575">
                                        <h4 class="elementor">
                                            <span class="elementor-counter-number">34</span>
                                            <span class="elementor-suffix">k</span>
                                        </h4>
                                        <div class="elementor-counter-title">
                                            <span>Products</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cr-about-image" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="800">
                        <img src="{{asset('assets/client/img/about/1.jpg')}}" alt="side-view">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
