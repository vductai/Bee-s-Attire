@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Voucher</h5>
        </div>
    </div>
    <div class="row cr-category">
        <div class="col-xl-4 col-lg-12">
            <div class="team-sticky-bar">
                <div class="col-md-12">
                    <div class="cr-cat-list cr-card card-default mb-24px">
                        <div class="cr-card-content">
                            <div class="cr-cat-form">
                                <h3>Update voucher</h3>
                                <form id="formVoucherUpdate">
                                    <input type="hidden" id="voucherId" value="{{$find->voucher_id}}">
                                    <div class="form-group">
                                        <label>Voucher code</label>
                                        <div class="col-12">
                                            <input id="voucher_code" name="voucher_code" value="{{$find->voucher_code}}" class="form-control here slug-title" type="text">
                                        </div>
                                        <p class="error-text text-danger" id="voucher_code-error"></p> <!-- Sửa id -->
                                    </div>
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <div class="col-12">
                                            <input id="voucher_price" value="{{$find->voucher_price}}" name="voucher_price" class="form-control here slug-title" type="number">
                                        </div>
                                        <p class="error-text text-danger" id="voucher_price-error"></p> <!-- Sửa id -->
                                    </div>
                                    <div class="form-group">
                                        <label>Start date</label>
                                        <div class="col-12">
                                            <input id="start_date" value="{{$find->start_date}}" name="start_date" class="form-control here slug-title" type="datetime-local">
                                        </div>
                                        <p class="error-text text-danger" id="start_date-error"></p> <!-- Sửa id -->
                                    </div>
                                    <div class="form-group">
                                        <label>End date</label>
                                        <div class="col-12">
                                            <input id="end_date" value="{{$find->end_date}}" name="end_date" class="form-control here slug-title" type="datetime-local">
                                        </div>
                                        <p class="error-text text-danger" id="end_date-error"></p> <!-- Sửa id -->
                                    </div>
                                    <div class="form-group">
                                        <label>Voucher desc</label>
                                        <div class="col-12">
                                            <textarea name="voucher_desc" class="form-control here slug-title" id="voucher_desc" cols="70" rows="5" style="resize: none">{{$find->voucher_desc}}</textarea>
                                        </div>
                                        <p class="error-text text-danger" id="voucher_desc-error"></p> <!-- Sửa id -->
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
                                <th>Voucher code</th>
                                <th>Discount</th>
                                <th>Desc</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vouchers as $item)
                                <tr data-id="{{$item->voucher_id}}">
                                    <td>{{$loop->index}}</td>
                                    <td class="voucherCode">{{$item->voucher_code}}</td>
                                    <td class="voucherPrice">{{$item->voucher_price}} %</td>
                                    <td class="voucherDesc">{{$item->voucher_desc}}</td>
                                    <td class="startDate">{{$item->start_date}}</td>
                                    <td class="endDate">{{$item->end_date}}</td>
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
                                                <a class="dropdown-item" href="/admin/coupon/{{$item->voucher_id}}/edit">Edit</a>
                                                <button class="dropdown-item delete-btn" data-id="{{$item->voucher_id}}">Delete</button>
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
