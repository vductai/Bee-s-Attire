import './bootstrap';

const variants = document.querySelectorAll('.variants');
if (variants){
    variants.forEach(variant => {
        variant.addEventListener('click', function (e) {
            e.preventDefault()
            const idVariant = variant.dataset.idvariant
            axios.get(`/admin/product-variant/${idVariant}/edit`,{
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => {
                const data = res.data
                // Cập nhật chọn giá trị trong select size
                const sizeSelect = document.getElementById('size_id');
                const sizeOptions = sizeSelect.querySelectorAll('option');
                sizeOptions.forEach(option => {
                    if (option.textContent.trim() === data.size.trim()) {
                        option.selected = true;
                    }
                });
                // Cập nhật chọn giá trị trong select color
                const colorSelect = document.getElementById('color_id');
                const colorOptions = colorSelect.querySelectorAll('option');
                colorOptions.forEach(option => {
                    if (option.textContent.trim() === data.color.trim()) {
                        option.selected = true;
                    }
                });
                document.getElementById('quantity').value = data.quantity
                document.getElementById('idVariant').value = data.idVariant
            })
        })
    })
}
