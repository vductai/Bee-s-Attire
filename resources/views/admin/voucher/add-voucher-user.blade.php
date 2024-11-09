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
                                <h3>Add User Coupon</h3>
                                <form action="{{route('add-coupon-user')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>User</label>
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
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Voucher</label>
                                        <div class="col-12">
                                            <select name="voucher_id" id="" class="form-control here slug-title">
                                                <option value="">Chọn voucher</option>
                                                @foreach($voucher as $v)
                                                    <option value="{{$v->voucher_id}}">{{$v->voucher_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>End date</label>
                                        <div class="col-12">
                                            <input type="datetime-local" name="end_date">
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
                                <th>User</th>
                                <th>Voucher</th>
                                <th>Expired</th>
                                <th>Action</th>
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
                                                <a class="dropdown-item" href="">Edit</a>
                                                <form action="{{route('delete-coupon', $item->user_voucher_id)}}"
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
    <script !src="">
        function selectUsername() {
            const userSel = document.getElementById('user-select')
            const selectedUsernames = Array.from(userSel.selectedOptions)
                .map(option => option.getAttribute("data-username"));
            document.getElementById("selected_usernames").value = selectedUsernames.join(", ")
        }
    </script>
@endsection
