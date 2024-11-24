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
                    @if(auth()->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle cr-right-bar-item" href="javascript:void(0)">
                                <i class="ri-user-3-line"></i>
                                <span>Xin chào, {{auth()->user()->username}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{route('profile')}}">Hồ sơ</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('checkout')}}">Thanh toán</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('get-all-order')}}">Đơn hàng của bạn</a>
                                </li>
                                <li>
                                    <form action="{{ route('client.logout') }}" method="POST" style="display: none;" id="logout-form">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle cr-right-bar-item" href="javascript:void(0)">
                                <i class="ri-user-3-line"></i>
                                <span>Tài khoản</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{route('client.viewRegister')}}">Đăng kí</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('client-viewLogin')}}">Đăng nhập</a>
                                </li>
                            </ul>
                        </li>
                    @endif
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
                            Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('product')}}">
                            Cửa hàng
                        </a>
                    </li>
                    @foreach($parent as $item)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('parent', ['slug' => $item->slug])}}">
                                {{$item->name}}
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a href="{{route('list-article')}}" class="nav-link">
                            Tin tức
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="cr-calling">
            {{--<i class="ri-phone-line"></i>
            <a href="javascript:void(0)">+123 ( 456 ) ( 7890 )</a>--}}
        </div>
    </div>
</div>