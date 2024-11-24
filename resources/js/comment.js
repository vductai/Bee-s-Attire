import './bootstrap';
import axios from "axios";



const formComment = document.getElementById('formComment')
if (formComment){
    formComment.addEventListener('submit', function (e) {
        e.preventDefault();
        const userId = document.getElementById('user_id_comment').value
        const comment = document.getElementById('comment')
        const productId = document.getElementById('product_id_comment').value
        document.querySelectorAll('.error-text').forEach(function (e) {
            e.textContent = ''
        })
        axios.post('/comment',{
            user_id: userId,
            comment: comment.value,
            product_id: productId
        },{
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const data = res.data
            const viewComment = document.getElementById('viewComment')
            const commentPost = document.createElement('div')
            const avatar = `${window.location.origin}/upload/${data.user.avatar}`
            // tính toán thời gian
            function timeAgo(date) {
                // lấy second
                const seconds = Math.floor((new Date() - new Date(date)) / 1000) // milions
                const intervals = [
                    { label: 'năm', seconds: 31536000 },
                    { label: 'tháng', seconds: 2592000 },
                    { label: 'ngày', seconds: 86400 },
                    { label: 'giờ', seconds: 3600 },
                    { label: 'phút', seconds: 60 },
                    { label: 'giây', seconds: 1 }
                ]
                for (const interval of intervals){
                    // tính số thời gian trôi qua
                    const count = Math.floor(seconds / interval.seconds)
                    if (count >= 1){
                        return `${count} ${interval.label} trước`;
                    }
                }
                return "Vừa xong";
            }
            const timeAgoText = timeAgo(data.created_at)
            commentPost.innerHTML = `
                <div class="post">
                     <div class="content">
                         <img src="${avatar}" alt="review">
                         <div class="details">
                             <span class="date">${timeAgoText}</span>
                             <span class="name">${data.user.username}</span>
                         </div>
                     </div>
                     <p>${data.comment}</p>
                 </div>
            `
            viewComment.appendChild(commentPost)
            //console.log(data)
        }).catch(err => {
            if (err.response && err.response.data.errors){
                let errors = err.response.data.errors
                for (let field in errors){
                    document.querySelector(`#${field}-error`).textContent = errors[field][0]
                }
            }
        })
        // xoa dữ liệu cũ khi submit
        this.reset();
    })
}

document.addEventListener('DOMContentLoaded', function() {
    Echo.channel('product-comments')
        .listen('CommentEvent', (e) => {
            const data = e; // Nhận dữ liệu trực tiếp từ sự kiện
            const viewComment = document.getElementById('viewComment');
            const commentPost = document.createElement('div');
            const avatar = `${window.location.origin}/upload/${e.user.avatar}`;

            // Hàm tính thời gian
            function timeAgo(date) {
                const seconds = Math.floor((new Date() - new Date(date)) / 1000);
                const intervals = [
                    { label: 'năm', seconds: 31536000 },
                    { label: 'tháng', seconds: 2592000 },
                    { label: 'ngày', seconds: 86400 },
                    { label: 'giờ', seconds: 3600 },
                    { label: 'phút', seconds: 60 },
                    { label: 'giây', seconds: 1 }
                ];
                for (const interval of intervals) {
                    const count = Math.floor(seconds / interval.seconds);
                    if (count >= 1) {
                        return `${count} ${interval.label} trước`;
                    }
                }
                return "Vừa xong";
            }
            const timeAgoText = timeAgo(e.created_at);
            commentPost.innerHTML = `
                <div class="post">
                    <div class="content">
                        <img src="${avatar}" alt="review">
                        <div class="details">
                            <span class="date">${timeAgoText}</span>
                            <span class="name">${e.user.username}</span>
                        </div>
                    </div>
                    <p>${e.comment}</p>
                </div>
            `;
            viewComment.appendChild(commentPost);
        });
});