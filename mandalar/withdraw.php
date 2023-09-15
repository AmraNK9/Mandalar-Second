<form action="" id="withdraw_form">
    <div class="modal fade" id="withdraw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Withdraw</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="" class="form-label">Kpay Name</label>
                        <input id="withdraw_kpay_name" type="text" class="form-control" name="kpay_name">
                        <span id="with_kpay_name_error" class="text-danger d-none">You need to fill Kpay Name!!!</span>
                    </div>
                    <div>
                        <label for="" class="form-label">Kpay Phone No</label>
                        <input id="withdraw_kpay_ph" type="text" class="form-control" name="kpay_ph">
                        <span id="with_kpay_phone_error" class="text-danger d-none">You need to fill Kpay phone No!!!</span>
                    </div>
                    <div>
                        <label for="" class="form-label">Withdraw Amount</label>
                        <input id="withdraw_amount" type="text" class="form-control" name="withdraw_amount">
                        <span id="with_kpay_amount_error" class="text-danger d-none">You need to fill withdraw amount!!!</span>
                        <span id="with_kpay_not_enough_error" class="text-danger d-none">You cant withdraw more than your money!!!</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="withdraw_btn">Withdraw</button>
                </div>
            </div>
        </div>
    </div>
</form>
