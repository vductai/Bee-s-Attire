@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Color</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="cr-cat-list cr-card card-default mb-24px">
                <div class="cr-card-content">
                    <div class="cr-cat-form">
                        <h3>Chi tiết chính sách </h3>
                        <form action="{{ route('color.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên chính sách</label>
                                <div class="col-7">
                                    <input type="text" class="form-control here slug-title" type="text"
                                        value="{{ $policy->title }}" disabled>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <div class="col-7">
                                    <input type="text" class="form-control here slug-title" type="text"
                                        value="{{ strip_tags($policy->content_post) }}" disabled>
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
