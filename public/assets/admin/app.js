/*------------------------------------------- slug, color, size ---------------------------------------*/
// Hàm chuyển đổi các ký tự có dấu thành không dấu
document.addEventListener('DOMContentLoaded', function () {
    function removeVietnameseTones(str) {
        return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Loại bỏ dấu
            .replace(/đ/g, 'd').replace(/Đ/g, 'D'); // Thay thế chữ đ/Đ thành d/D
    }
    document.getElementById('inputEmail4').addEventListener('input', function () {
        var productName = this.value;
        var slug = removeVietnameseTones(productName.toLowerCase())
            .replace(/[^a-z0-9\s-]/g, '')  // Loại bỏ ký tự đặc biệt
            .replace(/\s+/g, '-')          // Thay thế khoảng trắng bằng dấu gạch ngang
            .replace(/-+/g, '-');          // Xóa các dấu gạch ngang liên tiếp
        document.getElementById('slug').value = slug;
        document.getElementById('slugs').value = slug;
    });
});
// thêm biến thể
document.getElementById('add-variant-btn').addEventListener('click', function () {

    // Tạo một div chứa biến thể mới
    const variantDiv = document.createElement('div');

    // Tạo một ID duy nhất cho mỗi div chứa biến thể
    const variantId = `variant-${Date.now()}`;

    variantDiv.innerHTML = `
                <div id="${variantId}" class="row g-3">
                    <hr>
                    <div class="col-md-6">
                        <label class="form-label">Color</label>
                            <select name="color_id[]" id="color_id" class="form-control form-select">
                                <option>Chọn màu sắc</option>
                            </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Size</label>
                        <select name="size_id[]" id="size_id" class="form-control form-select">
                                <option>Chọn kích thước</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity[]" class="form-control" id="price1">
                    </div>

                    <button type="button" class="remove-variant-btn cr-btn default-btn color-danger">Xóa biến thể</button>
                    <hr>
                </div>
            `;


    document.getElementById('variant-container').appendChild(variantDiv);

    // lấy ra màu
    const colorSelect = variantDiv.querySelector('select[name="color_id[]"]');
    selColor.forEach(function (color) {
        const optionColor = document.createElement('option')
        optionColor.value = color.color_id
        optionColor.text = color.color_name
        colorSelect.appendChild(optionColor)
    })

    // lấy ra size
    const sizeSelect = variantDiv.querySelector('select[name="size_id[]"]');
    selSize.forEach(function (size) {
        const optionSize = document.createElement('option')
        optionSize.value = size.size_id
        optionSize.text = size.size_name
        sizeSelect.appendChild(optionSize)
    })

    // xoá biến thể
    variantDiv.querySelector('.remove-variant-btn').addEventListener('click', function () {
        document.getElementById(variantId).remove();
    });
});
