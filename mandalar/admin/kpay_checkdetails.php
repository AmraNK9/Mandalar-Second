<?php
error_reporting(0);
include_once "../controller/kpayController.php";
include_once "../controller/userController.php";


$getAlltrans = new kpayController();
$gettrans = $getAlltrans->getAllTrans();

$getUserName = new UserController();


$checking_id = $_GET["id"];

foreach ($gettrans as $key => $getInfo) {
    if ($checking_id == $getInfo['id']) {
        $userid = $getInfo["user_id"];
        $getAmount = $getInfo["check_wallet"];
        $getphone = $getInfo["kpay_phone"];
        $getName = $getInfo["kpay_name"];
        $getimg = $getInfo["kpay_img"];
        $getdate = $getInfo["date"];
        // $getwallet=$getInfo["wallet"];
    }

}

$getName = $getUserName->UserInfo($userid);
foreach ($getName as $key => $Name) {
    $userName = $Name['fname'] . " " . $Name["lname"];
    $userWallet = $Name["wallet"];

}

if (isset($_POST["accept"])) {
    if (isset($_POST["newAmount"])) {
        $newAmount = $_POST["newAmount"];
    }

    $updateAmount = $userWallet + $newAmount;
    // echo $updateAmount;
    $updateUserAmount = $getUserName->UpdateAmount($userid, $updateAmount);
    $updateStatus = $getAlltrans->UpdateStatus($checking_id);
    header("Location: kpay_checking.php");
    exit();
}

if(isset($_POST["delete_kpay"]))
{
    $deleteKpay=$getAlltrans->deleteKpay($checking_id);
    header("Location: kpay_checking.php");
    exit();
}

include_once "layouts/header.php";
?>

<a href="kpay_checking.php" class="btn btn-secondary mx-5 mt-4" style="width: 100px;">Back</a>

<main class="content">
    <div class="container-fluid  shadow-lg p-3 mb-5 bg-white rounded">

        <div class="mb-3 mx-2">
            <h1 class="h3 d-inline align-middle">Checking Money</h1>
        </div>
        <form action="" method="post">
            <input type="text" class="d-none" name="newAmount" value="<?php echo $getAmount; ?>">
            <div class="container d-flex justify-content-center align-items-center ">
                <div class="row bg-white ">
                    <h4 class="mt-4 mx-2">Account Name :
                        <?php echo $userName; ?>
                    </h4>
                    <h4 class="mt-4 mx-2">Amount :
                        <?php echo $getAmount; ?>
                    </h4>
                    <h4 class="mt-4 mx-2">Phone :
                        <?php echo $getphone; ?>
                    </h4>
                    <h4 class="mt-4 mx-2">Date :
                        <?php echo $getdate; ?>
                    </h4>
                    <!-- <h4 class="my-4 mx-3">id : <?php echo $getphone; ?></h4> -->
                    <div class="col-md-12 d-flex  justify-content-around">

                        <div class="front_img col-md-6">
                            <h5 class="my-3 mx-2">Transform Image</h5>
                            <!-- <label for="" class="col-md-12"></label> -->
                            <img src="../image/kpay_img/<?php echo $getimg ?>" alt=" " class="px-2" width="100%"
                                height="600px">
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <!-- <button class="btn btn-success col-md-1" name="accept">Accept</button>
                        <button type="button" class="btn btn-danger col-md-1 " data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop" id="reject">Reject</button> -->
                        <div class="col-md-12 mt-5 d-flex align-items-center justify-content-center">
                            <button class="btn btn-success col-md-2 mx-3" name="accept">Accept</button>
                            <button type="button" class="btn btn-danger col-md-2" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop" id="reject">Reject</button>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Are you sure delete!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">

                                    <div class="modal-footer d-flex align-items-center justify-content-center">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger" name="delete_kpay">Yes</button>
                                    </div>
                                    </form>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</main>
<script src="../js/jquery-3.7.0.min.js"></script>
<!-- <script src="./js/kpay_checking.js"></script> -->


<?php
include_once "layouts/footer.php";
?>