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
                <div class="cr-card-content">
                    <div class="table-responsive">
                        <table id="banner_list" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{-- <img class="tbl-thumb" src="{{ asset('upload/uploads/' . $banner->banner_image) }}" style="width: 100px; height: auto;"> --}}
                                            @foreach ($banner->imageBanners as $image)
                                                <img class="tbl-thumb"
                                                    src="{{ asset('upload/uploads/' . $image->image_path) }}"
                                                    style="width: 100px; height: auto; margin-left: 5px;">
                                            @endforeach
                                        </td>
                                        <td>{{ $banner->banner_title }}</td>
                                        <td>{{ $banner->banner_subtitle }}</td>
                                        <td>{{ $banner->banner_description }}</td>
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
                                                        href="{{ route('banners.edit', $banner->banner_id) }}">Edit</a>
                                                    <form action="{{ route('banners.destroy', $banner->banner_id) }}"
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
