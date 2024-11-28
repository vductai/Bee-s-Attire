@extends('layout.admin.home')
@include('toast.admin-toast')

@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Tạo bài viết</h5>
        </div>
    </div>
    <div class="row">
        <form class="col-md-12" id="formPost">
            <div class="cr-card card-default">
                <div class="cr-card-content">
                    <div class="row cr-product-uploads">
                        <div class="col-lg-4 mb-991">
                            <div class="cr-vendor-img-upload">
                                <div class="cr-vendor-main-img">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="avatar" class="cr-image-upload"
                                                   name="avatar">
                                            <label><i class="ri-pencil-line"></i></label>
                                        </div>
                                        <div class="avatar-preview cr-preview">
                                            <div class="imagePreview cr-div-preview">
                                                <img class="cr-image-preview"
                                                     src="{{asset('assets/admin/img/product/preview.jpg')}}"
                                                     alt="edit">
                                            </div>
                                        </div>
                                        <p class="text-danger errpost" id="avatar-error"></p>
                                    </div>
                                    <div class="thumb-upload-set colo-md-12">
                                        <div class="thumb-upload"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="cr-vendor-upload-detail">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Tiêu đề</label>
                                        <input type="text" id="titlePost" class="form-control title slug-title" name="title">
                                        <p class="text-danger errpost" id="title-error"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Slug</label>
                                        <div class="col-12">
                                            <input id="slugPost" name="slug" class="form-control here slg set-slug" type="text">
                                            <p class="text-danger errpost" id="slug-error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Mô tả</label>
                                        <input type="text" id="desc" class="form-control slug-title" name="desc">
                                        <p class="text-danger errpost" id="desc-error"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Nội dung bài viết</label>
                                        <textarea name="content" id="editor1" cols="80" rows="70"></textarea>
                                        <p class="text-danger errpost" id="content-error"></p>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn cr-btn-primary">Tạo bài viết</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        // Hàm chuyển đổi các ký tự có dấu thành không dấu
        function removeVietnameseTones(str) {
            return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Loại bỏ dấu
                .replace(/đ/g, 'd').replace(/Đ/g, 'D'); // Thay thế chữ đ/Đ thành d/D
        }
        document.getElementById('titlePost').addEventListener('input', function () {
            var title = this.value;
            var slug = removeVietnameseTones(title.toLowerCase())
                .replace(/[^a-z0-9\s-]/g, '')  // Loại bỏ ký tự đặc biệt
                .replace(/\s+/g, '-')          // Thay thế khoảng trắng bằng dấu gạch ngang
                .replace(/-+/g, '-');          // Xóa các dấu gạch ngang liên tiếp
            document.getElementById('slugPost').value = slug;
        });
    </script>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
