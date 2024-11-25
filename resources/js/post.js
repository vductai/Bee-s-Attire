import './bootstrap';
import axios from "axios";
const formPost = document.getElementById('formPost')
if (formPost){
    formPost.addEventListener('submit', function (e) {
        e.preventDefault()
        document.querySelectorAll('.errpost').forEach(e => {
            e.textContent = ''
        })
        const title = document.querySelector('.title')
        const avatar = document.getElementById('avatar')
        const desc = document.getElementById('desc')
        const slug = document.querySelector('.slg')
        const content = document.getElementById('editor1')
        const createPost = new FormData()
        createPost.append('title', title.value)
        createPost.append('avatar', avatar.files[0])
        createPost.append('desc', desc.value)
        createPost.append('slug', slug.value)
        createPost.append('content', content.value)

        axios.post('/admin/post', createPost,{
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const data = res.data
            console.log(data)
            window.location.href = '/admin/post'
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

/*------------------------------------------------------- update ------------------------------------------------------------------*/
const formPostUpdate = document.getElementById('formPostUpdate')
if (formPostUpdate){
    formPostUpdate.addEventListener('submit', function (e) {
        e.preventDefault()
        document.querySelectorAll('.errpost').forEach(e => {
            e.textContent = ''
        })
        const id = document.getElementById('idPost').value
        const titleUpdate = document.querySelector('.title')
        const avatarUpdate = document.getElementById('avatar')
        const descUpdate = document.getElementById('desc')
        const slugUpdate = document.querySelector('.slg')
        const contentUpdate = document.getElementById('editor1')
        const updatePost = new FormData()
        updatePost.append('title', titleUpdate.value)
        updatePost.append('avatar', avatarUpdate.files[0])
        updatePost.append('desc', descUpdate.value)
        updatePost.append('slug', slugUpdate.value)
        updatePost.append('content', contentUpdate.value)
        updatePost.append('_method', 'PUT')


        axios.post(`/admin/post/${id}`, updatePost,{
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'multipart/form-data'
            }
        }).then(res => {
            const data = res.data
            window.location.href = '/admin/post'
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


/*------------------------------------------------------ delete ---------------------------------------------------------*/
const tablePost = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0]
tablePost.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-post')){
        const postId = e.target.getAttribute('data-id')
        axios.delete(`/admin/post/${postId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            const row = document.querySelector(`tr[data-id='${postId}']`)
            if (row){
                row.remove()
            }
        })
    }
})

/*------------------------------------------------------- toggle -----------------------------------------------------------*/

