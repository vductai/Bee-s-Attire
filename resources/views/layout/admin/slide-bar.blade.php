<div class="cr-sb-content">
    <ul class="cr-sb-list">
        <li class="cr-sb-item sb-drop-item">
            <a href="javascript:void(0)" class="cr-drop-toggle">
                <i class="ri-dashboard-3-line"></i><span class="condense">Tổng quan<i
                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
            <ul class="cr-sb-drop condense">
                <li>
                    <a href="{{route('dashboard')}}" class="cr-page-link drop">
                        <i class="ri-bar-chart-2-line"></i>Thống kê</a>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-product-hunt-line"></i></i><span class="condense">Sản phẩm<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{route('product.index')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Danh sách</a></li>
                        <li><a href="{{route('product.create')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Thêm sản phẩm</a></li>
                    </ul>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-copyright-line"></i></i><span class="condense">Danh mục<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{route('category-parent.create')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Danh mục chính</a></li>
                        <li><a href="{{route('categories.create')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Danh mục phụ</a></li>
                    </ul>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-remixicon-line"></i></i><span class="condense">Biến thể<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{route('product-variant.index')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Danh sách</a></li>
                        <li><a href="{{route('color.create')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Màu sắc</a></li>
                        <li><a href="{{route('size.create')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Kích thước</a></li>
                    </ul>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-ticket-line"></i></i><span class="condense">Mã giảm giá<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{route('coupon.index')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Kho mã giảm giá</a></li>
                        <li><a href="{{route('add-form-coupon-user')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Tạo mã cho người dùng</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="cr-sb-item-separator"></li>
        <li class="cr-sb-item sb-drop-item">
            <a href="javascript:void(0)" class="cr-drop-toggle">
                <i class="ri-shield-keyhole-line"></i><span class="condense">Xác thực<i
                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
            <ul class="cr-sb-drop condense">
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-user-line"></i></i><span class="condense">Người dùng<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{route('user.index')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Danh sách người</a></li>
                        <li><a href="{{route('user.create')}}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Tạo mới người dùng</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="cr-sb-item-separator"></li>
        <li class="cr-sb-item sb-drop-item">
            <a href="javascript:void(0)" class="cr-drop-toggle">
                <i class="ri-shopping-bag-3-line"></i><span class="condense">Đơn hàng<i
                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
            <ul class="cr-sb-drop condense">
                <li><a href="{{route('admin-list-order')}}" class="cr-page-link subdrop"><i
                            class="ri-checkbox-blank-circle-line"></i>Danh sách đơn hàng</a></li>
            </ul>
        </li>
        <li class="cr-sb-item-separator"></li>
        <li class="cr-sb-item sb-drop-item">
            <a href="javascript:void(0)" class="cr-drop-toggle">
                <i class="ri-article-line"></i><span class="condense">Bài viết<i
                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
            <ul class="cr-sb-drop condense">
                <li><a href="{{route('post.index')}}" class="cr-page-link subdrop"><i
                            class="ri-checkbox-blank-circle-line"></i>Danh sách bài viết</a></li>
                <li><a href="{{route('post.create')}}" class="cr-page-link subdrop"><i
                            class="ri-checkbox-blank-circle-line"></i>Tạo bài viết</a></li>
            </ul>
        </li>
        <li class="cr-sb-item-separator"></li>
        <li class="cr-sb-item sb-drop-item">
            <a href="javascript:void(0)" class="cr-drop-toggle">
                <i class="ri-article-line"></i><span class="condense">Tin nhắn đến<i
                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
            <ul class="cr-sb-drop condense">
                <li><a href="{{route('get-contact')}}" class="cr-page-link subdrop"><i
                            class="ri-checkbox-blank-circle-line"></i>Danh sách tin nhắn</a></li>
            </ul>
        </li>
    </ul>
</div>
