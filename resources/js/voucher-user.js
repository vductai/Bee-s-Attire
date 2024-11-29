import './bootstrap'

document.getElementById('add-coupon-form').addEventListener('submit', function (e) {
    e.preventDefault()
    const userName = Array.from(document.getElementById('user-select').selectedOptions).map(option => option.value)
    const voucherId = document.getElementById('voucher_id').value
    const endDate = document.getElementById('end_date').value

    document.querySelectorAll('.ers').forEach(e => {
        e.textContent = ''
    })
    axios.post('/admin/coupon-user',{
        user_id: userName,
        voucher_id: voucherId,
        end_date: endDate
    },{
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(res => {
        if (res.data.success === false){
            document.getElementById('endere').textContent = res.data.message
        }else {
            window.location.reload();
        }
    }).catch(err => {
        if (err.response && err.response.data.errors) {
            let errors = err.response.data.errors
            for (let field in errors) {
                document.querySelector(`#${field}-error`).textContent = errors[field][0];
            }
        }
    })
})
