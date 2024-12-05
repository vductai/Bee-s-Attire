<div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="cancelOrderModalLabel">Yêu cầu hủy đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Vui lòng chọn lý do hủy đơn hàng:</p>
                <form id="cancelForm">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cancelReason" id="reason1"
                               value="Không cần sản phẩm nữa">
                        <label class="form-check-label" for="reason1">Không cần sản phẩm nữa</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cancelReason" id="reason2"
                               value="Đặt nhầm sản phẩm">
                        <label class="form-check-label" for="reason2">Đặt nhầm sản phẩm</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cancelReason" id="reason3"
                               value="Tìm thấy giá tốt hơn">
                        <label class="form-check-label" for="reason3">Tìm thấy giá tốt hơn</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cancelReason" id="reason4" value="Khác">
                        <label class="form-check-label" for="reason4">Khác</label>
                    </div>
                    <textarea class="form-control mt-3 d-none" id="otherReason" rows="3"
                              placeholder="Nhập lý do khác..."></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="cr-button btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="cr-button cancel-order"
                        style="background-color:#c41616;"
                        data-orderId=""
                        id="submitCancel">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
