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
                                <h3>Add New Color</h3>
                                <form action="{{ route('color.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Color name</label>
                                        <div class="col-12">
                                            <input id="text" name="color_name" class="form-control here slug-title"
                                                type="text">
                                        </div>
                                        @error('color_name')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label>Color code</label>
                                        <div class="col-12">
                                            <input id="text" name="color_code" class="form-control here slug-title"
                                                type="color">

                                        </div>
                                        @error('color_code')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror

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
                                @foreach ($listColor as $item)
                                    <tr>
                                        <td>{{ $loop->index }}</td>
                                        <td>{{ $item->color_name }}</td>
                                        <td>
                                            <input id="text" name="color_code" class="form-control here slug-title"
                                                type="color" value="{{ $item->color_code }}" disabled>
                                        </td>
                                        <td>
                                            <div>
                                                <button type="button"
                                                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    data-display="static">
                                                    <span class="sr-only"><i class="ri-settings-3-line"></i></span>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('color.edit', $item->color_id) }}">Edit</a>
                                                    <form action="{{ route('color.destroy', $item->color_id) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="dropdown-item" type="submit">Delete</button>
                                                    </form>
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
