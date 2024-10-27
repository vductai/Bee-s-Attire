@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Policy</h5>
        </div>
    </div>
    @foreach ($policy as $item)
        <div class="row">
            <div class="col-md-12">
                <div class="cr-cat-list cr-card card-default mb-24px">
                    <div class="cr-card-content">
                        <div class="cr-cat-form">
                            <h3>Chỉnh sửa chính sách </h3>
                            <form action="{{ route('policies.update', $item->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Tên chính sách</label>
                                    <div class="col-7">
                                        <input type="text" name="title" class="form-control here slug-title"
                                            value="{{ old('title', $item->title) }}">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <div class="col-7">
                                        <textarea name="content_post" class="form-control" id="editor1" cols="10" rows="10"
                                            placeholder="Nhập nội dung chính sách">{{ old('content_post', $item->content_post) }}</textarea>
                                        @error('content_post')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex mt-3">
                                        <button type="submit" class="cr-btn-primary">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
