<header class="cr-header">
    <div class="container-fluid">
        <div class="cr-header-items">
            <div class="left-header">
                <a href="javascript:void(0)" class="cr-toggle-sidebar">
							<span class="outer-ring">
								<span class="inner-ring"></span>
							</span>
                </a>
                <div class="header-search-box">
                    <div class="header-search-drop">
                        <a href="javascript:void(0)" class="open-search"><i class="ri-search-line"></i></a>
                        <form class="cr-search">
                            <input class="search-input" type="text" placeholder="Search...">
                            <a href="javascript:void(0)" class="search-btn"><i class="ri-search-line"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="right-header">
                <div class="cr-right-tool cr-flag-drop language">
                    <div class="cr-hover-drop">
                        <div class="cr-hover-tool">
                            <img class="flag" src="{{asset('/img/flag/us.pn')}}g" alt="flag">
                        </div>
                        <div class="cr-hover-drop-panel right">
                            <ul>
                                <li><a href="javascript:void(0)"><img class="flag" src="{{asset('/img/flag/us.pn')}}g"
                                                                      alt="flag">English</a></li>
                                <li><a href="javascript:void(0)"><img class="flag" src="{{asset('/img/flag/in.pn')}}g"
                                                                      alt="flag">Hindi</a></li>
                                <li><a href="javascript:void(0)"><img class="flag" src="{{asset('/img/flag/de.pn')}}g"
                                                                      alt="flag"> Deutsch</a></li>
                                <li><a href="javascript:void(0)"><img class="flag" src="{{asset('/img/flag/it.pn')}}g"
                                                                      alt="flag">Italian</a></li>
                                <li><a href="javascript:void(0)"><img class="flag" src="{{asset('/img/flag/jp.pn')}}g"
                                                                      alt="flag">Japanese</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="cr-right-tool apps">
                    <div class="cr-hover-drop">
                        <div class="cr-hover-tool">
                            <i class="ri-apps-2-line"></i>
                        </div>
                        <div class="cr-hover-drop-panel right">
                            <h6 class="title">Apps</h6>
                            <ul>
                                <li><a href="javascript:void(0)"><img class="app" src="{{asset('/img/apps/1.png')}}"
                                                                      alt="flag">English</a></li>
                                <li><a href="javascript:void(0)"><img class="app" src="{{asset('/img/apps/2.png')}}"
                                                                      alt="flag">Hindi</a></li>
                                <li><a href="javascript:void(0)"><img class="app" src="{{asset('/img/apps/3.png')}}"
                                                                      alt="flag"> Deutsch</a></li>
                                <li><a href="javascript:void(0)"><img class="app" src="{{asset('/img/apps/4.png')}}"
                                                                      alt="flag">Italian</a></li>
                                <li><a href="javascript:void(0)"><img class="app" src="{{asset('/img/apps/5.png')}}"
                                                                      alt="flag">Japanese</a></li>
                                <li><a href="javascript:void(0)"><img class="app" src="{{asset('/img/apps/6.png')}}"
                                                                      alt="flag">Japanese</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="cr-right-tool display-screen">
                    <a class="cr-screen full" href="javascript:void(0)"><i
                            class="ri-fullscreen-line"></i></a>
                    <a class="cr-screen reset" href="javascript:void(0)"><i
                            class="ri-fullscreen-exit-line"></i></a>
                </div>
                <div class="cr-right-tool">
                    <a class="cr-notify" href="javascript:void(0)">
                        <i class="ri-notification-2-line"></i>
                        <span class="label"></span>
                    </a>
                </div>
                <div class="cr-right-tool display-dark">
                    <a class="cr-mode dark" href="javascript:void(0)"><i class="ri-moon-clear-line"></i></a>
                    <a class="cr-mode light" href="javascript:void(0)"><i class="ri-sun-line"></i></a>
                </div>
                <div class="cr-right-tool cr-user-drop">
                    <div class="cr-hover-drop">
                        <div class="cr-hover-tool">
                            <img class="user" src="{{asset('/img/user/1.jpg')}}" alt="user">
                        </div>
                        <div class="cr-hover-drop-panel right">
                            <div class="details">
                                <h6>Wiley Waites</h6>
                                <p>wiley@example.com</p>
                            </div>
                            <ul class="border-top">
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Messages</a></li>
                                <li><a href="#">Projects</a></li>
                                <li><a href="#">Settings</a></li>
                            </ul>
                            <ul class="border-top">
                                <li><a href="#"><i class="ri-logout-circle-r-line"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="cr-sidebar-overlay"></div>
<div class="cr-sidebar" data-mode="light">
    <div class="cr-sb-logo">
        <a href="#" class="sb-full"><img src="{{asset('img/logo/full-logo.png')}}" alt="logo"></a>
        <a href="#" class="sb-collapse"><img src="{{asset('img/logo/collapse-logo.png')}}" alt="logo"></a>
    </div>
    <div class="cr-sb-wrapper">
        <div class="cr-sb-content">
            <ul class="cr-sb-list">
                <li class="cr-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="cr-drop-toggle">
                        <i class="ri-dashboard-3-line"></i><span class="condense">Dashboard<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-drop condense">
                        <li><a href="../admin/page/dashbroad.blade.php" class="cr-page-link drop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Dashboard</a></li>
                        <li><a href="../admin/product/product.blade.php" class="cr-page-link drop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Product list</a></li>
                        <li><a href="../admin/product/add-product.blade.php" class="cr-page-link drop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Add Product</a></li>
                        <li><a href="../admin/category/category.blade.php" class="cr-page-link drop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Category</a></li>


                    </ul>
                </li>
                <li class="cr-sb-item-separator"></li>
                <!-- <li class="cr-sb-title condense" type="hiden">Pages</li>
                <li class="cr-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="cr-drop-toggle">
                        <i class="ri-pages-line"></i><span class="condense">Authentication<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-drop condense">
                        <li><a href="signin.html" class="cr-page-link drop"><i
                                    class="ri-checkbox-blank-circle-line"></i></i>Login</a></li>
                        <li><a href="signup.html" class="cr-page-link drop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Signup</a></li>
                        <li><a href="forgot.html" class="cr-page-link drop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Forgot password</a></li>
                        <li><a href="two-factor.html" class="cr-page-link drop"><i
                                    class="ri-checkbox-blank-circle-line"></i>two factor</a></li>
                        <li><a href="reset-password.html" class="cr-page-link drop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Reset password</a></li>
                        <li><a href="remember.html" class="cr-page-link drop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Remember</a></li>
                    </ul>
                </li>
                <li class="cr-sb-item-separator"></li> -->
            </ul>
        </div>
    </div>
</div>
