@extends('layout.admin.home')
@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Color</h5>
        </div>
    </div>
    @foreach($edit as $item)
        <div class="row cr-category">
            <div class="col-xl-6 col-lg-12">
                <div class="team-sticky-bar">
                    <div class="col-md-12">
                        <div class="cr-cat-list cr-card card-default mb-24px">
                            <div class="cr-card-content">
                                <div class="cr-cat-form">
                                    <h3>Update Color</h3>
                                    <form action="{{route('color.update', $item->color_id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label>Color name</label>
                                            <div class="col-12">
                                                <input id="text" name="color_name"
                                                       class="form-control here slug-title" value="{{$item->color_name}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Color code</label>
                                            <div class="col-12">
                                                <input id="text" name="color_code"
                                                       class="form-control here slug-title" value="{{$item->color_code}}" type="color">
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
        </div>
    @endforeach
@endsection
