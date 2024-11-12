@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Chỉnh sửa người dùng</h5>
        </div>
    </div>
    <form id="formUserUpdate" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" id="userId" value="{{$show->user_id}}">
        <div class="col-md-12">
            <div class="cr-card card-default">
                <div class="cr-card-content">
                    <div class="row cr-product-uploads">
                        <div class="col-lg-4 mb-991">
                            <div class="cr-vendor-img-upload">
                                <div class="cr-vendor-main-img">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' name="avatar" id="avatar"
                                                   class="cr-image-upload"
                                                   accept=".png, .jpg, .jpeg">
                                            <label><i class="ri-pencil-line"></i></label>
                                        </div>
                                        <div class="avatar-preview cr-preview">
                                            <div class="imagePreview cr-div-preview">
                                                <img class="cr-image-preview"
                                                     src="{{ asset('upload/' . $show->avatar) }}"
                                                     alt="edit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="error-text text-danger" id="avatar-error"></p>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="cr-vendor-upload-detail">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                               value="{{$show->username}}" placeholder="">
                                        <p class="error-text text-danger" id="username-error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control slug-title"
                                               id="email" value="{{$show->email}}">
                                        <p class="error-text text-danger" id="email-error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Giới tính</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option>---- Chọn giới tính ----</option>
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                        </select>
                                        <p class="error-text text-danger" id="gender-error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Số điện thoại</label>
                                        <input type="number" name="phone" class="form-control slug-title"
                                               id="phone" value="{{$show->phone}}">
                                        <p class="error-text text-danger" id="phone-error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Ngày sinh</label>
                                        <input type="date" name="birthday" class="form-control slug-title"
                                               id="birthday" value="{{$show->birthday}}">
                                        <p class="error-text text-danger" id="birthday-error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Địa chỉ</label>
                                        <input type="text" name="address" class="form-control slug-title"
                                               id="address" value="{{$show->address}}">
                                        <p class="error-text text-danger" id="address-error"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn cr-btn-primary">Sửa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
