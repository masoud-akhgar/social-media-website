<?php
include('header.inc.php');
$mysql = pdodb::getInstance();
$userid = $_SESSION['UserID'];
$result = $mysql->Execute("SELECT * FROM sadaf.user WHERE userId=$userid");
$username = $result->fetch();
if (isset($_POST['liked'])) {
    $postid = $_POST['postid'];
    $result = $mysql->Execute("SELECT * FROM sadaf.post WHERE postId=$postid");
    $row = $result->fetch();

    $mysql->Execute("INSERT INTO sadaf.likes (username, userId, postId, status) VALUES ('".$username['username']."',".$userid.",".$postid." , '1')");
    $result1 = $mysql->Execute("SELECT * FROM sadaf.likes WHERE postId=$postid");
    $num = $result1->fetch();
    echo count($num);
    exit();
}
if (isset($_POST['unliked'])) {
    $postid = $_POST['postid'];
    $result = $mysql->Execute("SELECT * FROM sadaf.post WHERE postId=$postid");
    $row = $result->fetch();

    $mysql->Execute("DELETE FROM sadaf.likes WHERE postId=".$postid." AND userId=".$_SESSION['UserID']);
    $result1 = $mysql->Execute("SELECT * FROM sadaf.likes WHERE postId=$postid");
    $num = $result1->fetch();
    echo count($num);
    exit();
}

?>
<!DOCTYPE html>
<html>

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
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <link rel="stylesheet" href="profile.css">
    <script src="../jquery/jquery-3.4.1.min.js.txt"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="right_script.js"></script>
</head>

<body style="background-color:rgb(230, 252, 252) ">
<?php include("header-top.php")?>

    <div class="w-100" style="height:70px;"></div>
    <div class=" d-flex" style="direction:rtl;: left">
        <?php include("right_side.php");?>
        
    </div>
    <div class="profile2">
            <div class="profile2-banner">
            </div>
            <div class="profile2-picture">
                <a href="" class="follow text-white">Follow <span class="entypo-plus"></span></a>
                <p class="follow text-white" style="margin-left:-140px;font-size:12px;">Following : 123</p>
                <p class="follow text-white" style="margin-left:-280px;font-size:12px;">Followers : 133</p>
                <a href=""><img src="https://i.pravatar.cc/300?img=7"></a>
                <span>Daniel Jack</span>
                <br>
                <small>(Jack Daniel)</small>
                <small class="w-100">Bio located here blablablablblb bal</small>
            </div>

            <div class="profile2-content mt-5">
                <div class="content-middle">
                    <div class="content-md-left">
                        <img src="https://i.pravatar.cc/300?img=7">
                    </div>
                    <div class="content-md-middle">
                        <div class="post-title-name">
                            <a href="post.php">Daniel Jack</a><br>
                        </div>
                        <div class="post-title-time">
                            <a href="post.php">Saturday 13:52</a>
                        </div>
                        <div class="post-desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie eleifend orci non varius. Integer et mauris quis neque blandit sagittis.
                            <br>
                            <img src="./images/Computer.jpg" class="w-100">
                        </div>
                        <div class="mt-5 bg-white w-100 px-2 py-2 shadow-bottom post pl-4">
                            <p class="d-inline" style="font-size: 14px;">like 3 comment 1</p>
                            <div class="w-100">
                                <div class=" kadr w-100 d-flex post-detail">
                                    <p class="text-right detail like">
                                        <a href=""><i class="fa fa-thumbs-up"></i> LIKE</a>
                                    </p>
                                    <p class="text-right detail">
                                        <a href=""><i class="fa fa-comments"></i> COMMENT</a>
                                    </p>
                                    <p class="text-right detail">
                                        <a href=""><i class="fa fa-share"></i> SHARE</a>
                                    </p>
                                </div>
                            </div>
                            <div class="bg-gray comment p-3 shadow-bottom shadow-left">
                                <div class="d-flex">
                                    <img src="./images/profile.png">
                                    <input type="text " class="comment-holder ml-3 mr-1 col-11" placeholder="Write a Comment and press enter">
                                    <i class="fa fa-send mt-2" style="cursor:pointer;font-size:20px"></i>
                                    <!-- <img class="ml-2" src="./images/plus.png"> -->
                                </div>
                            </div>
                        </div>
                        <div class="w-100">
                            <div class="bg-gray comment mt-4 " >
                                <div class="d-flex h-auto">
                                    <img src="./images/profile.png" class="mr-1">
                                    <div style="word-wrap: break-word;">blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa</div>
                                </div>
                            </div>
                            <div class="bg-gray comment mt-4 ">
                                <div class="d-flex h-auto">
                                    <img src="./images/profile.png" class="mr-1">
                                    <div style="word-wrap: break-word;">blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa</div>
                                </div>
                            </div>
                            <div class="bg-gray comment mt-4 ">
                                <div class="d-flex h-auto">
                                    <img src="./images/profile.png" class="mr-1">
                                    <div style="word-wrap: break-word;">blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa blaalalalalal ballalala blaaaa</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>