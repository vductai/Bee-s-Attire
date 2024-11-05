@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Color</h5>
        </div>
    </div>
    <div class="row cr-category">
        <div class="col-xl-4 col-lg-12">
            <div class="team-sticky-bar">
                <div class="col-md-12">
                    <div class="cr-cat-list cr-card card-default mb-24px">
                        <div class="cr-card-content">
                            <div class="cr-cat-form">
                                <h3>Update Color</h3>
                                <form id="formColorUpdate">
                                    <input type="hidden" id="colorId" value="{{$edit->color_id}}">
                                    <div class="form-group">
                                        <label>Color name</label>
                                        <div class="col-12">
                                            <input id="color_name" name="color_name" value="{{$edit->color_name}}"
                                                   class="form-control here slug-title" type="text">
                                            <p class="text-danger" id="errColorName"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Color code</label>
                                        <div class="col-12">
                                            <input id="color_code" name="color_code" value="{{$edit->color_code}}"
                                                   class="form-control here slug-title" type="color">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex">
                                            <button type="submit" class="cr-btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12">
            <div class="cr-cat-list cr-card card-default">
                <div class="cr-card-content ">
                    <div class="table-responsive tbl-800">
                        <table id="cat_data_table" class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Color name</th>
                                <th>Color code</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listColor as $item)
                                <tr data-id="{{$item->color_id}}">
                                    <td>{{$loop->index}}</td>
                                    <td class="colorName">{{$item->color_name}}</td>
                                    <td>
                                        <input id="colorCode" name="color_code"
                                               class="form-control here slug-title" type="color" value="{{$item->color_code}}" disabled>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button"
                                                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static">
															<span class="sr-only"><i
                                                                    class="ri-settings-3-line"></i></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/admin/color/{{$item->color_id}}/edit">Edit</a>
                                                <button class="dropdown-item delete-btn" data-id="{{$item->color_id}}">Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
