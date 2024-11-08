/*--------------------------- copy voucher --------------------------*/

const voucherCodes = document.querySelectorAll('.use-btn')
voucherCodes.forEach(codes => {
    codes.addEventListener('click', function (e) {
        e.preventDefault()
        const code = codes.dataset.copys
        navigator.clipboard.writeText(code).then(function () {
            codes.style.backgroundColor = '#0f5132'
            codes.innerHTML = '<i class="ri-check-line"></i>'
            setTimeout(function () {
                codes.style.backgroundColor = ''
                codes.innerHTML = 'Copy code'
            }, 2000)
        })
    })
})

/*--------------------------- check payment method --------------------------*/
// Lấy tất cả các input radio
const paymentOptions = document.querySelectorAll('input[name="radio-group"]');
const submitButton = document.getElementById('submitButton');

// Gắn sự kiện 'change' cho mỗi radio button
paymentOptions.forEach(option => {
    option.addEventListener('change', function () {
        submitButton.name = this.value;
    });
});

/*--------------------------- check variant product --------------------------*/
document.addEventListener('DOMContentLoaded', function () {
    const sizeOptions = document.querySelectorAll('.size-option');
    const hiddenInputSize = document.getElementById('selected-size-id');
    const colorOptions = document.querySelectorAll('.color-option');
    const hiddenInputColor = document.getElementById('selected-color-id');
    const hiddenInputVariant = document.getElementById('selected-product-variant-id');

    let selectedSizeId = null;
    let selectedColorId = null;

    sizeOptions.forEach(option => {
        option.addEventListener('click', function () {
            sizeOptions.forEach(opt => opt.classList.remove('active-color'));
            this.classList.add('active-color');
            // Gán giá trị cho selectedSizeId
            selectedSizeId = this.getAttribute('data-size-id');
            hiddenInputSize.value = selectedSizeId;
            console.log(selectedSizeId)
            updateProductVariant();
            filterColorsByStock();
        });
    });

    colorOptions.forEach(option => {
        option.addEventListener('click', function () {
            colorOptions.forEach(opt => opt.classList.remove('cl-active-color'));
            this.classList.add('cl-active-color');
            // Gán giá trị cho selectedColorId
            selectedColorId = this.getAttribute('data-color-id');
            hiddenInputColor.value = selectedColorId;
            updateProductVariant();
        });
    });

    function updateProductVariant() {
        if (selectedSizeId && selectedColorId) {
            const selectedVariant = variants.find(variant =>
                variant.size_id == selectedSizeId && variant.color_id == selectedColorId
            );
            if (selectedVariant) {
                hiddenInputVariant.value = selectedVariant.product_variant_id;
            }
        }
    }
    function filterColorsByStock() {
        colorOptions.forEach(option => {
            const colorId = option.getAttribute('data-color-id');
            const matchingVariant = variants.find(variant =>
                variant.size_id == selectedSizeId && variant.color_id == colorId
            );

            if (matchingVariant && matchingVariant.quantity > 0) {
                option.style.display = 'inline-block'; // Hiển thị màu nếu còn hàng
            } else {
                option.style.display = 'none'; // Ẩn màu nếu hết hàng
            }
        });
    }

    function filterSizesByStock() {

        sizeOptions.forEach(option => {
            const sizeId = option.getAttribute('data-size-id');
            const matchingVariant = variants.find(variant =>
                variant.color_id == selectedColorId && variant.size_id == sizeId
            );

            if (matchingVariant && matchingVariant.quantity > 0) {
                option.style.display = 'none'; // Hiển thị size nếu còn hàng
            } else {
                selectedSizeId.style.display = 'none';
                option.style.display = 'inline-block'; // Ẩn size nếu hết hàng
            }
        });
    }
});

