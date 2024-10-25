<div class="container">
    <div class="cr-menu-list">
        <div class="cr-category-icon-block">
        </div>
        <nav class="navbar navbar-expand-lg">
            <a href="javascript:void(0)" class="navbar-toggler shadow-none">
                <i class="ri-menu-3-line"></i>
            </a>
            <div class="cr-header-buttons">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="javascript:void(0)">
                            <i class="ri-user-3-line"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{route('client.viewRegister')}}">Register</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('checkout')}}">Checkout</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('client.viewLogin')}}">Login</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                {{--<a href="wishlist.html" class="cr-right-bar-item">
                    <i class="ri-heart-line"></i>
                </a>--}}
                <a href="javascript:void(0)" class="cr-right-bar-item Shopping-toggle">
                    <i class="ri-shopping-cart-line"></i>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('product')}}">
                            Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">
                            About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contact')}}">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="cr-calling">
            <i class="ri-phone-line"></i>
            <a href="javascript:void(0)">+123 ( 456 ) ( 7890 )</a>
        </div>
    </div>
</div>
