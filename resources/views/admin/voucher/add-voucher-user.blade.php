@extends('layout.admin.home')
@include('toast.admin-toast')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Mã giảm giá</h5>
        </div>
    </div>
    <div class="row cr-category">
        <div class="col-xl-4 col-lg-12">
            <div class="team-sticky-bar">
                <div class="col-md-12">
                    <div class="cr-cat-list cr-card card-default mb-24px">
                        <div class="cr-card-content">
                            <div class="cr-cat-form">
                                <h3></h3>
                                <form id="add-coupon-form">
                                    <div class="form-group">
                                        <label>Người dùng</label>
                                        <div class="col-12">
                                            <input type="text" id="selected_usernames" class="form-control">
                                            <select name="user_id[]" multiple size="5"
                                                    id="user-select"
                                                    aria-label="Size 5 Multiple select example"
                                                    onchange="selectUsername()"
                                                    class="form-control here slug-title">
                                                @foreach($user as $u)
                                                    <option value="{{$u->user_id}}" data-username="{{$u->username}}">
                                                        {{$u->username}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger ers" id="user_id-error"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mã giảm giá</label>
                                        <div class="col-12">
                                            <select name="voucher_id" id="voucher_id" class="form-control here slug-title">
                                                <option value="">Chọn mã</option>
                                                @foreach($voucher as $v)
                                                    <option value="{{$v->voucher_id}}">{{$v->voucher_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <p class="text-danger ers" id="voucher_id-error"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày kết thúc</label>
                                        <div class="col-12">
                                            <input type="datetime-local" id="end_date" name="end_date">
                                        </div>
                                        <p class="text-danger ers" id="end_date-error"></p>
                                        <p class="text-danger ers" id="endere"></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex">
                                            <button type="submit" class="cr-btn-primary">Tạo</button>
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
                                <th>Người dùng</th>
                                <th>Mã giảm giá</th>
                                <th>Ngày hết hạn</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{$loop->index}}</td>
                                    <td>{{$item->user->username}}</td>
                                    <td>{{$item->voucher->voucher_code}}</td>
                                    <td>{{\Illuminate\Support\Carbon::parse($item->end_date)->format('H:i d-m-Y') }}</td>
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
                                                <a class="dropdown-item" href="">Sửa</a>
                                                <form action="{{route('delete-coupon', $item->user_voucher_id)}}"
                                                      method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">Xóa</button>
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
    <script !src="">
        function selectUsername() {
            const userSel = document.getElementById('user-select')
            const selectedUsernames = Array.from(userSel.selectedOptions)
                .map(option => option.getAttribute("data-username"));
            document.getElementById("selected_usernames").value = selectedUsernames.join(", ")
        }
    </script>
@endsection