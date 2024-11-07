<form class="cr-search">
    <input class="search-input"
           id="search-box" autocomplete="off"
           type="text" placeholder="Search For items...">
    <a href="javascript:void(0)" class="search-btn">
        <i class="ri-search-line"></i>
    </a>

    <div id="suggestion-box" class="suggestions hidden">
        <ul id="suggestion-list"></ul>
        <p id="no-results" class="hidden">Không tìm thấy sản phẩm phù hợp</p>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchBox = document.getElementById("search-box");
        const suggestionBox = document.getElementById("suggestion-box");
        const suggestionList = document.getElementById("suggestion-list");
        const noResults = document.getElementById("no-results");
        const searchBtn = document.querySelector(".search-btn");

        // Kiểm tra nếu có tham số searchTerm trong URL và hiển thị trong ô tìm kiếm
        const urlParams = new URLSearchParams(window.location.search);
        const searchTermParam = urlParams.get('searchTerm');
        if (searchTermParam) {
            searchBox.value = searchTermParam;
        }

        // Xử lý tìm kiếm khi click vào nút tìm kiếm hoặc nhấn Enter
        searchBtn.addEventListener("click", performSearch);
        searchBox.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                e.preventDefault(); // Ngăn chặn reload trang
                performSearch();
            }
        });

        // Hàm cập nhật URL và reload trang để tìm kiếm
        function performSearch() {
            const searchTerm = searchBox.value.trim();
            if (searchTerm) {
                // Cập nhật query string trên URL
                const url = new URL(window.location.href);
                url.searchParams.set('searchTerm', searchTerm);
                window.history.pushState({ path: url.href }, '', url.href);

                // Reload trang
                window.location.reload();
            }
        }

        // Sự kiện khi người dùng nhập vào ô tìm kiếm
        searchBox.addEventListener("input", function () {
            const searchTerm = searchBox.value.trim();
            if (!searchTerm) {
                suggestionBox.classList.add("hidden");
            }
        });

        document.addEventListener("click", function (e) {
            if (!searchBox.contains(e.target) && !suggestionBox.contains(e.target)) {
                suggestionBox.classList.add("hidden");
            }
        });
    });
</script>
