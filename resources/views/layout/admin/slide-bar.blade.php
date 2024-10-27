<div class="cr-sb-content">
    <ul class="cr-sb-list">
        <li class="cr-sb-item sb-drop-item">
            <a href="javascript:void(0)" class="cr-drop-toggle">
                <i class="ri-dashboard-3-line"></i><span class="condense">Dashboard<i
                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
            <ul class="cr-sb-drop condense">
                <li>
                    <a href="{{ route('dashboard') }}" class="cr-page-link drop">
                        <i class="ri-bar-chart-2-line"></i>Statistical</a>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-product-hunt-line"></i></i><span class="condense">Product<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{ route('product.index') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>List Product</a></li>
                        <li><a href="{{ route('product.create') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Add Product</a></li>
                    </ul>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-copyright-line"></i></i><span class="condense">Category<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{ route('categories.index') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>List category</a></li>
                        <li><a href="{{ route('categories.create') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Create category</a></li>
                    </ul>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-remixicon-line"></i></i><span class="condense">Variant<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{ route('product-variant.index') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>List variant</a></li>
                    </ul>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-palette-line"></i></i><span class="condense">Color<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{ route('color.index') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>List color</a></li>
                        <li><a href="{{ route('color.create') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Create color</a></li>
                    </ul>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-font-size-2"></i></i><span class="condense">Size<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{ route('size.index') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>List size</a></li>
                        <li><a href="{{ route('size.create') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Create size</a></li>
                    </ul>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-ticket-line"></i></i><span class="condense">Voucher<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{ route('add-form-coupon-user') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Create user coupon</a></li>
                        <li><a href="{{ route('coupon.index') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Create voucher</a></li>
                    </ul>
                </li>
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="{{ route('policies.index', ['id'=>1]) }}" class="cr-sub-drop-toggle">
                        <i class="ri-ticket-line"></i></i><span class="condense">Policy<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{ route('policies.create') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Create Policy</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="cr-sb-item-separator"></li>
        <li class="cr-sb-item sb-drop-item">
            <a href="javascript:void(0)" class="cr-drop-toggle">
                <i class="ri-shield-keyhole-line"></i><span class="condense">Authentication<i
                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
            <ul class="cr-sb-drop condense">
                <li class="cr-sb-item sb-subdrop-item">
                    <a href="javascript:void(0)" class="cr-sub-drop-toggle">
                        <i class="ri-user-line"></i></i><span class="condense">User<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="cr-sb-subdrop condense">
                        <li><a href="{{ route('user.index') }}" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>List User</a></li>
                        <li><a href="" class="cr-page-link subdrop"><i
                                    class="ri-checkbox-blank-circle-line"></i>Add User</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="cr-sb-item-separator"></li>
        <li class="cr-sb-item sb-drop-item">
            <a href="javascript:void(0)" class="cr-drop-toggle">
                <i class="ri-shopping-bag-3-line"></i><span class="condense">Order<i
                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
            <ul class="cr-sb-drop condense">
                <li><a href="{{ route('admin-list-order') }}" class="cr-page-link subdrop"><i
                            class="ri-checkbox-blank-circle-line"></i>List Order</a></li>
            </ul>
        </li>
    </ul>
</div>
