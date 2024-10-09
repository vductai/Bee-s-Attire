@extends('layout.admin.home')
@section('content_admin')
  
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>List Banner</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="cr-card card-default product-list">
                <div class="cr-card-content ">
                    <div class="table-responsive">
                        
                        <table id="banner_list" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>subtitle</th>
                                    <th>description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <img class="tbl-thumb" src="{{ asset('storage/' . $banner->image) }}"
                                                alt="Banner Image">
                                        </td>
                                        <td>{{ $banner->title }}</td>
                                        <td>{{ $banner->subtitle }}</td>
                                        <td> {{ $banner->description }} </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button type="button"
                                                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    data-display="static">
                                                    <span class="sr-only"><i class="ri-settings-3-line"></i></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('banners.edit', $banner->id) }}">Edit</a>
                                                    <form action="{{ route('banners.destroy', $banner->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
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
