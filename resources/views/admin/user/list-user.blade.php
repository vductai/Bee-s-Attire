@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>List user</h5>
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
                                    <th>Avatar</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Date Create</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                    <tr data-id="{{ $item->user_id }}">
                                        <td>{{ $loop->index }}</td>
                                        <td>
                                            <img class="tbl-thumb" src="{{ asset('upload/' . $item->avatar) }}"
                                                alt="User Avatar">
                                        </td>
                                        <td class="userName">{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($item->created_at)->format('H:i:s d-m-Y') }}
                                        </td>
                                        <td>
                                            <span
                                                class="statusBadge badge {{ $item->action ? 'text-success' : 'text-danger' }}"
                                                data-status="{{ $item->action ? 'active' : 'inactive' }}">
                                                {{ $item->action ? 'Đang hoạt động' : 'Tạm khoá' }}
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
                                                    <a href="{{route('user.edit', $item->user_id)}}" class="dropdown-item">Edit</a>

                                                    
                                                    <button class="dropdown-item statusToggle"
                                                        data-id="{{ $item->user_id }}">
                                                        {{ $item->action ? 'Khoá tài khoản' : 'Mở khoá' }}
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