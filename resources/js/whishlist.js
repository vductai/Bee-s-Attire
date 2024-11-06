import './bootstrap'
import axios from "axios";

const buttonBags = document.querySelectorAll('.cr-shopping-bag')
const userBag = document.getElementById('userBag')
if (buttonBags){
    buttonBags.forEach(buttonBag => {
        buttonBag.addEventListener('click', function (e) {
            e.preventDefault()
            const productId = buttonBag.dataset.productid;
            const isActive = buttonBag.classList.contains('active'); // định nghĩa biến
            axios.post('/whishlist', {
                product_id: productId,
                user_id: userBag.value,
                action: isActive ? 'add' : 'remove'
            }, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => {
                const data = res.data
                if (data.success){
                    if (isActive){
                        buttonBag.classList.add('active')
                    }else {
                        buttonBag.classList.remove('active')
                    }
                }

            })
        })
    });
}

// delete
const buttonDeleteBags = document.querySelectorAll('.cr-remove-product')
const userBagDel = document.getElementById('userBagDel')
if (buttonDeleteBags){
    buttonDeleteBags.forEach(buttonDeleteBag => {
        buttonDeleteBag.addEventListener('click', function (e) {
            e.preventDefault()
            const whishlistId = buttonDeleteBag.dataset.wishlistid
            axios.delete(`/whishlist/${whishlistId}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
        })
    })
}
