import './bootstrap'

const contactForm = document.getElementById('form-contact')
if (contactForm){
    contactForm.addEventListener('submit', function (e) {
        e.preventDefault()
        const name = document.getElementById('name').value
        const phone = document.getElementById('phone').value
        const email = document.getElementById('email').value
        const content = document.getElementById('content').value
        document.querySelectorAll('.contact-err').forEach(c => {
            c.textContent = ''
        })
        axios.post('/contact-post',{
            name: name,
            email: email,
            phone: phone,
            content: content,
        },{
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            Swal.fire({
                title: "Gửi thành công",
                text: "Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi lại trong thời gian sớm nhất.",
                icon: "success"
            });
            this.reset()
        }).catch(err => {
            if (err.response && err.response.data.errors) {
                let errors = err.response.data.errors
                for (let field in errors) {
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        })
    })
}
