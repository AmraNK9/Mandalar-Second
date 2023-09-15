<?php
session_start();
include_once "controller/registerController.php";
$registercontroller = new RegisterController;
$getuserlist = $registercontroller->getUserList();


if (isset($_POST['register'])) {
    $error_status = false;

    if (!empty($_POST['fname'])) {
        $fname = $_POST['fname'];
    } else {
        $error_status = true;
    }

    if (!empty($_POST['lname'])) {
        $lname = $_POST['lname'];
    } else {
        $error_status = true;
    }

    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $error_status = true;
    }

    if (!empty($_POST['pass'])) {
        $password = $_POST['pass'];
        // $password=md5($eny_pass);
        // Check password length
        if (strlen($password) < 6) {
            $error_status = true; // Set error status to true
        }

        // Check for at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            $error_status = true; // Set error status to true
        }

        // Check for at least one lowercase letter
        if (!preg_match('/[a-z]/', $password)) {
            $error_status = true; // Set error status to true
        }

        // Check for at least one number
        if (!preg_match('/\d/', $password)) {
            $error_status = true; // Set error status to true
        }
    } else {
        $error_status = true;
    }

    if (empty($_POST['agree-term'])) {
        $error_status = true;
    }

    //create img
    if (empty($_FILES['image']['name'])) {
        $filename = "mylove.jpg";
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

    // else{
    //     echo "file type is not allowed";
    // }

    $acc_exits = false;
    if (isset($email)) {
        // check exit or not
        foreach ($getuserlist as $key => $users_email) {
            # code...
            if ($email == $users_email["email"]) {
                $acc_exits = true;
                $error_status = true;
                break;
            }
        }

        if ($acc_exits == true) {
            $exitsAcc = "Your Account is Aready Exits";
        }
    }

    if ($error_status == false) {
        $fullname=$fname." ".$lname;
        $registercontroller->registerUser($filename, $fname, $lname, $email, $password,$fullname);
        $user_id = $registercontroller->getUserId($email);
        $_SESSION['user_id'] = $user_id[0]['user_id'];
        
        if (isset($_SESSION["user_id"])) {
            header("location:home.php");
        }

    }


}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <!-- <link rel="stylesheet" href="css/material-design-iconic-font.min.css"> -->

    <!-- Main css -->
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="mdbbootstrap/css/mdb.min.css">
    <link rel="stylesheet" href="css/registerandlogin.css">
    <link rel="stylesheet" href="css/register.css">
</head>

<body>


    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form " id="register-form" enctype="multipart/form-data">

                        <div class="field image d-flex  justify-content-center align-items-center mb-4">
                            <div id="cross" class="d-none ">

                                <i class="fa-solid fa-xmark fa-xl cancel-icon  "></i>
                            </div>
                            <img src="image/pjimg/user_php.jpg" class="img-circle mb-4" id="show_photo" alt="">

                            <div class="d-flex  justify-content-center align-items-center cover-icon">
                                <i class="fa-solid fa-camera fa-xl camera_icon" style="color: #4e9c81;"></i>
                            </div>
                            <!-- hidden file -->
                            <div class="hideinputfile">
                                <input type="file" name="image" id="inputphoto" class="d-none">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group mt-5">
                            <label for="name"><i class="fa-solid fa-user"></i></label>
                            <input type="text" name="fname" id="fname" placeholder="First Name"
                                value="<?php if (isset($fname))
                                    echo $fname ?>" />
                            </div>
                            <div class="form-group ">
                                <label for="name"><i class="fa-solid fa-user"></i></label>
                                <input type="text" name="lname" id="lname" placeholder="Last Name"
                                    value="<?php if (isset($lname))
                                    echo $lname ?>" />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fa-solid fa-envelope"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"
                                    value="<?php if (isset($email))
                                    echo $email ?>" />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="fa-solid fa-lock"></i><i  class="fa-solid fa-eye" id="togglePassword"></i></label>
                                <input type="password" name="pass" id="passwordInput" placeholder="Password" />
                                
                            </div>
                            <span id="passwordRequirements" class='text-danger'></span>
                            <span class="text-danger">
                            <?php if (isset($exitsAcc))
                                    echo $exitsAcc; ?>
                        </span>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term">
                                I agree all
                                statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <button type="submit" name="register" id="signup" class="btn btn-primary"
                                value="Register">Register</button>
                            <!-- <input type="submit"  /> -->
                        </div>
                    </form>
                </div>
                <div class="signup-image"  width="100%">
                    <figure><img src="image/pjimg/1 (1).jpeg" alt="sing up image" ></figure>
                    <a href="login.php" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
    <!-- <script src="js/main.js"></script> -->
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="mdbbootstrap/js/mdb.min.js"></script>
    <script src="js/register_img.js"></script>
    <!-- <script src="js/pass-show-hide.js"></script> -->

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>