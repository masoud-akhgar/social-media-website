
<?php
session_start();
?>

<!doctype html>
<head>
    <title>SignUp SOSO</title>
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
    <link rel="stylesheet" type="text/css" href="loginStyle/css/main.css">
    <!--===============================================================================================-->
</head>

<?php
include "sys_config.class.php";

require_once "DateUtils.inc.php";
require_once "SharedClass.class.php";
require_once "UI.inc.php";


$mysql = pdodb::getInstance();
$query = "select Status from sadaf.ManageStatus where FacilityStatusID = 1;";
$res = $mysql->Execute($query);
if($rec=$res->Fetch())
{
    if($rec['Status'] == 0){
        include "forbidden_sign_up.html";
        die();
    }
//    else{
//        HTMLBegin();
//    }
}

$message_array = [];
$username = "";
$password = "";
$password_repeat = "";
$email = "";
$pfname = "";
$validation = true;
$OTP = null;


if(isset($_REQUEST["submit"]))
{
    $username = $_REQUEST["UserID"];
    $password = $_REQUEST["UserPassword"];
    $password_repeat = $_REQUEST["UserPasswordRepeat"];
    $email = $_REQUEST["UserEmail"];
    $pfname = $_REQUEST["pfname"];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message_array[0] = "فرمت ایمیل نادرست است";
        $validation = false;
    }

    if (!preg_match('/^[a-zA-Z0-9]{4,}$/', $username)){
        $message_array[1] = "نام کاربری باید شامل حداقل 4 کاراکتر باشد";
        $validation = false;
    }

    if (!preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', $password)){
        $message_array[2] = "کلمه رمز باید شامل حداقل 8 حرف انگلیسی بزرگ و کوچک و عدد باشد";
        $validation = false;
    }

    if ($password != $password_repeat){
        $message_array[3] = "کلمه رمز با تکرار آن مطابقت ندارد";
        $validation = false;
    }

    $mysql->Prepare("Select username, email from sadaf.user where username = ? OR email = ?");
    $res = $mysql->ExecuteStatement(array($username,$email));

    if($trec = $res->fetch())
    {
        if($trec['UserEmail'] == $email){
            $message_array[4] = "این آدرس ایمیل قبلا ثبت شده است";
            $validation = false;

        }

        if($trec['UserID'] == $username){
            $message_array[5] = "این نام کاربری قبلا ثبت شده است";
            $validation = false;
        }
    }
    if($validation){

        $mysql = pdodb::getInstance();

        $mysql->Prepare("Insert into sadaf.profile
						    (username, name, bio) values (?, ?, ?)");
        $res = $mysql->ExecuteStatement(array($username, $pfname, "hello i'm ".$pfname));

        $mysql->Prepare("Select userid from sadaf.profile
						    where name=? and username=?");
        $res = $mysql->ExecuteStatement(array($pfname, $username));



        if($trec = $res->fetch())
        {
            $password_hashed = md5($password);

//            date_default_timezone_set("Asia/Tehran");
//            $date = date('Y/m/d h:i:s', time());

            $mysql->Prepare("Insert into sadaf.user (username, pass, email) values (?, ?, ?)");
            $res = $mysql->ExecuteStatement(array($username, $password, $email));
            echo "sssss";
        }

        $_SESSION["UserID"] = $username;
        $_SESSION["UserEmail"] = $email;
        header("Location: login.php");
//        echo "<script>document.location='EmailAuthentication.php';</script>";
//        send_email($email);
        die();
    }
}

function erase_val(&$myarr) {
    $myarr = array_map(create_function('$n', 'return null;'), $myarr);
}

function send_email($email_address){

//    $OTP = rand (1000000 , 9999999);
    $OTP = 1;
    $_SESSION["OTP"] = $OTP;
    $to = $email_address;
    $subject = "Sadaf system activation code";
    $txt = "کاربر گرامی سلام. کد فعال سازی زیر مربوط به حساب کاربری شما در سیستم سدف می باشد.". "\n\n".$OTP ;
    mail($to, $subject, $txt);

}

function console_log( $data ){echo '<script>'.'console.log('. json_encode( $data ) .')'.'</script>';}

?>

<body>

<div class="container-fluid">
    <? if($message_array) {
    foreach($message_array as $msg){
    ?>
    <div class="row">
        <div class="col-1" ></div>
        <div class="col-10" >
            <div class="alert alert-danger well" role="alert"><?php echo $msg; ?></div>
        </div>
        <div class="col-1" ></div>
    </div>
</div>
<? }} ?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url(loginStyle/images/bg-01.jpg);">
                        <span class="login100-form-title-1">
                            Sign Up
                        </span>
            </div>

            <form class="login100-form validate-form" method="post">
                <div class="wrap-input100 validate-input m-b-26" data-validate="Name is required">
                    <span class="label-input100">Name</span>
                    <input class="input100" type="text" name="pfname" id="pfname" placeholder="Enter name" value= <?php
                    echo $pfname;
                    ?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="UserID" id="UserID" placeholder="Enter username" value=<?php echo $_SESSION["UserID"];
                    $_SESSION["UserID"] = null; ?>>
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

                <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" name="UserEmail" id="UserEmail" placeholder="Enter email" value=<?php
                    echo $email;
                    ?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button name="submit" type="submit" class="login100-form-btn" onclick=<?php
                    erase_val($message_array);
                    ?>>
                        Register
                    </button>
                </div>
            </form>
        </div>
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

