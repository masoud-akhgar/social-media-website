<?php
session_start();
?>

<!doctype html>
<!-- Programmer: Omid MilaniFard -->
<?php
include "sys_config.class.php";
require_once "DateUtils.inc.php";
require_once "SharedClass.class.php";
require_once "UI.inc.php";

HTMLBegin();
$username = $_SESSION["UserID"];
$_SESSION["UserID"] = null;

$message = "";
if(isset($_REQUEST["UserID"]))
{
    // در این نسخه از چارچوب نرم افزاری کلمه عبور به صورت متن خام ذخیره شده است
    // برای نسخه های عملیاتی حتما از رمزنگاری مناسب استفاده شود - مثال: md5
    // می توان از ldap هم استفاده کرد
    $mysql = pdodb::getInstance();
    $mysql->Prepare("select * from sadaf.user where username=? and pass=?");

    $res = $mysql->ExecuteStatement(array($_REQUEST["UserID"], md5($_REQUEST["UserPassword"])));

    if($trec = $res->fetch())
    {
        session_start();
        $_SESSION["UserID"] = $trec["username"];
        $_SESSION["SystemCode"] = 0;
//        $_SESSION["PersonID"] = $trec["PersonID"];
        $_SESSION["UserName"] = $_SESSION["UserID"];
        $_SESSION["LIPAddress"] = ip2long(SharedClass::getRealIpAddr());
        if($_SESSION["LIPAddress"]=="") {
            $_SESSION["LIPAddress"] = 0;
        }
        header("Location: main.php");
        die();
    }
    else
        $message = "نام کاربر یا کلمه عبور نادرست است";
}
?>

<body >
<form method=post>

    <div class="container-fluid">
        <? if($message!="") { ?>
        <div class="row">
            <div class="col-1" ></div>
            <div class="col-10" >
                <div class="alert alert-danger well" role="alert"><?php echo $message; ?></div>
            </div>
            <div class="col-1" ></div>
        </div>
    </div>
    <? } ?>
    <div class="row">
        <div class="col-3" ></div>
        <div class="col-6" >
            <br>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        چارچوب توسعه نرم افزار سدف
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table">
                        <tr>
                            <td>نام کاربری</td>
                            <td><input type=text name=UserID id=UserID class="form-control" value=<?php echo $_SESSION["UserID"];
                                $_SESSION["UserID"] = null; ?>></td>
                        </tr>
                        <tr>
                            <td>کلمه رمز</td>
                            <td><input type=password id=UserPassword name=UserPassword class="form-control"></td>
                        </tr>
                        <tr>
                            <td colspan=2 align=center>
                                <button type="submit" class="btn btn-primary active">ورود</button>
                            </td>
                        </tr>
                    </table>

                    <!-- redirect to password reset page -->
                    <?php
                    if(isset($_GET["newpwd"])){
                        if($_GET["newpwd"] == "passwordupdated"){
                            echo "<p class=''>Your password has been reset!</p>";
                        }
                    }
                    ?>
                    <a href="forgottenpwd/reset-password.php">Forgot your password?</a>
                </div>

            </div>
            <div class="col-3" ></div>
        </div>

</form>
</div>
</body>
