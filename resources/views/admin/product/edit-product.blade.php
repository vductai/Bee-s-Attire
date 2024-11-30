@extends('layout.admin.home')
@include('toast.admin-toast')

@section('content_admin')
    <div class="cr-page-title cr-page-title-2">
        <div class="cr-breadcrumb">
            <h5>Cập nhật sản phẩm</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="cr-card card-default">
                <form class="cr-card-content" id="formUpdatePro" enctype="multipart/form-data">
                    <div class="row cr-product-uploads">
                        <div class="col-lg-4 mb-991">
                            <div class="cr-vendor-img-upload">
                                <div class="cr-vendor-main-img">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' name="product_avatar" id="product_main"
                                                   class="cr-image-upload"
                                                   accept=".png, .jpg, .jpeg">
                                            <label><i class="ri-pencil-line"></i></label>
                                        </div>
                                        <div class="avatar-preview cr-preview">
                                            <div class="imagePreview cr-div-preview">
                                                <img class="cr-image-preview"
                                                     src="{{asset('upload/'. $show->product_avatar)}}"
                                                     alt="edit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thumb-upload-set colo-md-12">
                                        @foreach($show->product_image as $image)
                                            <div class="thumb-upload">
                                                <div class="thumb-edit">
                                                    <input type='file' id="thumbUpload01"
                                                           class="cr-image-upload"
                                                           name="product_images[]"
                                                           accept=".png, .jpg, .jpeg">
                                                    <label><i class="ri-pencil-line"></i></label>
                                                </div>
                                                <div class="thumb-preview cr-preview">
                                                    <div class="image-thumb-preview">
                                                        <img class="image-thumb-preview cr-image-preview"
                                                             src="{{asset('upload/'. $image->product_image)}}"
                                                             alt="edit">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="cr-vendor-upload-detail">
                                <input type="hidden" name="" id="idProductUpdate" value="{{$show->product_id}}">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Tên sản phẩm</label>
                                        <input type="text" value="{{$show->product_name}}"
                                               name="product_name" class="form-control slug-title"
                                               id="inputEmail4">
                                        <p class="text-danger proErr" id="product_name-error"></p>

                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Danh mục</label>
                                        <select class="form-control form-select" name="category_id">
                                            @foreach($category as $item)
                                                <optgroup label="{{$item->name}}">
                                                    @foreach($item->children as $childrens)
                                                        <option
                                                            value="{{$childrens->category_id}}">{{$childrens->category_name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="slug" class="col-12 col-form-label">Đường dẫn</label>
                                        <div class="col-12">
                                            <input name="slug" id="slug" class="form-control here set-slug"
                                                   type="hidden" value="{{$show->slug}}">
                                            <input id="slugs" value="{{$show->slug}}"
                                                   class="form-control here set-slug" type="text" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Giá gốc</label>
                                        <input type="number" name="product_price"
                                               value="{{ str_replace(',', '', number_format($show->product_price)) }}"
                                               class="form-control" id="price1">
                                        <p class="text-danger proErr" id="product_price-error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sale price</label>
                                        <input type="number" value="{{ str_replace(',', '', number_format($show->sale_price)) }}"
                                               name="sale_price" class="form-control" id="price1">
                                        <p class="text-danger proErr" id="sale_price-error"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Mô tả</label>
                                        <textarea name="product_desc" id="editor1" cols="80"
                                                  rows="70">{!! $show->product_desc !!}</textarea>
                                        <p class="text-danger proErr" id="product_desc-error"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" id="btn-update" class="btn cr-btn-primary">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row cr-category">
            <div class="col-xl-4 col-lg-12">
                <div class="team-sticky-bar">
                    <div class="col-md-12">
                        <div class="cr-cat-list cr-card card-default mb-24px">
                            <div class="cr-card-content">
                                <div class="cr-cat-form">
                                    <h3>Tạo biến thể</h3>
                                    <form id="formProductVariant">
                                        <input type="hidden" id="idProduct" value="{{$show->product_id}}">
                                        <div class="form-group">
                                            <label>kích thước</label>
                                            <div class="col-12">
                                                <select name="" id="size_id" class="form-control here slug-title">
                                                    <option value="">Chọn kích thước</option>
                                                    @foreach($size as $s)
                                                        <option value="{{$s->size_id}}">{{$s->size_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="error-text text-danger" id="color_id-error"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Màu sắc</label>
                                            <div class="col-12">
                                                <select name="" id="color_id" class="form-control here slug-title">
                                                    <option value="">Chọn màu sắc</option>
                                                    @foreach($color as $c)
                                                        <option value="{{$c->color_id}}">{{$c->color_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="error-text text-danger" id="size_id-error"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Số lượng</label>
                                            <div class="col-12" >
                                                <input type="number" class="form-control" name="" id="quantity">
                                            </div>
                                            <p class="error-text text-danger" id="quantity-error"></p> <!-- Sửa id -->
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
                            <table id="cat_data_table" class="table table-variant">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Màu sắc</th>
                                    <th>Kích thước</th>
                                    <th>Số lượng</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($show->variants as $variant)
                                    <tr data-id="{{$variant->product_variant_id}}">
                                        <td>{{$loop->index}}</td>
                                        <td class="color_id">{{$variant->color->color_name}}</td>
                                        <td class="size_id">Size {{$variant->size->size_name}}</td>
                                        <td class="quantity">{{$variant->quantity}}</td>
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
                                                    <a class="dropdown-item variants"
                                                       data-idVariant="{{$variant->product_variant_id}}"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#variantModal"
                                                       href="javascript:void(0)">Sửa</a>
                                                    <button class="dropdown-item delete-variant"
                                                            data-id="{{$variant->product_variant_id}}">Xóa</button>
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
    </div>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
