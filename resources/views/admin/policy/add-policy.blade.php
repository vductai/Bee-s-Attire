@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Policy</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="cr-cat-list cr-card card-default mb-24px">
                <div class="cr-card-content">
                    <div class="cr-cat-form">
                        <h3>Thêm chính sách mới</h3>
                        <form action="{{ route('policies.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên chính sách</label>
                                <div class="col-7">
                                    <input type="text" name="title" class="form-control here slug-title"
                                        type="text">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <div class="col-7">
                                    <textarea name="content_post" class="form-control" id="editor1" cols="80" rows="70"
                                        placeholder="Nhập nội dung chính sách"></textarea>
                                    @error('content_post')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex mt-3">
                                    <button type="submit" class="cr-btn-primary">Thêm mới </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
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
