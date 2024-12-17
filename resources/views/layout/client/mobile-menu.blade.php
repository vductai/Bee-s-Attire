<!-- Mobile menu -->
<div class="cr-sidebar-overlay"></div>
<div id="cr_mobile_menu" class="cr-side-cart cr-mobile-menu">
    <div class="cr-menu-title">
        <span class="menu-title">Menu</span>
        <button type="button" class="cr-close">×</button>
    </div>
    <div class="cr-menu-inner">
        <div class="cr-menu-content">
            <ul>
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
                <li class="drop-list dropdown">
                    <span class="menu-toggle"></span>
                    <a href="javascript:void(0)" class="dropdown-list">Hỗ trợ</a>
                    <ul class="sub-menu">
                        <li>
                            <a class="dropdown-item" href="{{route('contact')}}">Liên hệ với chúng tôi</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('return')}}">Chính sách đổi trả</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('policy')}}">Chính sách bảo mật</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
