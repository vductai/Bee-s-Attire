import './bootstrap';

const formRep = document.getElementById('form-rep-contact')
if (formRep){
    formRep.addEventListener('submit', function (e) {
        e.preventDefault()
        const name = document.getElementById('name').value
        const email = document.getElementById('email').value
        const id = document.getElementById('id').value
        const content = document.getElementById('content').value
        const repContact = document.getElementById('repContact').value
        axios.post('/admin/rep',{
            name: name,
            email: email,
            content: content,
            id: id,
            repContact: repContact
        },{
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            window.location.href = '/admin/message'
        })
    })
}
