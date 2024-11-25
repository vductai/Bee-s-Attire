@extends('layout.admin.home')
@include('toast.admin-toast')

@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Danh mục phụ</h5>
        </div>
    </div>
    <div class="row cr-category">
        <div class="col-xl-4 col-lg-12">
            <div class="team-sticky-bar">
                <div class="col-md-12">
                    <div class="cr-cat-list cr-card card-default mb-24px">
                        <div class="cr-card-content">
                            <div class="cr-cat-form">
                                <h3>Chỉnh sửa danh mục phụ</h3>
                                <form id="formCategoryUpdate">
                                    <div class="form-group">
                                        <label>Danh mục chính</label>
                                        <div class="col-12">
                                            <select name="id" id="id" value="{{$find->parent->name}}" class="form-control form-select">
                                                <option value="">Chọn danh mục gốc</option>
                                                @foreach($parent as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger" id="errCategoryParent"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input type="hidden" id="category_id"  value="{{$find->category_id}}">
                                        <div class="col-12">
                                            <input id="category_name" name="category_name" value="{{$find->category_name}}"
                                                   class="form-control here slug-title" type="text">
                                            <p class="text-danger" id="errCategory"></p>
                                            <p class="text-danger" id="errsss"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex">
                                            <button type="submit" class="cr-btn-primary">Sửa danh mục</button>
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
                                <th>Tên danh mục</th>
                                <th>Danh mục chính</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr data-id="{{$item->category_id}}">
                                    <td>{{$loop->index}}</td>
                                    <td class="categoryName">{{$item->category_name}}</td>
                                    <td class="categoryParent">{{$item->parent->name}}</td>
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
                                                <a class="dropdown-item" href="/admin/categories/{{$item->category_id}}/edit">Chỉnh sửa</a>
                                                <button class="dropdown-item delete-cate" data-id="{{$item->category_id}}">
                                                    Xoá
                                                </button>
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
