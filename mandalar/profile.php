<?php
    error_reporting(0);

     session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:home.php");
}
    include_once "nav.php";

    include_once "controller/profileController.php";
    include_once "controller/userController.php";
    include_once "controller/nrcController.php";
    include_once "controller/kpayController.php";
    include_once "./controller/postController.php";
    include_once "./model/post.php";
    $post_model = new Post();

    $post_controller = new PostController();
    $post_list = $post_controller->getPostList();

    // var_dump($post_list);


    $getalluserlist = new ProfileController();
    $getAllUser = $getalluserlist->getUserList();

    $enterNrcimg = new NrcController();



    $updateUserDetails = new UserController();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        //  echo $user_id;
        //  echo "//////////";
    }

    
    $post_controller = new PostController();
    $getuserpost = $post_controller->getUserList($user_id);
    $sold_out_post = $post_controller->get_sold_out_post($user_id);
    if (isset($getuserpost)) {
        //  var_dump($getuserpost);
        // foreach ($sold_out_post as $key => $sold_post) {
        //     //    var_dump($sold_post) ;
        // }
    }

    // var_dump($sold_out_post);







    foreach ($getAllUser as $key => $user) {
        if ($user['user_id'] == $_SESSION["user_id"]) {
            $userid = $user['user_id'];
            $userfname = $user["fname"];
            $userlname = $user["lname"];
            $userbio = $user['bio'];
            $useremail = $user['email'];
            $userimg = $user['img'];
            // $userbio = $user['bio'];
            $userwallet = $user["wallet"];
            // echo $user_id;
        }
    }
    $getNrcUser = $enterNrcimg->getAll();
    //  var_dump($getNrcUser);
    $wait = null; // Set a default value before the loop
    foreach ($getNrcUser as $key => $wait) {
        //  echo $wait['to_id']."/////////////";
        if ($wait['to_id'] == $userid) {
            $wait = $wait["status"];
        } else {
            $wait = 2;
        }
    }

    // echo $wait."/////////////";

    // if($wait==2)
    // {
    //     echo $wait,"ssssssssss";
    //     echo "/";
    // }

    // echo $wait;
    // $wait = null; // Set a default value before the loop

    // foreach ($getNrcUser as $key => $waitItem) {
    //     if ($waitItem['to_id'] == $userid) {
    //         $wait = $waitItem['status']; // Update the value of $wait
    //         echo $wait;
    //     }else{
    //         $wait=2;
    //     }
    // }





    $getPersonalInfo = $updateUserDetails->UserInfo($_SESSION['user_id']);
    // var_dump($getPersonalInfo);
    // echo $getPersonalInfo[0]['img'];


    // save change btn


    //update NRCNumber
    if (isset($_POST['enterNRC'])) {
        $error = false;
        if (isset($_POST['nrcNumber'])) {
            $nrcNumber = $_POST['nrcNumber'];
            //echo $nrcNumber;
        } else {
            $error = true;
        }

        if (isset($_FILES['fimg'])) {
            $frontfilename = $_FILES['fimg']['name'];
            $filesize = $_FILES['fimg']['size'];
            $allowed_files = ['jpg', 'png', 'jpeg', 'svg'];
            $temp_path = $_FILES['fimg']['tmp_name'];

            $fileinfo = explode('.', $frontfilename);
            $filetype = end($fileinfo);
            $maxsize = 2000000000;
            if (in_array($filetype, $allowed_files)) {
                if ($filesize < $maxsize) {
                    move_uploaded_file($temp_path, 'image/user_nrc/front_nrc/' . $frontfilename);
                } else {
                    echo "file size exceeds maximum allowed";
                }
            }
        } else {
            $error = true;
        }


        if (isset($_FILES['bimg'])) {
            $backfilename = $_FILES['bimg']['name'];
            // echo $filename;
            $filesize = $_FILES['bimg']['size'];
            $allowed_files = ['jpg', 'png', 'jpeg', 'svg'];
            $temp_path = $_FILES['bimg']['tmp_name'];
            $fileinfo = explode('.', $backfilename);
            $filetype = end($fileinfo);
            $maxsize = 2000000000;
            if (in_array($filetype, $allowed_files)) {
                if ($filesize < $maxsize) {
                    move_uploaded_file($temp_path, 'image/user_nrc/back_nrc/' . $backfilename);
                } else {
                    echo "file size exceeds maximum allowed";
                }
            }
        } else {
            $error = true;
        }

        if ($error == false) {

            $Nrc = $enterNrcimg->enterNrc($userid, $nrcNumber, $frontfilename, $backfilename);

            // echo $nrcNumber;
            //  header("Location: " . $_SERVER['PHP_SELF']);
            //  exit();
            // echo '<script>window.location.reload();</script>';
            // header("Location: " . $_SERVER['PHP_SELF']);
            // Check if a refresh has already been triggered
            echo '<script>';
            echo 'if (!localStorage.refreshed) {';
            echo '  window.location.reload();';
            echo '  window.location.reload();';
            echo '  localStorage.refreshed = "true";'; // Set a flag to indicate that the page has been refreshed
            echo '}';
            echo '</script>';
        }

        // $wait = 4;
        // echo $wait;
    }


    // edit
    if (isset($_POST["save"])) {
        $error_status = false;
        if (!empty($_POST["update_fname"])) {
            $update_fname = $_POST["update_fname"];
        } else {
            $error_status = true;
        }

        if (!empty($_POST["update_lname"])) {
            $update_lname = $_POST["update_lname"];
        } else {
            $error_status = true;
        }


        if (empty($_POST['update_bio'])) {
            $update_bio = $getPersonalInfo[0]['bio'];
        } else {
            $update_bio = $_POST['update_bio'];
        }


        if (empty($_FILES['image']['name'])) {
            $filename = $getPersonalInfo[0]["img"];
        } else {
            $filename = $_FILES['image']['name'];
            $filesize = $_FILES['image']['size'];
            $allowed_files = ['jpg', 'png', 'jpeg', 'svg'];
            $temp_path = $_FILES['image']['tmp_name'];

            $fileinfo = explode('.', $filename);
            $filetype = end($fileinfo);
            $maxsize = 2000000000;
            if (in_array($filetype, $allowed_files)) {
                if ($filesize < $maxsize) {
                    move_uploaded_file($temp_path, 'image/user-profile/' . $filename);
                } else {
                    echo "file size exceeds maximum allowed";
                }
            }
        }


        if ($error_status == false) {
            $fullname = $update_fname . " " . $update_lname;
            $updateUser = $updateUserDetails->UpdateUser($userid, $update_fname, $update_lname, $update_bio, $filename, $fullname);
            $getAllUser = $getalluserlist->getUserList();
            // header("Location: " . $_SERVER['PHP_SELF']);
            // echo "<script>";
            // echo "localStorage.refreshed = 'false'";
            // echo "if(!localStorage.refreshed){";

            // echo "location.reload();";
            // echo "localStorage.refreshed = 'true';";
            // echo "}";
            // echo "</script>";
            // exit;

        }
    }
    foreach ($getAllUser as $key => $user) {
        if ($user['user_id'] == $_SESSION["user_id"]) {
            $userid = $user['user_id'];
            $userfname = $user["fname"];
            $userlname = $user["lname"];
            $userbio = $user['bio'];
            $useremail = $user['email'];
            $userimg = $user['img'];
            // $userbio = $user['bio'];
            $userwallet = $user["wallet"];
            // echo $user_id;
        }
    }
    //kpay
    if (isset($_POST["sand_money"])) {
        $error_status = false;
        if (isset($_POST['amount'])) {
            $amount = $_POST['amount'];
        } else {
            $error = true;
        }

        if (isset($_POST['kpay_phonenumber'])) {
            $kpay_phone = $_POST['kpay_phonenumber'];
        } else {
            $error = true;
        }

        if (isset($_POST['kpay_name'])) {
            $kpay_name = $_POST['kpay_name'];
        } else {
            $error = true;
        }

        if (isset($_FILES['kpayimg'])) {
            $kpay_img = $_FILES['kpayimg']['name'];
            // echo $kpay;
            $filesize = $_FILES['kpayimg']['size'];
            $allowed_files = ['jpg', 'png', 'jpeg', 'svg'];
            $temp_path = $_FILES['kpayimg']['tmp_name'];

            $fileinfo = explode('.', $kpay_img);
            $filetype = end($fileinfo);
            $maxsize = 2000000000;
            if (in_array($filetype, $allowed_files)) {
                if ($filesize < $maxsize) {
                    move_uploaded_file($temp_path, 'image/kpay_img/' . $kpay_img);
                } else {
                    echo "file size exceeds maximum allowed";
                }
            }
        } else {
            $error = true;
        }


        if ($error_status == false) {
            $enterWallet = $updateUserDetails->enterKpay($userid, $amount, $kpay_name, $kpay_phone, $kpay_img);
        }
    }


    $getKpay_history = new kpayController();
    $getKpay = $getKpay_history->getTransfarhistory($user_id);
    $nottodays=$getKpay_history->getNotToday($user_id);

    // foreach ($getKpay as $key => $gettransfer) {
                            
    //     $transferDate = strtotime($gettransfer["date"]); // Convert date to timestamp
    //     $currentDate = strtotime(date("Y-m-d")); // Get current date timestamp
    
    //     // Extract first 5 digits from timestamps
    //     $transferDateDigits = substr($transferDate, 0, 5);
    //     $currentDateDigits = substr($currentDate, 0, 5);

    //     if ($transferDateDigits === $currentDateDigits) {
    //         $dateText = "Today";
    //     } elseif ($transferDate === strtotime("-1 day", $currentDate)) {
    //         $dateText = "Yesterday";
    //     } else {
    //         $dateText = date("d", $transferDate); // Get day of the month (2-digit)
    //     }
    //     if ($transferDateDigits === $currentDateDigits) {
    //         $todayTransfers[] = $gettransfer; // Add transfers matching "Today" to the array
    //     } elseif ($transferDate === strtotime("-1 day", $currentDate)) {
    //         $yesterdayTransfers[] = $gettransfer; // Add transfers matching "Yesterday" to the array
    //     }
    //  }

    //  foreach($todayTransfers as $today){
    //     var_dump($today);
    //  }
    foreach ($getKpay as $key => $gettransfer) {
        $transferDate = strtotime($gettransfer["date"]); // Convert date to timestamp
        $currentDate = strtotime(date("Y-m-d")); // Get current date timestamp
    
        // Convert both timestamps to date strings without the time component
        $transferDateString = date("Y-m-d", $transferDate);
        $currentDateString = date("Y-m-d", $currentDate);
    
        if ($transferDateString === $currentDateString) {
            $todayTransfers[] = $gettransfer; // Add transfers matching "Today" to the array
        } elseif ($transferDate === strtotime("-1 day", $currentDate)) {
            $yesterdayTransfers[] = $gettransfer; // Add transfers matching "Yesterday" to the array
        }
    }
    
    // foreach ($todayTransfers as $today) {
    //     var_dump($today);
    // }
    
    ?>
    <link rel="stylesheet" href="mdbbootstrap/css/mdb.min.css">

    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/search.css" />

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <style>
        a {
            color: #ffffff;

        }

        .card-body {
            color: black
        }

        .soldOut {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 9999999;

            color: red;
        }

        .soldOut h2 {
            width: 260px;
            text-align: center;
            margin-top: 75px;
            margin-left: 20px;
            padding: 4px;
            border: 2px dashed red;
            background-color: #21252979;
            transform: rotate(-35deg);
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }




        /* Hide the scrollbar in webkit-based browsers */
        ::-webkit-scrollbar {
            width: 0.1em;
            /* Width of the scrollbar */
        }

        ::-webkit-scrollbar-track {
            background: transparent;
            /* Track background color */
        }

        ::-webkit-scrollbar-thumb {
            background: transparent;
            /* Scrollbar thumb color */
        }

        * {
            height: auto;
        }

        .swiper-slide {
            height: calc(100%-200px);
            min-height: 0px;
            overflow-y: scroll;
        }
    </style>

    <body>
        <input type="text" value="<?php echo $wait; ?>" name="refresh" id="refresh" class="d-none">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 " style="height: 200px; border-top-left-radius:1em; border-top-right-radius:1em; background-color:#627E8B">

                </div>
            </div>
            <div class="row bg-white shadow" style="height:340px; border-bottom-left-radius:1em; border-bottom-right-radius:1em">
                <!-- profile -->
                <div class="col-md-12">
                    <div class="userprofile">
                        <img src="image/user-profile/<?php echo $userimg; ?>" alt="" class="userimg ml-3">
                    </div>

                    <div id="" class="checkposition d-flex align-items-center justify-content-center">

                        <i class="fa-solid fa-check  <?php if ($wait == 0 || $wait == 2 || $wait==4) {
                                                            echo "d-none";
                                                        } ?>" style="color: #ffffff;"></i>

                        <i class="fa-solid fa-exclamation <?php if ($wait == 1) {
                                                                echo "d-none";
                                                            } ?> " style="color: #FF0000;"></i>

                    </div>

                    <div class="dropdown float-end mt-4 mr-3">

                        <a href="" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical fa-xl  text-muted"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editprofilemodel" href="#">Edit Profile</a></li>
                            <li><a class="dropdown-item" data-mdb-toggle="modal" data-mdb-target="#withdraw" href="#">Withdraw</a></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Log Out</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    
                    <h3 class="username">
                        <?php echo $userfname . " " . $userlname; ?>
                    </h3>
                    <h5 class="address text-muted mb-4">Mandalay, Myanmar</h5>
                    <h6 class="address text-muted mb-4">
                        <?php if (!empty($userbio)) {
                            echo $userbio;
                        } else {
                            echo "No Bio ....";
                        } ?>
                    </h6>
                    <i class="fa-brands fa-square-facebook fa-xl icon" style="color: #3b5998;"></i>
                    <i class="fa-brands fa-square-twitter fa-xl icon" style="color: #1da1f2;"></i>
                    <i class="fa-brands fa-square-google-plus fa-xl icon" style="color: #4285f4;"></i>
                    <div class="money d-flex align-items-center">
                        <i class="fa-solid fa-circle-plus mx-2 text-white"  data-mdb-toggle="modal" data-mdb-target="#money_modal"></i>
                        <!-- <input type="text" disabled class="money_box text-white  move text-right bg-transparent" value="<?php if (isset($userwallet)) {
                                                                                                                                    echo $userwallet;
                                                                                                                                } else {
                                                                                                                                    echo 0;
                                                                                                                                } ?>"> -->
                        <p class="money_box text-white  move text-center"><?php if (isset($userwallet)) {
                                                                                echo $userwallet;
                                                                            } else {
                                                                                echo 0;
                                                                            } ?></p>
                    </div>
                    <?php include_once "withdraw.php"; ?>
                    <!-- Modal -->
                    <div class="modal fade" id="money_modal" tabindex="-1" data-mdb-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <p>Kpay Phone Number : 09751047472</p>
                                        <p>Kpay Name : U Kyaw Kyaw</p>
                                        <div class="form-outline mt-3">
                                            <input type="text" id="form13" class="form-control your_amount" name="amount" value="" />
                                            <label class="form-label" for="form13">Enter Your Amount</label>
                                        </div>
                                        <span class="text-danger error_amount"></span>

                                        <div class="form-outline mt-3">
                                            <input type="text" id="form13" class="form-control your_pho" name="kpay_phonenumber" />
                                            <label class="form-label" for="form13">Enter Your Kpay Phone Number</label>
                                        </div>
                                        <span class="text-danger error_phone"></span>

                                        <div class="form-outline mt-3">
                                            <input type="text" id="form13" class="form-control your_kpayName" name="kpay_name" />
                                            <label class="form-label" for="form13">Enter Your Kpay Name</label>
                                        </div>
                                        <span class="text-danger error_kpayName"></span>
                                        <br>
                                        <label for="" class="mt-3">Enter Your </label>
                                        <div class="my-3 d-flex justify-content-center kpay_show_box ">
                                            <img src="" alt="" id="show_kpay_img" required>
                                            <div class="plus">
                                                <i class="fa-solid fa-plus" id="add_Kpay"></i>
                                            </div>
                                        </div>
                                        <input type="file" name="kpayimg" class="d-none" id="Kpay_img" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="send_kpayinfo" name="sand_money">Send</button>
                                    </div>
                            </div>
                            </form>

                        </div>
                    </div>
                    <div class="allbtn d-flex">
                        <!-- Button trigger modal -->
                        <!-- <button type="button" class="btn btn-primary" data-mdb-toggle="modal"
                            data-mdb-target="#exampleModal">
                            Launch demo modal
                        </button> -->
                        <!-- $wait !== 2 || $wait == 0 || -->
                        <button type="button" class="btn btn-danger <?php if ($wait == null  || $wait == 2 || $wait == 4) {
                                                                        echo ' ';
                                                                    } else {
                                                                        echo 'd-none';
                                                                    } ?> Leepal" id="verify" data-mdb-toggle="modal" data-mdb-target="#vmodal">Verify Your Account</button>


                        <!-- Modal -->
                        <form action="" id="NRC_form" method="post" enctype="multipart/form-data">
                            <div class="modal fade" id="vmodal" tabindex="-1" data-mdb-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Verify Your Account</h5>
                                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-outline red mb-4 px-4">
                                                <input type="text" id="" name="nrcNumber" class="form-control" value="" />
                                                <label class="form-label " for="form12">Enter Your NRC Number</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="" class="mb-2 ">Enter Your Front NRC</label>
                                                    <div class="fimage-container border border-1 rounded-3  " style="height: 300px;">
                                                        <img src="" class="" style="width: 100%; height:100%;object-fit:cover;">
                                                    </div>
                                                    <input type="file" name="fimg" class="d-none" id="selfrontimg" required>
                                                    <i class="fa-solid fa-plus plus-signfront" id="fplus"></i>

                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <label for="" class="mb-2 ">Enter Your Back NRC</label>
                                                    <div class="bimage-container border border-1 rounded-3  " style="height: 300px;">
                                                        <img src="" class="" style="width: 100%; height:100%;object-fit:cover;">
                                                    </div>
                                                    <input type="file" class="d-none" name="bimg" id="selbackimg" required>
                                                    <i class="fa-solid fa-plus plus-signback" id="bplus"></i>
                                                </div>
                                                <p class="text-danger"><?php if (!empty($error)) {
                                                                            echo "Plz Fill Correctly";
                                                                        } ?></p>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary" name="cancelmodel" data-mdb-dismiss="modal" id="canceljs">Cancle</button>
                                            <button type="submit" class="btn btn-primary" name="enterNRC" id="NRCbtn">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <button class="btn btn-success <?php if ($wait == 0 && $wait !== null) {
                                                            echo  '';
                                                        } else {
                                                            echo "d-none";
                                                        }  ?>" disabled id="wait">Waiting</button>

                        <!-- <button class="logout btn btn-danger ms-3">Log Out</button> -->
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="editprofilemodel" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row text-center">
                            <!-- cross btn -->
                            <div id="cross" class="d-none">
                                <i class="fa-solid fa-xmark fa-xl cancel-icon  "></i>
                            </div>
                            <div class=" d-flex justify-content-center">
                                <img src="image/user-profile/<?php echo $userimg; ?>" alt="" name="" class="edituserimg ml-3 ">
                            </div>
                            <!-- hidden file -->
                            <div class="hideinputfile">
                                <input type="file" name="image" id="inputphoto" class="d-none">
                            </div>
                            <div class="col-md-12 mt-5 d-flex">
                                <div class="col-md-6 ">
                                    <input type="text" class="text-center border-bottom hideborder" name="update_fname" placeholder="Enter First Name" id="updateuser_fname" value="<?php echo $userfname ?>">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="text-center border-bottom hideborder" name="update_lname" placeholder="Enter Last Name" id="updateuse_lrname" value="<?php echo $userlname ?>">
                                </div>
                            </div>
                            <!-- <div class="col-md-12 mt-3">
                        <input type="text" class="text-center border-bottom hideborder" name="" id="" value="" placeholder="<?php if (!empty($userbio)) {
                                                                                                                                echo $userbio;
                                                                                                                            } else {
                                                                                                                                echo "Describe yourself...";
                                                                                                                            } ?>">
                    </div> -->
                            <div class="col-md-12 mt-3">
                                <input type="text" class="text-center border-bottom hideborder" name="update_bio" id="" value="" placeholder="<?php if (!empty($userbio)) {
                                                                                                                                                    echo $userbio;
                                                                                                                                                } else {
                                                                                                                                                    echo "Describe yourself...";
                                                                                                                                                } ?>">
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" name="save" class="btn btn-info" id="saveChangeBtn">Save changes</button>
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <section class="mt-3">
            <div class="container overflow-hidden">
                <div class="flitter-tab">
                    <div class="navbar">
                        <ul class="nav-list">
                            <li class="nav-item active" data-tab="0">
                                Post
                            </li>
                            <li class="nav-item" data-tab="1">
                                Sold Out Post
                            </li>
                            <li class="nav-item" data-tab="2">
                                Deposit History
                            </li>
                            <li class="nav-item" data-tab="3">
                                buy post
                            </li>
                            <li class="nav-item" data-tab="4">
                                Withdraw History
                            </li>
                            <!-- Add more navigation items as needed -->
                        </ul>
                    </div>
                </div>


                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide border rounded-4 shadow-4">
                            <div class="tab-content ">
                                <?php if (isset($getuserpost)) { ?>
                                    <!-- Product Cards -->
                                    <section id="products" class="">

                                        <div class="row ">
                                            <?php foreach ($getuserpost as $post) {
                                                # code...
                                            ?>

                                                <a href="#" data-user-id="<?php echo $user_id ?>" data-post-id="<?php echo $post['id'] ?>" class="view_btn col-md-4 col-sm-6  col-lg-3 mb-4 " onclick="AddCount(event)">
                                                    <div class="card product-card-by-nay">
                                                        <?php
                                                        $images = glob('image/post_img/' . $post['photo_folder'] . '/*.{jpg,png,gif,jpeg,jiff}', GLOB_BRACE);
                                                        ?>
                                                        <img src="<?php echo $images[0] ?>" class="card-img-top product-image" alt="Product 1" />
                                                        <div class="card-body">
                                                            <div class=" product-card-title">
                                                                <h5>
                                                                    <?php echo $post['item'] ?>

                                                                </h5>
                                                                <h5>
                                                                    <?php echo $post['price']  ?> Ks
                                                                </h5>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="image/user-profile/<?php echo $post['user_img'] ?>" class="rounded-circle profile-on-card" alt="Seller 1" />
                                                                    <span class="ml-2 card-text">
                                                                        <?php echo $post['full_name']; ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $count_react = $post_model->getPostReaction($post['id']);
                                                            $count_favorite = $post_model->getPostFavorite($post['id']);
                                                            ?>
                                                            <div class=" product-info-box">
                                                                <div>
                                                                    <i class="fa-solid fa-thumbs-up"></i>

                                                                    <span class="reaction-count"><?php echo $count_react['count_react'] ?></span>
                                                                </div>
                                                                <div>
                                                                    <i class="far fa-heart mr-2"></i>
                                                                    <span class="save-count"><?php echo $count_favorite['count_favorite'] ?></span>
                                                                </div>
                                                                <?php $viewCount =  $post_model->selectViewCount($post['id']) ?>
                                                                <div>
                                                                    <i class="far fa-eye ml-3"></i>
                                                                    <span class="view-count"><?php echo $viewCount['view_count'] ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>

                                            <?php } ?>
                                        </div>
                                    </section>
                                <?php } else { ?>
                                    <div class="d-flex align-items-center justify-content-center mt-5">
                                        <img src="../mandalar/image/some/no sell post.png" alt="">
                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                        <!-- sold out post -->
                        <div class="swiper-slide border rounded-4 shadow-4">
                            <div class="tab-content ">
                                <?php if (isset($sold_out_post)) { ?>
                                    <!-- Product Cards -->
                                    <section id="products" class="">

                                        <div class="row ">
                                            <?php foreach ($sold_out_post as $post) {
                                                # code...
                                            ?>

                                                <a href="#" data-user-id="<?php echo $user_id ?>" data-post-id="<?php echo $post['id'] ?>" class="view_btn col-md-4 col-sm-6  col-lg-3 mb-4 " onclick="AddCount(event)">
                                                    <div class="soldOut">
                                                        <h2>Sold Out</h2>
                                                    </div>
                                                    <div class="card product-card-by-nay">
                                                        <?php
                                                        $images = glob('image/post_img/' . $post['photo_folder'] . '/*.{jpg,png,gif,jpeg,jiff}', GLOB_BRACE);
                                                        ?>
                                                        <img src="<?php echo $images[0] ?>" class="card-img-top product-image" alt="Product 1" />
                                                        <div class="card-body">
                                                            <div class=" product-card-title">
                                                                <h5>
                                                                    <?php echo $post['item'] ?>

                                                                </h5>
                                                                <h5>
                                                                    <?php echo $post['price']  ?> Ks
                                                                </h5>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="image/user-profile/<?php echo $post['user_img'] ?>" class="rounded-circle profile-on-card" alt="Seller 1" />
                                                                    <span class="ml-2 card-text">
                                                                        <?php echo $post['fname'] . " " . $post['lname'] ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $count_react = $post_model->getPostReaction($post['id']);
                                                            $count_favorite = $post_model->getPostFavorite($post['id']);
                                                            ?>
                                                            <div class=" product-info-box">
                                                                <div>
                                                                    <i class="fa-solid fa-thumbs-up"></i>

                                                                    <span class="reaction-count"><?php echo $count_react['count_react'] ?></span>
                                                                </div>
                                                                <div>
                                                                    <i class="far fa-heart mr-2"></i>
                                                                    <span class="save-count"><?php echo $count_favorite['count_favorite'] ?></span>
                                                                </div>
                                                                <?php $viewCount =  $post_model->selectViewCount($post['id']) ?>
                                                                <div>
                                                                    <i class="far fa-eye ml-3"></i>
                                                                    <span class="view-count"><?php echo $viewCount['view_count'] ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>

                                            <?php } ?>
                                        </div>
                                    </section>
                                <?php } ?>
                            </div>
                            
                        </div>
                        <!-- kpay History -->
                        <div class="swiper-slide border rounded-4 shadow-4">
                            <div class="tab-content container">

                                <div class="row">
                                    <?php if (!empty($getKpay) ) {  ?>
                                        <!-- today -->
                                        <?php if(isset($getKpay)){ ?>
                                            <h2>Today</h2>
                                            <?php foreach ($getKpay as $key => $kpay) {
                                                # code...
                                             ?>
                                            <div class="col-md-12 d-flex align-items-center border">
                                                <div  class="col-md-1 d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-money-bill-transfer fa-2xl" style="color:#3b71ca;"></i>
                                                </div>
                                                <div class="col-md-6">
                                                        <p>Transfer To </p>
                                                        <p>Today</p>
                                                        <p><?php echo  $kpay["date"]; ?></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h4>+<?php echo  $kpay["check_wallet"]; ?> Ks</h4>
                                                    </div>
                                            </div>
                                            <?php } ?>
                                        <?php } ?>

                                        
                                    <?php } 
                                     if(!empty($nottodays)){ ?>
                                        <!-- nott0 -->
                                        <?php if(isset($nottodays)){ ?>
                                            <h2>Not Today</h2>
                                            <?php foreach ($nottodays as $key => $kpay) {
                                                # code...
                                             ?>
                                            <div class="col-md-12 d-flex align-items-center border">
                                                <div  class="col-md-1 d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-money-bill-transfer fa-2xl" style="color:#3b71ca;"></i>
                                                </div>
                                                <div class="col-md-6">
                                                        <p>Transfer To </p>
                                                        <p>Not Today</p>
                                                        <p><?php echo  $kpay["date"]; ?></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h4>+<?php echo  $kpay["check_wallet"]; ?> Ks</h4>
                                                    </div>
                                            </div>
                                            <?php } ?>
                                        <?php } ?>
                                        
                                    <?php }
                                    if(empty($getKpay) && empty($nottodays)) { ?>
                                        <div class="d-flex align-items-center justify-content-center mt-5">
                                            <img src="./image/some/no-transfer-money.png" alt="">
                                        </div>


                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        <!-- Add more swiper slides and tab content as needed -->
                        <div class="swiper-slide border rounded-4 shadow-4">
                            <div class="tab-content">
                                <?php include_once "buy_post.php"; ?>
                            </div>
                        </div>
                        <div class="swiper-slide border rounded-4 shadow-4">
                            <div class="tab-content">
                                <?php include_once "withdraw_history.php"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include_once 'seller_info.php' ?>






        <script src="mdbbootstrap/js/mdb.min.js"></script>

        <script src="js/jquery-3.7.0.min.js"></script>

        <!-- <script src="js/loader.js"></script> -->
        <script src="js/profile.js"></script>
        <script src="js/withdraw.js"></script>      
      <script src="js/home.js"></script>

        <script>
            // Initialize Swiper
            var swiper = new Swiper(".swiper-container", {
                slidesPerView: "auto",
                spaceBetween: 0,
            });

            // Get the navigation items
            const navItems = document.querySelectorAll(".nav-item");

            // Add click event listener to each navigation item
            navItems.forEach((item, index) => {
                item.addEventListener("click", () => {
                    // Remove active class from all navigation items
                    navItems.forEach((item) => item.classList.remove("active"));

                    // Add active class to the clicked navigation item
                    item.classList.add("active");

                    // Slide to the corresponding tab
                    swiper.slideTo(index);
                });
            });

            // Update active tab based on swiper slide change event
            swiper.on("slideChange", () => {
                // Get the active slide index
                const activeSlideIndex = swiper.activeIndex;

                // Remove active class from all navigation items
                navItems.forEach((item) => item.classList.remove("active"));

                // Add active class to the corresponding navigation item
                navItems[activeSlideIndex].classList.add("active");
            });
        </script>

    </body>

    </html>
    <?php

    ?>