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
                                <h3>Add voucher</h3>
                                <form action="{{route('coupon.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Voucher code</label>
                                        <div class="col-12">
                                            <input id="text" name="voucher_code"
                                                   class="form-control here slug-title" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <div class="col-12">
                                            <input id="text" name="voucher_price"
                                                   class="form-control here slug-title" type="number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Start date</label>
                                        <div class="col-12">
                                            <input id="text" name="start_date"
                                                   class="form-control here slug-title" type="datetime-local">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>End date</label>
                                        <div class="col-12">
                                            <input id="text" name="end_date"
                                                   class="form-control here slug-title" type="datetime-local">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Voucher desc</label>
                                        <div class="col-12">
                                            <textarea name="voucher_desc" id="" cols="70" rows="10"
                                                      style="resize: none"></textarea>
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
                                <tr>
                                    <td>{{$loop->index}}</td>
                                    <td>{{$item->voucher_code}}</td>
                                    <td>{{$item->voucher_price}} %</td>
                                    <td>{{$item->voucher_desc}}</td>
                                    <td>{{$item->start_date}}</td>
                                    <td>{{$item->end_date}}</td>
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
                                                <form action="" method="post">
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
@endsection
