@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>List size</h5>
        </div>
    </div>
<<<<<<< HEAD
    @if(session('errorSize'))
        <div class="text-danger">{{session('errorSize')}}</div>
    @endif
=======
>>>>>>> d7751cd (Add new features)
    <div class="row">
        <div class="col-md-12">
            <div class="cr-card card-default product-list">
                <div class="cr-card-content ">
                    <div class="table-responsive">
<<<<<<< HEAD
                        <table id="product_list" class="table" style="width:100%">
=======
                        <table id="cat_data_table" class="table">
>>>>>>> d7751cd (Add new features)
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
                                    <td>
                                        <div class="d-flex justify-content-center">
=======
                            @foreach($list as $item)
                                <tr data-id="{{$item->size_id}}">
                                    <td>{{$loop->index}}</td>
                                    <td class="sizeName">{{$item->size_name}}</td>
                                    <td>
                                        <div>
>>>>>>> d7751cd (Add new features)
                                            <button type="button"
                                                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static">
															<span class="sr-only"><i
                                                                    class="ri-settings-3-line"></i></span>
                                            </button>
<<<<<<< HEAD
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('size.edit', $item->size_id)}}">Edit</a>
                                                <form action="{{route('size.destroy', $item->size_id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                </form>
=======

                                            <div class="dropdown-menu">
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
