@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Add user</h5>
        </div>
    </div>
<<<<<<< HEAD
</div>
<form class="row" id="formUserUpdate" enctype="multipart/form-data">
    <input type="hidden" id="userId" value="{{$show->user_id}}">
    <input type="text" name="_method" value="PUT">
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
                                            class="cr-image-upload" accept=".png, .jpg, .jpeg">
                                        <label><i class="ri-pencil-line"></i></label>
                                    </div>
                                    <div class="avatar-preview cr-preview">
                                        <div class="imagePreview cr-div-preview">
                                            <img class="cr-image-preview"
                                                src="{{ asset('upload/' . $show->avatar) }}"
                                                alt="edit">
=======
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
>>>>>>> 050a147a7b8da9d9a84ba4aa4603696c19359b41
                                        </div>
                                    </div>
                                </div>
                                <p class="error-text text-danger" id="avatar-error"></p>
                            </div>
                        </div>
<<<<<<< HEAD
                    </div>

                    <div class="col-lg-8">
                        <div class="cr-vendor-upload-detail">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">User Name</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{$show->username}}" placeholder="">

                                    <p class="error-text text-danger" id="username-error"></p>

                                </div>
                                
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control slug-title"
                                           id="email" value="{{$show->email}}">
                                           <p class="error-text text-danger" id="email-error"></p>
                                </div>
                                  
                                <div class="col-md-6">
                                    <label class="form-label">Select gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="Nam" {{ $show->gender == true ? 'selected' : ''}} >Nam</option>
                                        <option value="Nữ" {{ $show->gender == false ? 'selected' : ''}} >Nữ</option>
                                    </select>
                                    <p class="error-text text-danger" id="gender-error"></p>

                                </div>

                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Phone</label>
                                    <input type="number" name="phone" class="form-control slug-title"
                                           id="phone" value="{{$show->phone}}">
                                           <p class="error-text text-danger" id="phone-error"></p>

                                </div>

                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Birthday</label>
                                    <input type="date" name="birthday" class="form-control slug-title"
                                           id="birthday" value="{{$show->birthday}}">
                                           <p class="error-text text-danger" id="birthday-error"></p>

                                </div>

                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control slug-title"
                                           id="address" value="{{$show->address}}">
                                           <p class="error-text text-danger" id="address-error"></p>

                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn cr-btn-primary">Submit</button>
=======
                        <div class="col-lg-8">
                            <div class="cr-vendor-upload-detail">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">User Name</label>
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
                                        <label class="form-label">Select gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                        </select>
                                        <p class="error-text text-danger" id="gender-error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Phone</label>
                                        <input type="number" name="phone" class="form-control slug-title"
                                               id="phone" value="{{$show->phone}}">
                                        <p class="error-text text-danger" id="phone-error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Birthday</label>
                                        <input type="date" name="birthday" class="form-control slug-title"
                                               id="birthday" value="{{$show->birthday}}">
                                        <p class="error-text text-danger" id="birthday-error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control slug-title"
                                               id="address" value="{{$show->address}}">
                                        <p class="error-text text-danger" id="address-error"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn cr-btn-primary">Submit</button>
                                    </div>
>>>>>>> 050a147a7b8da9d9a84ba4aa4603696c19359b41
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