/*--------------------------- update cart --------------------------*/
document.addEventListener('DOMContentLoaded', function () {
    const plusButtons = document.querySelectorAll('.pluss');
    const minusButtons = document.querySelectorAll('.minuss');
    const quantityInputs = document.querySelectorAll('.quantityy');
    const productPrices = document.querySelectorAll('.product_price');
    const totals = document.querySelectorAll('.total');


    // Hàm chuyển đổi chuỗi có dấu phẩy (định dạng tiền tệ) về số thập phân
    function parseCurrency(str) {
        return parseFloat(str.replace(/[^0-9.-]+/g, '')); // Loại bỏ ký tự không phải số và chuyển về số thập phân
    }

    // Hàm định dạng số thành tiền tệ
    function formatCurrency(num) {
        return num.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).replace(/\s₫/, ' đ'); // Định dạng tiền tệ VN
    }

    // Hàm cập nhật tổng giá cho một hàng sản phẩm
    function updateTotal(index) {
        const quantity = parseInt(quantityInputs[index].value);
        const productPrice = parseCurrency(productPrices[index].textContent); // Chuyển đổi giá trị thành số
        const total = quantity * productPrice;
        totals[index].textContent = formatCurrency(total); // Hiển thị giá trị với định dạng tiền tệ Việt Nam
    }

    // Sự kiện khi nhấn nút cộng
    plusButtons.forEach((plusButton, index) => {
        plusButton.addEventListener('click', function () {
            let currentQuantity = parseInt(quantityInputs[index].value);
            currentQuantity += 1; // Tăng số lượng lên 1
            quantityInputs[index].value = currentQuantity;
            updateTotal(index); // Cập nhật lại tổng giá
        });
    });

    // Sự kiện khi nhấn nút trừ
    minusButtons.forEach((minusButton, index) => {
        minusButton.addEventListener('click', function () {
            let currentQuantity = parseInt(quantityInputs[index].value);
            if (currentQuantity > 1) {
                currentQuantity -= 1; // Giảm số lượng đi 1
                quantityInputs[index].value = currentQuantity;
                updateTotal(index); // Cập nhật lại tổng giá
            }
        });
    });

    // Cập nhật tổng giá khi số lượng thay đổi trực tiếp
    quantityInputs.forEach((quantityInput, index) => {
        quantityInput.addEventListener('input', function () {
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity >= 1) {
                updateTotal(index); // Chỉ cập nhật nếu số lượng lớn hơn hoặc bằng 1
            }
        });
    });

    // update cart
    const checkoutButton = document.querySelector('.checkout')
    checkoutButton.addEventListener('click', function (e) {
        e.preventDefault()
        const cartItems = [];

        // lấy dữ liệu cart
        document.querySelectorAll('tbody tr').forEach((row, index) => {
            const productLink = row.querySelector('a');
            if (productLink) {
                const productId = row.querySelector('a').getAttribute('data-idPro').split('/').pop()
                const quantity = parseInt(row.querySelector('.quantityy').value)
                const totalprice = row.querySelector('.cr-cart-price').getAttribute('data-total')
                cartItems.push({
                    product_id: parseInt(productId),
                    quantity: quantity,
                    price: totalprice * quantity
                })
            }
        })

        if (cartItems.length > 0) {
            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({cartItems})
            })
        .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        window.location.href = "/checkout"
                    }else {
                        alert('error chuyen huong')
                    }
                }).catch(err => {
                    alert('cart faild')
                })
        }
    })
});

/*----------------------------------------------------- filter ----------------------------------------------*/
// lấy tất cả checkbox trong danh mục
document.querySelectorAll('.cr-checkbox input[type="checkbox"]').forEach(checkbox => {
    // thêm sự kiện mỗi thuộc tính
    checkbox.addEventListener('change', () => {
        // array.form: chuyển đổi thành mảng thật
        const selectedCategories = Array.from(document.querySelectorAll('.cr-shop-categories input[type="checkbox"]:checked'))
            .map(el => el.id); // lưu id được chọn
        const selectedColors = Array.from(document.querySelectorAll('.cr-shop-color input[type="checkbox"]:checked'))
            .map(el => el.id); // lưu id được chọn
        const selectedSizes = Array.from(document.querySelectorAll('.cr-shop-weight input[type="checkbox"]:checked'))
            .map(el => el.id); // lưu id được chọn

        console.log("Categories:", selectedCategories);
        console.log("Colors:", selectedColors);
        console.log("Sizes:", selectedSizes);

        axios.post('/search-product', {
            categories: selectedCategories,
            colors: selectedColors,
            sizes: selectedSizes
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const data = res.data
            let products = data.products;
            console.log(products)
            // Chuyển đổi `products` thành mảng nếu nó là đối tượng
            if (!Array.isArray(products)){
                products = Object.values(products)
            }
            let html = '';
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
                products.forEach(productData => {
                    const avatar = `${window.location.origin}/upload/${productData.product_avatar}`;
                    html +=
                        `
                                <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                                    <div class="cr-product-card">
                                        <div class="cr-product-image">
                                            <div class="cr-image-inner zoom-image-hover">
                                                <img src="${avatar}" alt="product-1">
                                            </div>
                                        </div>
                                        <div class="cr-product-details">
                                            <div class="cr-brand">
                                                <a href="shop-left-sidebar.html">${productData.category.category_name}</a>
                                            </div>
                                            <a href="/detail/${productData.slug}" class="title">
                                                ${productData.product_name}
                                            </a>
                                            <p class="cr-price">
                                                <span class="new-price">${formatCurrency(productData.sale_price)}</span>
                                                <span class="old-price">${formatCurrency(productData.product_price)}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            `
                })
            }
            document.getElementById('product-results').innerHTML = html
        }).catch(error => {
            console.error('Có lỗi xảy ra:', error);
        });
    })
})

/*-------------------------------------------------------- change password profile -------------------------------------------*/

const formchangePassword = document.getElementById('formchangePassword')
const changePassword = document.getElementById('changePassword')
const confirmPassword = document.getElementById('confirmPassword')
if (formchangePassword) {
    formchangePassword.addEventListener('submit', function (e) {
        e.preventDefault()
        document.querySelectorAll('.error-text').forEach(function (e) {
            e.textContent = ''
        })
        axios.put('/changePassword', {
            changePassword: changePassword.value,
            confirmPassword: confirmPassword.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).catch(err => {
            if (err.response && err.response.data.errors){
                let errors = err.response.data.errors
                for (let field in errors){
                    document.querySelector(`#${field}-error`).textContent = errors[field][0]
                }
            }
        })
        this.reset();
    })
}
