<?php
include('header.inc.php');
$mysql = pdodb::getInstance();

$mysql->Prepare("select * from sadaf.post where postId= ? ");
$res = $mysql->ExecuteStatement(array($_GET['post']));


$mysql->Prepare("select * from sadaf.comment, sadaf.profile where 
                                    sadaf.profile.userId=sadaf.comment.userId and postId=?");
$res1 = $mysql->ExecuteStatement(array($_GET['post']));
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="../jquery/jquery-3.4.1.min.js.txt"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>







<body style="background-color: azure;">
<header>
    <div class="bg-primary-light shadow-bottom">
        <div class="container d-flex header">
            <div class="logo col-2">
                <p class="mt-3 text-white">Our Social Network !</p>
            </div>
            <div class="asset col-5 text-left">
                <ul class="nav d-flex">
                    <li class="nav-item">
                        <a href="" class="nav-link text-white "> <img class="profile-header" src="asset/images/home.png" alt=""></a>
                    </li>
                </ul>
            </div>
            <div class="text-left col-7">
                <ul class="nav d-flex">
                    <li class="nav-item">
                        <a href="" class="nav-link text-white"><img class="profile-header" src="asset/images/plus.png" alt=""></a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link text-white"><img class="profile-header" src="asset/images/icons8-notification-24.png" alt=""></a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.html" class="nav-link text-white">
                            <?
                            $userid = $_SESSION['UserID'];
                            $userProfile = $mysql->Execute("SELECT * FROM sadaf.profile WHERE userId=$userid");
                            $user = $userProfile->fetch();
                            ?>
                            <div class="d-flex"><img class="profile-header" src="<?echo $user['profileimage']?>">
                                <p class="mt-2 ml-1 text-white"> <?echo $_SESSION['username']?></p>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link text-white"><img src="asset/images/icons8-menu-vertical-50.png" class="w-50 mt-2"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
    <?php include("right_side.php"); ?>
<?
$userProfile = $mysql->Execute("SELECT * FROM sadaf.profile WHERE userId=$userid");
$rec = $userProfile->fetch();
?>
<div class="profile2">
    <div class="profile2-content">
        <div class="content-middle">
            <div class="content-md-left">
                <img src="<?echo $rec["profileimage"]?>">
            </div>
            <div class="content-md-middle">
                <div class="post-title-name">
                    <a href="">Daniel Jack</a><br>
                </div>
                <div class="post-title-time">
                    <a href="">Saturday 13:52</a>
                </div>
                <div class="post-desc">
                    <?echo $res->fetch()['text'];?>
                    <br>
                    <img src="asset/images/Computer.jpg" class="w-100">
                </div>
                <div class="mt-3 bg-white w-100 px-2 py-2 shadow-bottom post pl-4">
                    <p class="d-inline" style="font-size: 14px;">like 3 comment 1</p>
                    <div class="w-100">
                        <div class=" kadr w-100 d-flex post-detail">
                            <p class="text-rights detail like">
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

                    <div class="bg-gray comment p-3 shadow-bottom shadow-left w-100">
                        <div class="d-flex w-100">
                            <img src="<?echo $rec["profileimage"]?>">
                            <input type="text " class="comment-holder ml-3 col-10 mr-1" placeholder="Write a Comment and press enter">
                            <i class="fa fa-send mt-2" style="cursor:pointer;font-size:20px"></i>
                            <!-- <img class="ml-2" src="asset/images/plus.png"> -->
                        </div>
                    </div>
                </div>
                <?
                while ($row = $res1->fetch()) {
                ?>
                <div class="mt-3 w-100  py-2 post" >
                    <hr>
                    <div class="bg-gray comment p-3 w-100">
                        <div class="d-flex">
                            <img id="profile-post" class="shadow-bottom" src=<?echo $row["profileimage"]?>>
                            <div class="ml-2">
                                <p class="mt-1" style="font-weight: bold"><?echo $row['name']?></p>
                                <p class="text-dark" style="font-size:12px;margin-top: -20px;">@<?echo $row['username']?></p>
                            </div>
                        </div>
                        <p><?echo $row['comment']?> </p>
                    </div>
                </div>
                <?}?>
            </div>
        </div>
    </div>
</div><br><br><br><br>
</body>

</html>
