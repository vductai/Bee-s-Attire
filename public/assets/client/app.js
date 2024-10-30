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
                    price: totalprice * quantity,
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

/*----------------------------------------------------- voucher counpon ----------------------------------------*/

function selectUsername() {
    const userSel = document.getElementById('user-select')
    const selectedUsernames = Array.from(userSel.selectedOptions)
        .map(option => option.getAttribute("data-username"));
    document.getElementById("selected_usernames").value = selectedUsernames.join(", ")
}
