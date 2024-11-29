import './bootstrap';
const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')

Echo.channel(`noti-post.${userId}`)
    .listen('NotiPostEvent', function (e) {
        const data = e.post
        const viewNoti = document.getElementById('noti-header-view')
        document.getElementById('notis-badge').style.display = 'inline'
        const nutiNull = document.getElementById('noti-null')
        if (nutiNull) {
            nutiNull.style.display = 'none'
        }
        const createNoti = document.createElement('li')
        createNoti.innerHTML = `
            <li>
                 <a class="dropdown-item"
                    href="/notification">
                         <span class="badge text-bg-danger">Mới</span>
                     ${data.message}
                 </a>
            </li>
        `
        viewNoti.appendChild(createNoti)
    })
