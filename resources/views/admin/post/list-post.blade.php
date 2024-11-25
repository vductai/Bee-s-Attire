@extends('layout.admin.home')
@include('toast.admin-toast')

@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Danh sách bài viết</h5>
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
                                <th>Tiêu đề</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($list as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td>{{ $loop->index }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        {{ \Illuminate\Support\Carbon::parse($item->created_at)->format('H:i:s d-m-Y') }}
                                    </td>
                                    <td>
                                        <span
                                            class="statusBadge badge {{ $item->action ? 'text-bg-success' : 'text-bg-danger' }}"
                                            data-status="{{ $item->action ? 'active' : 'inactive' }}">
                                            {{ $item->action ? 'Public' : 'Private' }}
                                        </span>
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
                                                <a href="{{route('post.edit', $item->id)}}"
                                                   class="dropdown-item">Sửa</a>
                                                <button
                                                    data-id="{{ $item->id }}"
                                                    class="dropdown-item delete-post">
                                                    Xóa
                                                </button>
                                                <button class="dropdown-item statusToggle"
                                                        data-id="{{ $item->id }}">
                                                    {{ $item->action ? 'Private' : 'Public' }}
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
