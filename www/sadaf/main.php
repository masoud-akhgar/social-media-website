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

if (isset($_POST['iscomment'])) {
    $postid = $_POST['postid'];
    $text = $_POST['text'];
    $mysql->Execute("INSERT INTO sadaf.comment (username, userId, postId, comment) VALUES ('".$username['username']."','".$userid."','".$postid."' ,'".$text."')");
    exit();
}

?>

<!DOCTYPE html>
<html>
<style>
    .collapsible {
        /*background-color: #007CC7;*/
        color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        /*border: none;*/
        /*text-align: left;*/
        /*outline: none;*/
        /*font-size: 15px;*/
        /*margin-top: 5px;*/
        /*border-radius: 4px;*/
    }
    .content {
        padding: 5px 18px;
        font-size: 15px;
        display: none;
        overflow: hidden;
        background-color: white;
        direction: rtl;
        text-align: right;

    }
</style>
<head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" href="styles.css">
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
                        <a href="main.php" class="nav-link text-white "> <img class="profile-header" src="asset/images/home.png" alt=""></a>
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
                        <a href="profile.php" class="nav-link text-white">
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
<div class="w-100" style="height:70px;"></div>
<div class=" d-flex" style="direction:rtl;: left">
    <?php include("right_side.php");?>

    <div class="col-3 " style="margin-right:17.6667777%;direction: ltr;">

        <div class="bg-white p-1 px-3 shadow-left trending mt-3">
            <?php
            $mysql = pdodb::getInstance();
            $res = $mysql->Execute("select * from sadaf.post, sadaf.profile  where 
                   sadaf.post.username =  sadaf.profile.username and
                   sadaf.post.postId in (select postId from sadaf.likes  group by postId having count(*) > 10 ) limit 5");
            echo '<p class="titer">Trending !</p>';
            while($rec = $res->fetch())
            {
                echo "<button type='button' class ='btn btn-primary mt-2 collapsible'>"."@". $rec['username'] ."</button>
                        <div class ='content'>
                          <p>".$rec["text"]."</p>
                        </div>";
            }
            //        echo "<button type='button' class='btn btn-outline-dark'>Dark</button>"
            ?>
        </div>
        <div class="bg-white p-1 px-3 shadow-left pb-4 mt-3" style="overflow-y:scroll;height:430px;">
            <div class="d-flex">
                <p class="titer">People you may know</p>
                <a href="" class="offset-6"><img src="asset/images/icons8-replay-30.png" class=" mt-1" style="width: 20px ; height: 20px;"></a>
            </div>
            <?
            $count =0;
            $peoples = $mysql->Execute("SELECT * FROM sadaf.follow,sadaf.profile where sadaf.profile.userId = sadaf.follow.followedId and followingId !=".$userid);
            while($people= $peoples->fetch()){
                if ($count>3)
                    break;
                $count++;
                ?>
                <div class="d-flex mt-2">
                    <div class="w-25" style="left: 0;">
                        <a href="profile.php"><img src="<?echo $people['profileimage']?>" class="w-100" style="height:80px;border-radius: 50%;"></a>
                    </div>
                    <div class="col-9">
                        <p class="titer mt-1" style="font-size:20px;"><? echo $people['username']?></p>
                        <button class="btn btn-primary py-1 shadow-bottom">Follow</button>
                    </div>
                </div>
            <?}?>
        </div>
        <div class="bg-white p-1 px-3 shadow-left  mt-3">
            <p class="titer">Invite your Friends</p>
            <div class=" border border-1 border-black w-100" style="min-height:40px;">
                <input placeholder="E-Mali" class="w-100 Mali pl-1" style="min-height:40px;">
                <a href="" class="btn-primary send pt-1"><i class="fa fa-send text-white mt-1" style="font-size: 20px;"></i></a>
            </div>
            <!-- <img src="asset/images/send.png" style="height: 100%;"> -->
        </div>

    </div>
    <div class="col-5" style="direction: ltr;">
        <?php
        $mysql = pdodb::getInstance();
        $res = $mysql->Execute("select * from sadaf.post, sadaf.profile where 
                                    sadaf.profile.userId=sadaf.post.userId and sadaf.post.userId in
                                   (select followedId from sadaf.follow where followingID =".$_SESSION['UserID'].")");
        while($rec = $res->fetch())
        {
            ?>

            <div>
                <div class="mt-3 bg-white  px-2 py-2 shadow-bottom post pl-4">
                    <div class="d-flex">
                        <img id="profile-post" class="shadow-bottom" src=<?echo $rec["profileimage"]?>>
                        <div class="ml-2">
                            <p class="mt-1" style="font-weight: bold"><?echo $rec['name']?></p>
                            <p class="text-dark" style="font-size:12px;margin-top: -20px;">@<?echo $rec['username']?></p>
                        </div>
                    </div>
                    <p style="text-align: right"><?echo $rec['text']?></p>
                    <br>
                    <? if($rec["image"] != null){?>
                        <div class="w-100" style="height: 500px;overflow: hidden;">
                            <img src="./postImg/<?echo $rec['image']?>" class="img-fluid">
                        </div>
                    <?} ?>
                    <p class="d-inline" style="font-size: 14px;">like 3 comment 1</p>
                    <div class="w-100">
                        <div class=" kadr w-100 d-flex post-detail">

                            <p class="text-right detail">
                                <?
                                $results = $mysql->Execute( "SELECT * FROM sadaf.likes WHERE userId=".$_SESSION['UserID']." AND postId=".$rec['postId']);
                                //
                                $cnt =  intval(count($results->fetch()));
                                if ($cnt>1){ ?>
                                    <span class="unlike fa fa-heart fa-lg"  style="color: red" data-id="<?php echo $rec['postId']; ?>"></span>
                                    <span class="like hide fa fa-heart-o fa-lg" style="color: red" data-id="<?php echo $rec['postId']; ?>"></span>
                                <? }else{ ?>
                                    <!-- user has not yet liked post -->
                                    <span class="like fa fa-heart-o fa-lg" style="color: red" data-id="<?php echo $rec['postId']; ?>"></span>
                                    <span class="unlike hide fa fa-heart fa-lg" style="color: red" data-id="<?php echo $rec['postId']; ?>"></span>
                                <? } ?>
                            </p>
                            <p class="text-right detail">
                                <a href="post.php?post=<?echo $rec['postId']?>"><i class="fa fa-comments"></i> COMMENT</a>
                            </p>
                            <p class="text-right detail">
                                <a href=""><i class="fa fa-share"></i> SHARE</a>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="bg-gray comment p-3 shadow-bottom shadow-left">
                    <div class="d-flex">
                        <img src="<? echo $rec["profileimage"]?>">
                        <input type="text " class="iscomment comment-holder ml-3 mr-1 col-10" placeholder="Write a Comment and press enter" data-id="<?php echo $rec['postId']; ?>" />
                        <i class="fa fa-send mt-2" style="cursor:pointer;font-size:20px"></i>
                        <!-- <img class="ml-2" src="asset/images/plus.png"> -->
                    </div>
                </div>

            </div>
        <?}?>
    </div>
    <?php include("left_side.php")?>
</div>
<script>
    $(document).ready(function() {
        var vis = false;
        $("#dropdownbtn").click(function() {
            if (vis == true) {
                $("#online").css({
                    "visibility": "hidden"
                })
                vis = false;
            } else {
                $("#online").css({
                    "visibility": "visible"
                })
                vis = true;
            }

        });
        $("#group-chats").click(function() {
            $("#group-chats").css({
                "border-color": "red"
            })
            $("#person-chats").css({
                "border-color": "black"
            })
            $(".group-chat").show(200);
            $(".person-chat").hide(200);
            $("#group-pic").attr("src", "asset/images/icons8-user-group-red.png");
            $("#person-pic").attr("src", "asset/images/icons8-person-30.png");
        });
        $("#person-chats").click(function() {
            $(".person-chat").show(200);
            $(".group-chat").hide(200);
            $("#group-pic").attr("src", "asset/images/icons8-user-group-30.png");
            $("#person-pic").attr("src", "asset/images/icons8-person-30-red.png");
            $("#group-chats").css({
                "border-color": "black"
            })
            $("#person-chats").css({
                "border-color": "red"
            })
        });

    });
</script>
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        // when the user clicks on like
        $('.like').on('click', function(){
            var postid = $(this).data('id');
            $post = $(this);

            $.ajax({
                url: 'main.php',
                type: 'post',
                data: {
                    'liked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes_count').text(response + " likes");
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });

        // when the user clicks on unlike
        $('.unlike').on('click', function(){
            var postid = $(this).data('id');
            $post = $(this);

            $.ajax({
                url: 'main.php',
                type: 'post',
                data: {
                    'unliked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes_count').text(response + " likes");
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });
    });

    $(document).ready(function(){
        $('.iscomment').keydown(function(event){
            var keyCode = (event.keyCode ? event.keyCode : event.which);
            if (keyCode == 13) {
                $post = $(this);
                var postid = $(this).data('id');
                var text = $(this).val();
                $.ajax({
                    url: 'main.php',
                    type: 'post',
                    data: {
                        'iscomment': 1,
                        'postid': postid,
                        'text':text
                    },
                    success: function(response){
                        $post.val("");
                        alert('comment added successfully')
                    }
                });
            }
        });
    });
</script>
</body>


</html>