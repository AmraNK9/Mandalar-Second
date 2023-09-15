<?php
session_start();
include_once "controller/registerController.php";
$registercontroller=new RegisterController;
$getuserlist=$registercontroller->getUserList();
// foreach ($getuserlist as $key => $users_email) {
//     # code...
//     var_dump($users_email["email"]);
// }
if(isset($_POST["signin"]))
{
    $error_status=false;

    if(!empty($_POST['email']))
    {
        $email=$_POST['email'];
    }else
    {
        $error_status=true;
        $error_email="Please Enter Your Email";
    }

    if(!empty($_POST['pass']))
    {
        $password=$_POST['pass'];
    }else
    {
        $error_status=true;
        $error_pass="Please Enter Your PassWord";

    }

    if($error_status==false)
    {
        foreach ($getuserlist as $key => $users) {
            if($users["email"]==$email )
            {
                // echo md5($users["password"]);
                if( $users["password"]==md5($password))
                {
                    $user_id=$registercontroller->getUserId($email);
                    $_SESSION['user_id']=$user_id[0]['user_id'];
                    header("location:home.php");

                    // $_SESSION['email']=$email;
                }else{
                    $invaildpass="Password is not Incorrect";
                }
            }else{
                $invaildemail="This Email is not Sign Up";
            }
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
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="mdbbootstrap/css/mdb.min.css">
    <link rel="stylesheet" href="css/registerandlogin.css">
    <link rel="stylesheet" href="css/register.css">

    <!-- Main css -->
    <!-- <link rel="stylesheet" href="css/registerandlogin.css"> -->
</head>

<body>


    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="image/pjimg/1 (1).jpg" alt="sing up image"></figure>
                    <a href="register.php" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="email"><i class="fa-solid fa-envelope"></i></label>
                                <input type="email" name="email" id="" placeholder="Email" />
                            </div>
                            <span class="text-danger"><?php if(isset($error_email)) echo $error_email; ?></span>
                            <div class="form-group">
                                <label for="your_pass"><i class="fa-solid fa-lock"></i><i  class="fa-solid fa-eye" id="togglePassword"></i></label>
                                <input type="password" name="pass" id="passwordInput" placeholder="Password" />

                            </div>
                            <!-- <i  class="fa-solid fa-eye" id="togglePassword"></i> -->

                            <span class="text-danger"><?php if(isset($error_pass)) echo $error_pass; ?></span>
                            <span class="text-danger"><?php if(isset($invaildemail)) echo $invaildemail; ?> <?php if(isset($invaildpass)) echo $invaildpass; ?></span>
                            <div class="form-group form-button">
                                <button  type="submit" name="signin"  class="btn btn-primary form-submit" >Log In</button>
                                <!-- <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" /> -->
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="fa-brands fa-square-facebook fa-xl" style="color: #3b5998;"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-square-twitter fa-xl" style="color: #1da1f2;"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-square-google-plus fa-xl" style="color: #4285f4;"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- JS -->
        <script src="js/jquery-3.7.0.min.js"></script>
        <!-- <script src="js/jquery.min.js"></script> -->
        <!-- <script src="js/main.js"></script> -->
        <script src="js/register_img.js"></script>
    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->

    </html>