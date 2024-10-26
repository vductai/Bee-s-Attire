@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Size</h5>
        </div>
    </div>
    <div class="row cr-category">
        <div class="col-xl-4 col-lg-12">
            <div class="team-sticky-bar">
                <div class="col-md-12">
                    <div class="cr-cat-list cr-card card-default mb-24px">
                        <div class="cr-card-content">
                            <div class="cr-cat-form">
                                <h3>Add New Size</h3>
<<<<<<< HEAD
                                <form action="{{route('size.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name size</label>
                                        <div class="col-12">
                                            <input id="text" name="size_name"
                                                   class="form-control here slug-title" type="text">
=======
                                <form id="formSize">
                                    <div class="form-group">
                                        <label>Name size</label>
                                        <div class="col-12">
                                            <input id="size_name" name="size_name"
                                                   class="form-control here slug-title" type="text">
                                            <p class="text-danger" id="errSize"></p>
>>>>>>> d7751cd (Add new features)
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
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
<<<<<<< HEAD
                            @foreach($sizes as $item)
                                <tr>
                                    <td>{{$loop->index}}</td>
                                    <td>{{$item->size_name}}</td>
=======
                            @foreach($list as $item)
                                <tr data-id="{{$item->size_id}}">
                                    <td>{{$loop->index}}</td>
                                    <td class="sizeName">{{$item->size_name}}</td>
>>>>>>> d7751cd (Add new features)
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
<<<<<<< HEAD
                                                <a class="dropdown-item" href="{{route('size.edit', $item->size_id)}}">Edit</a>
                                                <form action="{{route('size.destroy', $item->size_id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                </form>
=======
                                                <a class="dropdown-item" href="/admin/size/{{$item->size_id}}/edit">Edit</a>
                                                <button class="dropdown-item delete-btn" data-id="{{$item->size_id}}">
                                                    Delete
                                                </button>
>>>>>>> d7751cd (Add new features)
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
