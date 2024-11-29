import './bootstrap';

/*--------------------------------------------------- product ----------------------------------------------*/
document.getElementById('btn-add').addEventListener('click', (e) => {
    e.preventDefault()
    document.querySelectorAll('.proErr').forEach(function (p) {
        p.textContent = '';
    });
    const form = document.getElementById('product-form')
    const desc = document.querySelector('#product_desc');
    console.log(desc.value)
    const formData = new FormData(form)
    formData.append('product_desc', desc.value)

    axios.post('/admin/product', formData, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(res => {
        const data = res.data
        console.log(data)
        //window.location.href = '/admin/product'
    }).catch(err => {
        if (err.response && err.response.data.errors) {
            let errors = err.response.data.errors
            for (let field in errors) {
                document.querySelector(`#${field}-error`).textContent = errors[field][0];
            }
        }
    })
})



/*-------------------------------------------------------- delete ---------------------------------------------------------*/



