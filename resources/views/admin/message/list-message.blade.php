@extends('layout.admin.home')
@include('toast.admin-toast')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Tin nhắn đến</h5>
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
                                <th>Người gửi</th>
                                <th>Liên hệ</th>
                                <th>Nội dung</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr data-id="{{$item->id}}">
                                    <td>{{$loop->index+1}}</td>
                                    <td class="">{{$item->name}}</td>
                                    <td class="" style="width: 275px;">
                                         Email: {{$item->email}} <br>
                                         Số điện thoại: {{$item->phone}}
                                    </td>
                                    <td class="" style="width: 575px;">
                                        {{$item->content}}
                                    </td>
                                    <td>
                                        <span class="statusBadge badge {{$item->action === 'Chưa trả lời' ? 'text-bg-danger' : 'text-bg-success'}}">
                                            {{$item->action === 'Chưa trả lời' ? 'Chưa trả lời' : 'Đã trả lời'}}
                                        </span>
                                    </td>
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
                                                <a class="dropdown-item" href="{{route('get-contact-edit', $item->id)}}">Trả lời</a>
                                                {{--<button class="dropdown-item delete-message" data-id="{{$item->size_id}}">
                                                    Xóa
                                                </button>--}}
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
