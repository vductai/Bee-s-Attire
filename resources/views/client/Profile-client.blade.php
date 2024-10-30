@extends('layout.client.home')
@section('content_client')
    <link rel="stylesheet" href="{{asset('assets/client/css/voucher-item.css')}}">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img
                            src="{{asset('upload/'. auth()->user()->avatar)}}"
                            alt="Profile Picture" style="width: 200px;height: 200px; object-fit: cover"
                            class="rounded-circle img-fluid mb-3" id="profilePicture">
                        <h5 class="card-title mb-0" id="userName">{{auth()->user()->username}}</h5>
                        <p class="text-muted mb-1" id="userEmail">{{auth()->user()->email}}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button type="button" class="cr-button" data-bs-toggle="modal"
                                    data-bs-target="#editProfileModal">Chỉnh sửa
                            </button>
                            {{--<button type="button" class="btn btn-outline-primary ms-2">Message</button>--}}
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Social Media</h6>
                        <div class="d-flex justify-content-start">
                            <p class="me-3">Ngày tham
                                gia: {{ auth()->user()->birthday ? \Carbon\Carbon::parse(auth()->user()->birthday)->format('d-m-Y') : 'Trống' }}</p>
                            <a href="#" class="me-3"><i class="bi bi-twitter fs-4"></i></a>
                            <a href="#" class="me-3"><i class="bi bi-linkedin fs-4"></i></a>
                            <a href="#"><i class="bi bi-instagram fs-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="true">Profile
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="preferences-tab" data-bs-toggle="tab"
                                        data-bs-target="#preferences" type="button" role="tab"
                                        aria-controls="preferences"
                                        aria-selected="false">Voucher
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="tab"
                                        data-bs-target="#settings"
                                        type="button" role="tab" aria-controls="settings" aria-selected="false">Settings
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                 aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <h6 class="mb-0">Full Name</h6>
                                        <p class="text-muted">{{auth()->user()->username}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6 class="mb-0">Email</h6>
                                        <p class="text-muted">{{auth()->user()->email}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6 class="mb-0">Gender</h6>
                                        <p class="text-muted">{{auth()->user()->gender ?? 'Trống'}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6 class="mb-0">Birthday</h6>
                                        <p class="text-muted">{{ auth()->user()->birthday ? \Carbon\Carbon::parse(auth()->user()->birthday)->format('d-m-Y') : 'Trống' }}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6 class="mb-0">Phone</h6>
                                        <p class="text-muted">{{auth()->user()->phone ?? 'Trống'}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6 class="mb-0">Address</h6>
                                        <p class="text-muted">{{auth()->user()->address ?? 'Trống'}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="preferences" role="tabpanel"
                                 aria-labelledby="preferences-tab">
                                <div class="form-check form-switch mb-3">
                                    <div class="container text-center">
                                        <div class="row row-cols-1 row-cols-md-3 g-4">
                                            @foreach($vouchers as $item)
                                                <div class="col">
                                                    <div class="voucher-card">
                                                        <div class="voucher-title">{{$item->voucher_desc}}</div>
                                                        <div class="voucher-discount">{{$item->voucher_price}}% OFF</div>
                                                        <div class="voucher-details">Use code: <strong>{{$item->voucher_code}}</strong></div>
                                                        <div class="voucher-expiry mb-3">
                                                            Hạn dùng mã: <br>
                                                            <b>{{\Illuminate\Support\Carbon::parse($item->end_date)->format('H:i d-m-Y') }}</b>
                                                        </div>
                                                        <a href="{{route('home')}}" class="use-btn">Sử dụng</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <h6>Account Settings</h6>
                                <div class="mb-3">
                                    <label for="changePassword" class="form-label">Change Password</label>
                                    <input type="password" class="form-control" id="changePassword"
                                           placeholder="Enter new password">
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword"
                                           placeholder="Confirm new password">
                                </div>
                                <button type="button" class="cr-button btn-primary">Update Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" action="{{route('update-profile')}}" enctype="multipart/form-data"
                          method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="editName" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="editName"
                                   value="{{auth()->user()->username}}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="editEmail"
                                   value="{{auth()->user()->email}}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="editGender" class="form-label">Gender</label>
                            <select class="form-select" name="gender" value="{{auth()->user()->gender}}"
                                    id="editGender">
                                <option>Nam</option>
                                <option>Nữ</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Phone</label>
                            <input type="number" class="form-control" name="phone" id="editEmail"
                                   value="{{auth()->user()->phone ?? 'Trống'}}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="editBirthdate" class="form-label">Birthdate</label>
                            <input type="date" name="birthday" class="form-control" id="editBirthdate"
                                   value="{{ auth()->user()->birthday ?? 'Trống' }}">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="editEmail"
                                   value="{{auth()->user()->address ?? 'Trống'}}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="editProfilePicture" class="form-label">Profile Picture</label>
                            <input type="file" name="avatar" class="form-control" id="editProfilePicture">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="cr-button btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="cr-button btn-primary" id="saveProfileChanges">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
