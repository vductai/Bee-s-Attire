@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Category</h5>
        </div>
    </div>
    <div class="row cr-category">
        <div class="col-xl-4 col-lg-12">
            <div class="team-sticky-bar">
                <div class="col-md-12">
                    <div class="cr-cat-list cr-card card-default mb-24px">
                        <div class="cr-card-content">
                            <div class="cr-cat-form">
                                <h3>Add New Category</h3>
                                <form id="formCategory">
                                    <div class="form-group">
                                        <label>Parent category</label>
                                        <div class="col-12">
                                            <select name="id" id="id" class="form-control form-select">
                                                <option value="">Chọn danh mục gốc</option>
                                                @foreach($parent as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger" id="errCategoryParent"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Name category</label>
                                        <div class="col-12">
                                            <input id="category_name" name="category_name"
                                                   class="form-control here slug-title" type="text">
                                            <p class="text-danger" id="errCategory"></p>
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
                                <th>Category</th>
                                <th>Main Category</th>
                                <th>Action</th>
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
                                                <a class="dropdown-item" href="/admin/categories/{{$item->category_id}}/edit">Edit</a>
                                                <button class="dropdown-item delete-btn" data-id="{{$item->category_id}}">
                                                    Delete
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
