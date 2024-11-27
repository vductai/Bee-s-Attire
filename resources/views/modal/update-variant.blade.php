<!-- Chat Modal -->
<div class="modal fade" id="variantModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatModalLabel">Chỉnh sửa biến thể</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body" id="variantContent">
                <div>
                    <form class="row gx-5">
                        <input type="hidden" id="idVariant" value="">
                        <div class="form-group col">
                            <label>kích thước</label>
                            <div class="col-12">
                                <select name="" id="size_id" class="form-control here slug-title">
                                    <option value="">Chọn kích thước</option>
                                    @foreach($size as $s)
                                        <option value="{{$s->size_id}}">{{$s->size_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="error-text text-danger" id=""></p> <!-- Sửa id -->
                        </div>
                        <div class="form-group col">
                            <label>Màu sắc</label>
                            <div class="col-12">
                                <select name="" id="color_id" class="form-control here slug-title">
                                    <option value="">Chọn màu sắc</option>
                                    @foreach($color as $c)
                                        <option value="{{$c->color_id}}">{{$c->color_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="error-text text-danger" id=""></p>
                        </div>
                        <div class="form-group col">
                            <label>Số lượng</label>
                            <div class="col-12">
                                <input type="number" name="" class="form-control" id="quantity">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="cr-btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
