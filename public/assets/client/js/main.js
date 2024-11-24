document.addEventListener('DOMContentLoaded', function () {
    const searchBox = document.getElementById('search-box');
    const suggestionBox = document.getElementById('suggestion-box');

    searchBox.addEventListener('input', function () {
        const input = searchBox.value;

        // Chỉ hiển thị hoặc ẩn suggestion box dựa trên độ dài input
        if (input.length > 2) {
            suggestionBox.classList.remove('hidden'); // Hiển thị box khi có dữ liệu nhập
        } else {
            suggestionBox.classList.add('hidden'); // Ẩn box khi không có dữ liệu
        }
    });

    document.addEventListener('click', function (e) {
        // Ẩn suggestion box khi click ra ngoài
        if (!suggestionBox.contains(e.target) && !searchBox.contains(e.target)) {
            suggestionBox.classList.add('hidden');
        }
    });
});


(function ($) {
    "use strict";

    $(window).on("load", function () {
        $("#cr-overlay").fadeOut("slow");
    });

    $(document).ready(function () {
        "use strict";
        AOS.init({
            once: true,
        });

        /* Product grid & column */
        $(".gridRow").on("click", function () {
            $(".col-100").addClass("col-size");
            $(".col-50").addClass("col-size");
        });

        $(".gridCol").on("click", function () {
            $(".col-100").removeClass("col-size");
            $(".col-50").removeClass("col-size");
        });

        $(".cr-toggle a").on("click", function () {
            $("a").removeClass("active-grid");
            $(this).addClass("active-grid");
        });

        /* Minus and Plus Quantity */
        $('.minus').on("click", function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });

        $('.plus').on("click", function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });

        /* Onclick Remove Products */
        $(".cr-remove-product").on("click", function () {
            $(this).parent().parent().parent().parent(".cr-product-box").remove();
            var wish_product_count = $(".cr-product-box").length;
            if (wish_product_count == 0) {
                $('.section-wishlist').html('<p class="cr-wishlist-msg">Your wishlist is empty!</p>');
                $('.section-compare').html('<p class="cr-wishlist-msg">Your compare list is empty!</p>');
            }
        });

        /* Stickey headre on scroll &&  Menu Fixed On Scroll Active */
        var doc = document.documentElement;
        var w = window;

        var crPrevScroll = w.scrollY || doc.scrollTop;
        var crCurScroll;
        var crDirection = 0;
        var crPrevDirection = 0;

        var checkScroll = function () {

            crCurScroll = w.scrollY || doc.scrollTop;
            if (crCurScroll > crPrevScroll) {
                //scrolled up
                crDirection = 2;
            } else if (crCurScroll < crPrevScroll) {
                //scrolled down
                crDirection = 1;
            }

            if (crDirection !== crPrevDirection) {
                toggleHeader(crDirection, crCurScroll);
            }

            crPrevScroll = crCurScroll;
        };

        var toggleHeader = function (crDirection, crCurScroll) {

            if (crDirection === 2 && crCurScroll > -46) {
                crPrevDirection = crDirection;
                $("#cr-main-menu-desk").addClass("menu_fixed_up");
            } else if (crDirection === 1) {
                crPrevDirection = crDirection;
                $("#cr-main-menu-desk").addClass("menu_fixed");
                $("#cr-main-menu-desk").removeClass("menu_fixed_up");
            }
        };

        $(window).on("scroll", function () {
            var distance = $('.next, .section-breadcrumb').offset().top,
                $window = $(window);

            if ($window.scrollTop() <= distance + 5) {
                $("#cr-main-menu-desk").removeClass("menu_fixed");
            } else {
                checkScroll();
            }
        });

        /* Service Slider */
        new Swiper('.cr-service-slider', {
            loop: true,
            slidesPerView: 4,
            paginationClickable: true,
            spaceBetween: 24,
            breakpoints: {
                1399: {
                    slidesPerView: 4,
                    spaceBetween: 24
                },
                1028: {
                    slidesPerView: 3,
                    spaceBetween: 24
                },
                480: {
                    slidesPerView: 2,
                    spaceBetween: 24
                },
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10
                }
            }
        });

        /* Popular Slider */
        $('.cr-popular-product').slick({
            infinite: true,
            dots: false,
            arrows: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 4,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });

        /* Blog Slider */
        new Swiper('.cr-blog-slider', {
            loop: true,
            slidesPerView: 3,
            paginationClickable: true,
            spaceBetween: 24,
            breakpoints: {
                1600: {
                    slidesPerView: 4,
                    spaceBetween: 24
                },
                991: {
                    slidesPerView: 3,
                    spaceBetween: 24
                },
                576: {
                    slidesPerView: 2,
                    spaceBetween: 24
                },
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10
                }
            }
        });

        /* Testimonials Slider */
        new Swiper('.cr-testimonial-slider', {
            loop: true,
            slidesPerView: 3,
            paginationClickable: true,
            spaceBetween: 24,
            breakpoints: {
                1028: {
                    slidesPerView: 3,
                    spaceBetween: 24
                },
                576: {
                    slidesPerView: 2,
                    spaceBetween: 24
                },
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10
                }
            }
        });

        /* Banner Slider */
        new Swiper('.cr-banner-slider', {
            loop: true,
            slidesPerView: 2,
            paginationClickable: true,
            spaceBetween: 24,
            autoplay: true,
            breakpoints: {
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 24
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 24
                },
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10
                }
            }
        });

        /* Product Slider */
        $('.cr-twocolumns-product').slick({
            infinite: true,
            dots: false,
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });

        /* tablist-swiper */
        var swiper = new Swiper('.tablist-swiper', {
            direction: 'vertical',
            slidesPerView: 6,
        });

        /* Insta slider  */
        new Swiper('.cr-insta-slider', {
            speed: 500,
            spaceBetween: 12,
            autoplay: false,
            disableOnInteraction: true,
            loop: true,
            slidesPerView: 4,
            allowTouchMove: true,
            centeredSlides: false,
            breakpoints: {
                576: {
                    slidesPerView: 5,
                },
                768: {
                    slidesPerView: 6,
                },
                992: {
                    slidesPerView: 8,
                },
                1200: {
                    slidesPerView: 4,
                },
                1400: {
                    slidesPerView: 5,
                }
            }
        });

    });

    /*--------------------- Wishlist notify js ---------------------- */
    $('.wishlist').on("click", function () {
        $('.cr-wish-notify').remove();
        $('.cr-compare-notify').remove();
        $('.cr-cart-notify').remove();

        var isWishlist = $(this).hasClass("active");
        if (isWishlist) {
            $(this).removeClass("active");
            $('footer').after('<div class="cr-wish-notify"><p class="wish-note">Remove product on <a href="wishlist.html"> Wishlist</a> Successfully!</p></div>');
        } else {
            $(this).addClass("active");
            $('footer').after('<div class="cr-wish-notify"><p class="wish-note">Add product in <a href="wishlist.html"> Wishlist</a> Successfully!</p></div>');
        }

        setTimeout(function () {
            $('.cr-wish-notify').fadeOut();
        }, 2000);
    });

    /*--------------------- Add to cart button notify js ---------------------- */
    $('.cr-shopping-bag').on("click", function () {
        $('.cr-wish-notify').remove();
        $('.cr-compare-notify').remove();
        $('.cr-cart-notify').remove()
        var isAddtocart = $(this).hasClass("active");
        if (isAddtocart) {
            $(this).removeClass("active");
            $('footer').after('<div class="cr-cart-notify"><p class="compare-note">Xoá sản phẩm khỏi yêu thích thành công!</p></div>');
        } else {
            $(this).addClass("active");
            $('footer').after('<div class="cr-cart-notify"><p class="compare-note">Thêm sản phẩm vào yêu thích thành công</p></div>');
        }
        setTimeout(function () {
            $('.cr-cart-notify').fadeOut();
        }, 2000);
    });


    const csrfToken = $('meta[name="csrf-token"]').attr('content');


    /* Slider room details */
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.slider-for',
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 4,
                }
            }
        ]
    });

    /* cart */
    $(".Shopping-toggle").on("click", function (e) {
        e.preventDefault();
        $(".cr-cart-view").addClass("cr-cart-view-active");
        $(".cr-cart-overlay").fadeIn();
    });

    $(".close-cart, .cr-cart-overlay").on("click", function () {
        $(".cr-cart-view").removeClass("cr-cart-view-active");
        $(".cr-cart-overlay").fadeOut();
    });

    /* Banner section ( Home Page ) */
    new Swiper('.cr-slider', {
        loop: true,
        centeredSlides: true,
        speed: 2000,
        effect: 'slide',
        parallax: true,
        autoplay: {
            delay: 10000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });

    /* Product Image Zoom */
    $('.zoom-image-hover').zoom();

    /* Range Slider */
    function formatCurrency(num) {
        num = Number(num) || 0;
        return num.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).replace(/\s₫/, ' đ');
    }

    $(function () {
        $("#slider-range").slider({
            range: true,
            min: lowestPrice,
            max: highestPrice,
            values: [lowestPrice, highestPrice],
            slide: function (event, ui) {
                $("#amount").val(formatCurrency(ui.values[0]) + " - " + formatCurrency(ui.values[1]));
            },
        });
        $("#amount").val(
            formatCurrency($("#slider-range").slider("values", 0)) +
            " - " +
            formatCurrency($("#slider-range").slider("values", 1))
        );
        $(".cr-filter").click(function () {
            var priceRange = $("#amount").val();
            var prices = priceRange.split(" - ");
            var minPrice = prices[0].trim();
            var maxPrice = prices[1].trim();

            axios.get('/filter-price', {
                params: {
                    min_price: minPrice,
                    max_price: maxPrice
                }
            }).then(function (res) {
                const products = res.data;
                console.log(products)
                var html = '';
                function formatCurrency(num) {
                    num = Number(num) || 0;
                    return num.toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).replace(/\s₫/, ' đ'); // Định dạng tiền tệ VN
                }
                if (products.length === 0){
                    html = `<div>
                                    <h3 class="text-center text-danger" style="margin: 380px 0;">Không có sản phẩm nào phù hợp với bộ lọc</h3>
                            </div>`
                }else {
                    products.forEach(data => {
                        const avatar = `${window.location.origin}/upload/${data.product_avatar}`;
                        html += `
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                             <div class="cr-product-card">
                                 <div class="cr-product-image">
                                     <div class="cr-image-inner zoom-image-hover">
                                         <img src="${avatar}" alt="product-1">
                                     </div>
                                 </div>
                                 <div class="cr-product-details">
                                     <div class="cr-brand">
                                         <a href="shop-left-sidebar.html">${data.category.category_name}</a>
                                     </div>
                                     <a href="/detail/${data.slug}" class="title">
                                         ${data.product_name}
                                     </a>
                                     <p class="cr-price">
                                         <span class="new-price">${formatCurrency(data.sale_price)}</span>
                                         <span class="old-price">${formatCurrency(data.product_price)}</span>
                                     </p>
                                 </div>
                             </div>
                        </div>
                    `;
                    })
                }
                document.getElementById('product-results').innerHTML = html
            })
        });
    });

    /* Tab to top */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $(".back-to-top").fadeIn();
        } else {
            $(".back-to-top").fadeOut();
        }
    });

    /* mobaile menu slider */
    $(".navbar-toggler").on("click", function () {
        $(".cr-sidebar-overlay").fadeIn();
        $(".cr-mobile-menu").addClass("cr-menu-open");
    });

    $(".cr-sidebar-overlay, .cr-close").on("click", function () {
        $(".cr-sidebar-overlay").fadeOut();
        $(".cr-mobile-menu").removeClass("cr-menu-open");
    });

    $(".drop-list > a").on("click", function () {
        $(".sub-menu").slideUp(600);
        if (
            $(this)
                .parent()
                .hasClass("active")
        ) {
            $(".drop-list").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(".drop-list").removeClass("active");
            $(this)
                .next(".sub-menu")
                .slideDown(600);
            $(this)
                .parent()
                .addClass("active");
        }
    });

    /* Footer Toggle  */
    $(document).ready(function () {
        $(".cr-footer-links").addClass("active-drop-footer");

        $('.cr-sub-title').append("<div class='cr-heading-res'><i class='ri-arrow-down-s-line' aria-hidden='true'></i></div>");

        $(".cr-sub-title .cr-heading-res").on("click", function () {
            var $this = $(this).closest('.footer-top .col-sm-12').find('.cr-footer-dropdown');
            $this.slideToggle('slow');
            $('.cr-footer-dropdown').not($this).slideUp('slow');
        });
    });

    /* Product kg */
    $(".cr-kg ul li").on("click", function () {
        $("ul li").removeClass("active-color");
        $(this).addClass("active-color");
    });

    $(".cl-kg ul li").on("click", function () {
        $("ul li").removeClass("cl-active-color");
        $(this).addClass("cl-active-color");
    });

    /* Counter */
    $('.elementor-counter-number').each(function () {
        var size = $(this).text().split(".")[1] ? $(this).text().split(".")[1].length : 0;
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            step: function (func) {
                $(this).text(parseFloat(func).toFixed(size));
            }
        });
    });

    /* Deal */
    function makeTimer() {
        var endTime = new Date("29 December 2024 9:56:00 GMT+01:00");
        endTime = (Date.parse(endTime) / 1000);
        var now = new Date();
        now = (Date.parse(now) / 1000);
        var timeLeft = endTime - now;
        var days = Math.floor(timeLeft / 86400);
        var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
        var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
        var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
        if (hours < "10") {
            hours = "0" + hours;
        }
        if (minutes < "10") {
            minutes = "0" + minutes;
        }
        if (seconds < "10") {
            seconds = "0" + seconds;
        }
        $("#days").html(days);
        $("#hours").html(hours);
        $("#minutes").html(minutes);
        $("#seconds").html(seconds);
    };
    setInterval(function () {
        makeTimer();
    }, 1000);

    /* Products-page model */
    $(".model-oraganic-product").on("click", function () {
        $(".cr-model-overlay").fadeIn();
        $(".cr-model").fadeIn();
    });

    $(".cr-close-model, .cr-model-overlay").on("click", function () {
        $(".cr-model-overlay").fadeOut();
        $(".cr-model").fadeOut();
    });

    /* Shop-side-view */
    $(".shop_side_view").on("click", function (e) {
        e.preventDefault();
        $(".cr-shop-leftside").addClass("cr-shop-leftside-active");
        $(".filter-sidebar-overlay").fadeIn();
    });

    $(".filter-sidebar-overlay, .close-shop-leftside").on("click", function () {
        $(".cr-shop-leftside").removeClass("cr-shop-leftside-active");
        $(".filter-sidebar-overlay").fadeOut();
    });

    /* Potfolio */
    $(".cr-product-tabs ul li").on("click", function () {
        $("ul li").removeClass("active");
        $(this).addClass("active");
    });

    /* Potfolio for Mixit up */
    var portfolioContent = $(".product-content");
    portfolioContent.mixItUp();

    var show = $(".mixshow");
    show.mixItUp()

    /* Footer year */
    var date = new Date().getFullYear();

    document.getElementById("copyright_year").innerHTML = date;

    /* Back to top button progress */
    var progressPath = document.querySelector('.back-to-top-wrap path');
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
    progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
    var updateProgress = function () {
        var scroll = $(window).scrollTop();
        var height = $(document).height() - $(window).height();
        var progress = pathLength - (scroll * pathLength / height);
        progressPath.style.strokeDashoffset = progress;
    }
    updateProgress();
    $(window).scroll(updateProgress);
    var offset = 50;
    var duration = 550;
    jQuery(window).on('scroll', function () {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top-wrap').addClass('active-progress');
        } else {
            jQuery('.back-to-top-wrap').removeClass('active-progress');
        }
    });
    jQuery('.back-to-top-wrap').on('click', function (event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })

    /* Sidebar Tools */
    $(".btn-cr-tool").on("click", function (e) {
        e.preventDefault();
        $(".cr-tool").addClass("cr-tool-active");
        $(".cr-tool-overlay").fadeIn();
        $(".btn-cr-tool").fadeOut();
    });

    $(".close-tools, .cr-tool-overlay").on("click", function () {
        $(".cr-tool").removeClass("cr-tool-active");
        $(".cr-tool-overlay").fadeOut();
        $(".btn-cr-tool").fadeIn();
    });

    $(".cr-color li").on("click", function () {
        $("li").removeClass("active-colors");
        $(this).addClass("active-colors");
    });

    /* color show */
    $(".c1").on("click", function () {
        $("#add_class").remove();
    });
    $(".c2").on("click", function () {
        $("#add_class").remove();
        $("head").append(
            '<link rel="stylesheet" href="assets/css/color-1.css" id="add_class">'
        );
    });
    $(".c3").on("click", function () {
        $("#add_class").remove();
        $("head").append(
            '<link rel="stylesheet" href="assets/css/color-2.css" id="add_class">'
        );
    });
    $(".c4").on("click", function () {
        $("#add_class").remove();
        $("head").append(
            '<link rel="stylesheet" href="assets/css/color-3.css" id="add_class">'
        );
    });
    $(".c5").on("click", function () {
        $("#add_class").remove();
        $("head").append(
            '<link rel="stylesheet" href="assets/css/color-4.css" id="add_class">'
        );
    });
    $(".c6").on("click", function () {
        $("#add_class").remove();
        $("head").append(
            '<link rel="stylesheet" href="assets/css/color-5.css" id="add_class">'
        );
    });
    $(".c7").on("click", function () {
        $("#add_class").remove();
        $("head").append(
            '<link rel="stylesheet" href="assets/css/color-6.css" id="add_class">'
        );
    });
    $(".c8").on("click", function () {
        $("#add_class").remove();
        $("head").append(
            '<link rel="stylesheet" href="assets/css/color-7.css" id="add_class">'
        );
    });
    $(".c9").on("click", function () {
        $("#add_class").remove();
        $("head").append(
            '<link rel="stylesheet" href="assets/css/color-8.css" id="add_class">'
        );
    });
    $(".c10").on("click", function () {
        $("#add_class").remove();
        $("head").append(
            '<link rel="stylesheet" href="assets/css/color-9.css" id="add_class">'
        );
    });

    /* dark-mode */
    $(".dark-mode li").on("click", function () {
        $("li").removeClass("active-dark-mode");
        $(this).addClass("active-dark-mode");
    });

    $(".dark").on("click", function () {
        $("#add_dark_mode").remove();
        $("head").append('<link rel="stylesheet" class="dark-link-mode" href="assets/css/dark.css" id="add_dark_mode">');
    });
    $(".white").on("click", function () {
        $("#add_dark_mode").remove();
    });

    /* bg */
    $(".bg-panel li").on("click", function () {
        $("li").removeClass("active-bg-panel");
        $(this).addClass("active-bg-panel");
    });

    $(".bg-1").on("click", function () {
        $("#add_bg").remove();
        $("body").addClass('body-bg-1').removeClass();
        $("head").append('<link rel="stylesheet" class="bg" href="assets/css/bg-1.css" id="add_bg">');
        $("body").addClass('body-bg-1');
    });

    $(".bg-2").on("click", function () {
        $("#add_bg").remove();
        $("body").addClass('body-bg-2').removeClass();
        $("head").append('<link rel="stylesheet" class="bg" href="assets/css/bg-2.css" id="add_bg">');
        $("body").addClass('body-bg-2');
    });

    $(".bg-3").on("click", function () {
        $("#add_bg").remove();
        $("body").addClass('body-bg-3').removeClass();
        $("head").append('<link rel="stylesheet" class="bg" href="assets/css/bg-3.css" id="add_bg">');
        $("body").addClass('body-bg-3');
    });

    $(".bg-4").on("click", function () {
        $("#add_bg").remove();
        $("body").addClass('body-bg-4').removeClass();
        $("head").append('<link rel="stylesheet" class="bg" href="assets/css/bg-4.css" id="add_bg">');
        $("body").addClass('body-bg-4');
    });

    $(".bg-5").on("click", function () {
        $("#add_bg").remove();
        $("body").addClass('body-bg-5').removeClass();
        $("head").append('<link rel="stylesheet" class="bg" href="assets/css/bg-5.css" id="add_bg">');
        $("body").addClass('body-bg-5');
    });

    $(".bg-6").on("click", function () {
        $("body").addClass('body-bg-6').removeClass();
        $("#add_bg").remove();
    });

})(jQuery);