<?php
$withdraw_today = $getKpay_history->today_withdraw($user_id);
$withdraw_not_today = $getKpay_history->not_today_withdraw($user_id);
?>


<div class="row">
    <?php if (!empty($withdraw_today)) { ?>
        <!-- today -->
        <?php if (isset($withdraw_today)) { ?>
            <h2>Today</h2>
            <?php foreach ($withdraw_today as $key => $kpay) {
                # code...
                ?>
                <div class="col-md-12 d-flex align-items-center border">
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-money-bill-transfer fa-2xl" style="color:#3b71ca;"></i>
                    </div>
                    <div class="col-md-6">
                        <p>Transfer To </p>
                        <p>Today</p>
                        <p>
                            <?php echo $kpay["date"]; ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h4>-
                            <?php echo $kpay["amount"]; ?> Ks
                        </h4>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>


    <?php }
    if (!empty($withdraw_not_today)) { ?>
        <!-- nott0 -->
        <?php if (isset($withdraw_not_today)) { ?>
            <h2>Not Today</h2>
            <?php foreach ($withdraw_not_today as $key => $kpay) {
                # code...
                ?>
                <div class="col-md-12 d-flex align-items-center border">
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-money-bill-transfer fa-2xl" style="color:#3b71ca;"></i>
                    </div>
                    <div class="col-md-6">
                        <p>Transfer To </p>
                        <p>Not Today</p>
                        <p>
                            <?php echo $kpay["date"]; ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h4>-
                            <?php echo $kpay["amount"]; ?> Ks
                        </h4>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

    <?php }
    if (empty($withdraw_today) && empty($withdraw_not_today)) { ?>
        <div class="d-flex align-items-center justify-content-center mt-5">
            <img src="./image/some/no-transfer-money.png" alt="">
        </div>


    <?php } ?>
</div>