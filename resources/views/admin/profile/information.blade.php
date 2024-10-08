@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Vendor Profile</h5>
            <ul>
                <li><a href="index.html">Carrot</a></li>
                <li>Vendor Profile</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-3 col-xl-4 col-md-12">
            <div class="vendor-sticky-bar">
                <div class="col-xl-12">
                    <div class="cr-card">
                        <div class="cr-card-content">
                            <div class="cr-vendor-block-img">
                                <div class="cr-vendor-block-detail">
                                    <div class="profile-img">
                                        <img class="v-img" src={{ asset('assets/admin/img/clients/3.jpg') }}
                                            alt="vendor image">
                                        <span class="tag-label online"></span>
                                    </div>
                                    <h5 class="name">Harley Pharma</h5>
                                    <p>( example@support.com )</p>
                                    <div class="cr-settings">
                                        <a href="#" class="cr-btn-primary m-r-10">Edit Profile</a>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical" title="Status"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><span
                                                            class="tag-label online"></span>Online</a></li>
                                                <li><a class="dropdown-item" href="#"><span
                                                            class="tag-label offline"></span>Offline</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#"><span
                                                            class="tag-label busy"></span>Busy</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="cr-vendor-info">
                                    <ul>
                                        <li><span class="label">Name :</span>&nbsp;Elizabeth Morgus</li>
                                        <li><span class="label">Companey :</span>&nbsp;Corporate</li>
                                        <li><span class="label">Website :</span>&nbsp;www.example.com</li>
                                        <li><span class="label">Phone :</span>&nbsp;+1 546 4548 878787</li>
                                        <li><span class="label">location :</span>&nbsp;Australia</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-9 col-xl-8 col-md-12">

            <div class="cr-card vendor-profile">
                <div class="cr-card-content vendor-details mb-m-30">

                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Account Details</h3>
                            <div class="cr-vendor-detail">
                                <p>From your account you can easily view and track orders. You can manage
                                    and change your account information like address, contact information
                                    and history of orders.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="cr-vendor-detail">
                                <h6>E-mail address</h6>
                                <ul>
                                    <li><strong>Email 1 : </strong>support1@exapmle.com</li>
                                    <li><strong>Email 2 : </strong>support2@exapmle.com</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="cr-vendor-detail">
                                <h6>Contact nubmer</h6>
                                <ul>
                                    <li><strong>Phone Nubmer 1 : </strong>(123) 123 456 7890</li>
                                    <li><strong>Phone Nubmer 2 : </strong>(123) 123 456 7890</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="cr-vendor-detail">
                                <h6>Address</h6>
                                <ul>
                                    <li>123, 2150 Sycamore Street, dummy text of
                                        the, bara cota San Jose, California - 95131.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="cr-vendor-detail">
                                <h6>Address 2</h6>
                                <ul>
                                    <li>123, 2150 Sycamore Street, dummy text of
                                        the, bara cota San Jose, California - 95131.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="cr-vendor-detail">
                                <h6>Bank Accounts</h6>
                                <ul>
                                    <li><strong>Account Name : </strong>Wiley Waites</li>
                                    <li><strong>Account Nubmer : </strong>123**********80</li>
                                    <li><strong>IFSC Code : </strong>123**********80</li>
                                    <li><strong>Bank name : </strong>Barky Central Bank</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="cr-vendor-detail">
                                <h6>Social media</h6>
                                <ul>
                                    <li><strong><i class="ri-facebook-line"></i> </strong><a
                                            href="#">https://www.facebook.com/youraccount</a></li>
                                    <li><strong><i class="ri-twitter-line"></i> </strong><a
                                            href="#">https://twitter.com/youraccount</a></li>
                                    <li><strong><i class="ri-linkedin-line"></i> </strong><a
                                            href="#">https://in.linkedin.com/youraccount</a></li>
                                    <li><strong><i class="ri-github-line"></i> </strong><a
                                            href="#">https://github.com/youraccount</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="cr-vendor-detail">
                                <h6>Payment</h6>
                                <ul>
                                    <li><strong>Paypal : </strong>support1@exapmle.com</li>
                                    <li><strong>Payoneer : </strong>support2@exapmle.com</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="cr-vendor-detail">
                                <h6>Tax Info</h6>
                                <ul>
                                    <li><strong>TIN NO : </strong>SDF5***********5F</li>
                                    <li><strong>Tax ID Number : </strong>6582***********523</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
