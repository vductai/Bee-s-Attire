@extends('layout.admin.home')
@section('content_admin')
    @if (session('errorColor'))
        <script>
            console.log('{{ session('errorColor') }}')
            console.log('day la loi')
            window.addEventListener('DOMContentLoaded', function() {
                alert("{{ session('errorColor') }}");
            });
        </script>

        @if (session('errorColor'))
            <h1>{{ session('errorColor') }}</h1>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif



        {{-- @dd(session()->has('success')) --}}

        <div class="cr-page-title cr-page-title-2">
            <div class="cr-breadcrumb">
                <h5>List color</h5>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="cr-card card-default product-list">
                    <div class="cr-card-content ">
                        <div class="table-responsive">
                            <table id="cat_data_table" class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Color_name</th>
                                        <th>Color_code</th>
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
                                                <div class="d-flex justify-content-center">
                                                    <button type="button"
                                                        class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        data-display="static">
                                                        <span class="sr-only"><i class="ri-settings-3-line"></i></span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('color.edit', $item->color_id) }}">Edit</a>
                                                        <div class="alert-popup">
                                                            <form action="{{ route('color.destroy', $item->color_id) }}"
                                                                method="post"
                                                                onsubmit="return confirm('Bạn có muốn xóa không??')">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="dropdown-item"
                                                                    class="pop-success cr-btn-primary"
                                                                    type="submit">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                        <tr>
                                            <th>STT</th>
                                            <th>Color name</th>
                                            <th>Color code</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                <tbody>
                                    @foreach ($listColor as $item)
                                        <tr data-id="{{ $item->color_id }}">
                                            <td>{{ $loop->index }}</td>
                                            <td class="colorName">{{ $item->color_name }}</td>
                                            <td>
                                                <input id="colorCode" name="color_code" class="form-control here slug-title"
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
                                                            href="/admin/color/{{ $item->color_id }}/edit">Edit</a>
                                                        <button class="dropdown-item delete-btn"
                                                            data-id="{{ $item->color_id }}">Delete</button>
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
