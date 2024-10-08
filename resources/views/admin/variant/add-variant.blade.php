@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Variant</h5>
        </div>
    </div>
    <div class="row cr-category">
        <div class="col-xl-5 col-lg-12">
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
                                            @foreach($product as $pro)
                                                    <option>{{$pro->product_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Size</label>
                                        <div class="col-12">
                                            <select class="form-control form-select">
                                                <option>Select Main Size</option>
                                                @foreach($size as $s)
                                                    <option>{{$s->size_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Color</label>
                                        <div class="col-12">
                                            <select class="form-control form-select" id="colorSelect">
                                                <option>Select Main Color</option>
                                                @foreach($color as $c)
                                                    <option value="{{$c->color_code}}">
                                                        {{$c->color_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <input id="color" name="color_code"
                                                   class="form-control here slug-title"
                                                   type="color"
                                                   value="" disabled>
                                        </div>
                                        <script !src="">
                                            document.getElementById('colorSelect').addEventListener('change', function() {
                                                var input = document.getElementById('color');
                                                var selectedColor = this.value;
                                                input.value = selectedColor;
                                            });
                                        </script>
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
        <div class="col-xl-7 col-lg-12">
            <div class="cr-cat-list cr-card card-default">
                <div class="cr-card-content ">
                    <div class="table-responsive tbl-800">
                        <table id="product_list" class="table text-center" style="width:100%">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Product</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($variant as $item)
                                <tr>
                                    <td>{{$loop->index}}</td>
                                    <td>{{$item->product->product_name}}</td>
                                    <td><input id="text" name="color_code"
                                               class="form-control here slug-title"
                                               type="color"
                                               value="{{$item->color->color_code}}" disabled></td>
                                    <td>{{$item->size->size_name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="button"
                                                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static">
															<span class="sr-only"><i
                                                                    class="ri-settings-3-line"></i></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
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
