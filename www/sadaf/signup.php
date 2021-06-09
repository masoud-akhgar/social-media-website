
<?php
session_start();
?>

<!doctype html>

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
    else{
        HTMLBegin();
    }
}

$message_array = [];
$username = "";
$password = "";
$password_repeat = "";
$email = "";
$cardNo = "";
$pfname = "";
$plname = "";
$validation = true;
$OTP = null;


if(isset($_REQUEST["submit"]))
{
    $username = $_REQUEST["UserID"];
    $password = $_REQUEST["UserPassword"];
    $password_repeat = $_REQUEST["UserPasswordRepeat"];
    $email = $_REQUEST["UserEmail"];
    $pfname = $_REQUEST["pfname"];
    $plname = $_REQUEST["plname"];
    $cardNo = $_REQUEST["UserCardNo"];

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

    $mysql->Prepare("Select UserID,UserEmail from sadaf.AccountSpecs
						    where UserID = ? OR UserEmail = ?");
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

        $mysql->Prepare("Insert into sadaf.Persons
						    (pfname, plname, CardNumber) values (?, ?, ?)");
        $res = $mysql->ExecuteStatement(array($pfname, $plname, $cardNo));

        $mysql->Prepare("Select PersonID from sadaf.Persons
						    where pfname=? and plname=?");
        $res = $mysql->ExecuteStatement(array($pfname, $plname));

        if($trec = $res->fetch())
        {
            $password_hashed = md5($password);

            date_default_timezone_set("Asia/Tehran");
            $date = date('Y/m/d h:i:s', time());

            $mysql->Prepare("Insert into sadaf.AccountSpecs
						    (UserID, UserPassword, PersonID, UserEmail, StartDate, Status) values (?, ?, ?, ?, ?, 'InProgress')");
            $res = $mysql->ExecuteStatement(array($username, $password_hashed, $trec["PersonID"], $email, $date));

        }

        $_SESSION["UserID"] = $username;
        $_SESSION["UserEmail"] = $email;

        echo "<script>document.location='EmailAuthentication.php';</script>";
        send_email($email);
        die();
    }
}

function erase_val(&$myarr) {
    $myarr = array_map(create_function('$n', 'return null;'), $myarr);
}

function send_email($email_address){

    $OTP = rand (1000000 , 9999999);
    $_SESSION["OTP"] = $OTP;
    $to = $email_address;
    $subject = "Sadaf system activation code";
    $txt = "کاربر گرامی سلام. کد فعال سازی زیر مربوط به حساب کاربری شما در سیستم سدف می باشد.". "\n\n".$OTP ;
    mail($to, $subject, $txt);

}

function console_log( $data ){echo '<script>'.'console.log('. json_encode( $data ) .')'.'</script>';}

?>

<body>
<form method=post>

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
    <div class="row">
        <div class="col-3" ></div>
        <div class="col-6" >
            <br>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        چارچوب توسعه نرم افزار سدف
                    </div>
                    <div class="caption", style="float: left">
                        ثبت نام
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table">
                        <tr>
                            <td>نام</td>
                            <td><input type=text name=pfname id=pfname class="form-control" value=<?php
                                echo $pfname;
                                ?>></td>
                        </tr>
                        <tr>
                            <td>نام خانوادگی</td>
                            <td><input type=text name=plname id=plname class="form-control" value=<?php
                                echo $plname;
                                ?>></td>
                        </tr>
                        <tr>
                            <td>نام کاربری</td>
                            <td><input type=text name=UserID id=UserID class="form-control" value=<?php
                                echo $username;
                                ?>></td>
                        </tr>
                        <tr>
                            <td>شماره کارت</td>
                            <td><input type=text name=UserCardNo id=UserCardNo class="form-control" value=<?php
                                echo $cardNo;
                                ?>></td>
                        </tr>
                        <tr>
                            <td>کلمه رمز</td>
                            <td><input type=password name=UserPassword id=UserPassword class="form-control" placeholder="حداقل 8 کاراکتر شامل عدد و حروف بزرگ و کوچک انگليسی" <?php
                                echo $password;
                                ?>></td>
                        </tr>
                        <tr>
                            <td>تکرار کلمه رمز</td>
                            <td><input type=password name=UserPasswordRepeat id=UserPasswordRepeat class="form-control" value=<?php
                                echo $password_repeat;
                                ?>></td>
                        </tr>
                        <tr>
                            <td>ایمیل</td>
                            <td><input type=text name=UserEmail id=UserEmail class="form-control" value=<?php
                                echo $email;
                                ?>></td>
                        </tr>
                        <tr>
                            <td colspan=2 align=center>
                                <button name="submit" type="submit" class="btn btn-primary active" onclick=<?php
                                erase_val($message_array);
                                ?>>اعتبارسنجی از طریق ایمیل</button>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="col-3" ></div>
        </div>

</form>
</div>
</body>
