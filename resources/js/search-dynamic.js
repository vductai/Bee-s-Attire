import './bootstrap'


let timeout;
document.getElementById('key').addEventListener('input', function () {
    clearTimeout(timeout)
    timeout = setTimeout(() => {
        const searchValue = this.value;
        fetch(`/search-dynamic?key=${searchValue}`);
    }, 300)
})
document.addEventListener('DOMContentLoaded', () => {
    Echo.channel('search-dynamic')
        .listen('SearchDynamicEvent', function (e) {
            console.log(e.serults)
        })
})

