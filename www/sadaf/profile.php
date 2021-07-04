<?php
include('header.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="" href="./css/bootstrap.min.css">
    <title>Social Network</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="loginStyle/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginStyle/css/util.css">
    <link rel="stylesheet" type="text/css" href="loginStyle/css/style.css">
    <!--===============================================================================================-->
</head>

<?php

$mysql = pdodb::getInstance();
$mysql->Prepare("select * from sadaf.profile where userId=?");
$res = $mysql->ExecuteStatement(array($_SESSION['UserID']));

if ($trec = $res->fetch()) {
    $userId = $trec['userId'];
    $name = $trec['name'];
    $username = $trec['username'];
    $profimage = $trec['profileimage'];
    $bio = $trec["bio"];
} else
    $message = "This person is not valid.";

if(isset($_REQUEST["change"]))
{
    $username = $_REQUEST["UserName"];
    $password = $_REQUEST["UserPassword"];
    $password_repeat = $_REQUEST["UserPasswordRepeat"];
    $fname = $_REQUEST["fname"];


    if (!preg_match('/^[a-zA-Z0-9]{4,}$/', $username)){
        $message_array[1] = "Username must have 4 characters at least.";
        $validation = false;
    }

    if (!preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', $password)){
        $message_array[2] = "Password must have 8 characters at least that include uppercase, lowercase & numbers.";
        $validation = false;
    }

    if ($password != $password_repeat){
        $message_array[3] = "Password & repeat password aren't same.";
        $validation = false;
    }

    $mysql->Prepare("Select username from sadaf.user where username = ? and userId != ?");
    $res = $mysql->ExecuteStatement(array($username, $_SESSION['UserID']));

    if($trec = $res->fetch())
    {
        if($trec['username'] == $username){
            $message_array[5] = "This username is already registered.";
            $validation = false;
        }
    }
    if($validation){

        $mysql = pdodb::getInstance();

        $mysql->Prepare("UPDATE sadaf.profile SET
						    (username, name, bio) values (?, ?, ?)");
        $res = $mysql->ExecuteStatement(array($username, $fname, "hello i'm ".$fname));

        $mysql->Prepare("Select userid from sadaf.profile
						    where name=? and username=?");
        $res = $mysql->ExecuteStatement(array($fname, $username));



        if($trec = $res->fetch())
        {
            $password_hashed = md5($password);

            $mysql->Prepare("Insert into sadaf.user (username, pass) values (?, ?)");
            $res = $mysql->ExecuteStatement(array($username, $password));
        }

        $_SESSION["UserName"] = $username;
        header("Location: main.php");
        die();
    }
}


?>

<body style="background-color:rgb(230, 252, 252) ">
<?php include("header-top.php")?>

<div class="w-100" style="height:70px;"></div>
<div class=" d-flex" style="direction:rtl;: left">
    <?php include("right_side.php");?>
</div>
<div class="profile2">
    <div class="profile2-banner">
        <div class="text-center content-middle">
            <b><?php echo $bio ?> </b>
        </div>
    </div>

    <div class="profile2-picture">
        <?php echo "<a href=''><img src= $profimage ></a>"?>

        <?php echo "<span> $name </span>"?>
        <br>
        <?php echo "<small> ($username) </small>"?>
        <br>
    </div>

    <div class="wrap-login100 shadow-bottom">
        <form class="login100-form validate-form" method="post">
            <div class="wrap-input100 validate-input m-b-26" data-validate="Name is required">
                <span class="label-input100">Name</span>
                <input class="input100" type="text" name="fname" id="fname" placeholder="Enter name" value= <?php
                echo $fname;
                ?>>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                <span class="label-input100">Username</span>
                <input class="input100" type="text" name="UserName" id="UserName" placeholder="Enter username" value=<?php echo $_SESSION["UserName"]; ?>>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-26">
                <span class="label-input100">Bio</span>
                <input class="input100" type="text" name="Bio" id="Bio" placeholder="Enter bio" value=<?php echo $bio; ?>>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                <span class="label-input100">Password</span>
                <input class="input100" type="password" name="UserPassword" id="UserPassword" placeholder="Enter password" value=<?php
                echo $password;
                ?>>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-18" data-validate = "Repeat Password is required">
                <span class="label-input100">Re-Password</span>
                <input class="input100" type="password" name="UserPasswordRepeat" id="UserPasswordRepeat" placeholder="Enter re-password" value=<?php
                echo $password_repeat;
                ?>>
                <span class="focus-input100"></span>
            </div>

            <div class="container-login100-form-btn">
                <button name="change" type="submit" class="login100-form-btn" onclick=<?php
                erase_val($message_array);
                ?>>
                    Register
                </button>
            </div>
        </form>
    </div>

</div>

<!--===============================================================================================-->
<script src="loginStyle/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="loginStyle/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="loginStyle/vendor/bootstrap/js/popper.js"></script>
<script src="loginStyle/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="loginStyle/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="loginStyle/vendor/daterangepicker/moment.min.js"></script>
<script src="loginStyle/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="loginStyle/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="loginStyle/js/main.js"></script>

</body>

</html>