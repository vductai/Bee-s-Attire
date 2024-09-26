@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Variant</h5>
        </div>
    </div>
    <div class="row cr-category">
        <div class="col-xl-4 col-lg-12">
            <div class="team-sticky-bar">
                <div class="col-md-12">
                    <div class="cr-cat-list cr-card card-default mb-24px">
                        <div class="cr-card-content">
                            <div class="cr-cat-form">
                                <h3>Add New Variant</h3>
                                <form>
                                    <div class="form-group">
                                        <label>Product</label>
                                        <div class="col-12">
                                            <select class="form-control form-select">
                                                <option>Select Main Product</option>
                                                <option>Clothes</option>
                                                <option>Jewellery</option>
                                                <option>Furniture</option>
                                                <option>Perfume</option>
                                                <option>Footwear</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Size</label>
                                        <div class="col-12">
                                            <select class="form-control form-select">
                                                <option>Select Main Size</option>
                                                <option>Clothes</option>
                                                <option>Jewellery</option>
                                                <option>Furniture</option>
                                                <option>Perfume</option>
                                                <option>Footwear</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Color</label>
                                        <div class="col-12">
                                            <select class="form-control form-select">
                                                <option>Select Main Color</option>
                                                <option>Clothes</option>
                                                <option>Jewellery</option>
                                                <option>Furniture</option>
                                                <option>Perfume</option>
                                                <option>Footwear</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Quantity</label>
                                        <input type="number" class="form-control" id="quantity1">
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
                                <th>Product</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Top</td>
                                <td>Top</td>
                                <td>Top</td>
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
                                            <a class="dropdown-item" href="{{route('updateSize')}}">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
