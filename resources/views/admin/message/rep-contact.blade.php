@extends('layout.admin.home')
@include('toast.admin-toast')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
        </div>
    </div>
    <div class="row cr-category d-flex justify-content-center">
        <div class="col-xl-4 col-lg-12">
            <div class="team-sticky-bar">
                <div class="col-md-12">
                    <div class="cr-cat-list cr-card card-default mb-24px">
                        <div class="cr-card-content">
                            <div class="cr-cat-form">
                                <h3>Trả lời</h3>
                                <div>
                                    <div class="form-group">
                                        <label>Tin nhắn</label>
                                        <div class="col-12">
                                            <textarea class="form-control here slug-title" disabled>{{$get->content}}</textarea>
                                        </div>
                                        <p class="error-text text-danger" id="voucher_code-error"></p> <!-- Sửa id -->
                                    </div>
                                    <form id="form-rep-contact">
                                        <input type="hidden" name="name" id="name" value="{{$get->name}}">
                                        <input type="hidden" name="email" id="email" value="{{$get->email}}">
                                        <input type="hidden" name="id" id="id" value="{{$get->id}}">
                                        <input type="hidden" name="content" id="content" value="{{$get->content}}">
                                        <div class="form-group">
                                            <label>Nội dung chả lời</label>
                                            <div class="col-12">
                                            <textarea name="repContact" class="form-control here slug-title"
                                                      id="repContact" cols="70" rows="5"></textarea>
                                            </div>
                                            <p class="error-text text-danger" id="voucher_desc-error"></p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 d-flex">
                                                <button type="submit" class="cr-btn-primary">Trả lời</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
