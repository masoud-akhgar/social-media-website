<?php
include('header.inc.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>
<style>
    .rcorners {
        border-radius: 25px;
        border: 2px solid darkblue;
        padding: 20px;
        width: 600px;
        height: 500px;
        margin-left:auto;
        margin-right:auto;
        margin-top: 20px;
        background-color: white;
    }

    .tcorners {
        border-radius: 25px;
        padding: 20px;
        width: 400px;
        height: 400px;
        margin-left:20px;
        margin-top: 20px;
    }

    img
    {
        border-radius: 4px;
        padding: 5px;
        width: 50px;
        height: 50px;
    }

    .like
    {
        width: 30px;
        height: 30px;
    }

    .search
    {
        background-color: white;
        width: 350px;
        height: 300px;
        overflow: scroll;
        overflow-x: hidden;
        margin-top: 10px;
        margin-right: 10px;
        border-radius: 7px;
    }

    .post
    {
        background-color: white;
        width: 700px;
        height: 680px;
        overflow: scroll;
        overflow-x: hidden;
        margin-top: 20px;
        margin-right: 20px;
        border-radius: 7px;
    }

    .collapsible {
        background-color: #b4aac6;
        color: black;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        margin-top: 5px;
        border-radius: 4px;
    }

    .content {
        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #b0c1d2;
        direction: rtl

    }

    .postImg{
        width: 300px;
        height: 200px;
        margin-left: 100px;
        margin-top: 20px;
        border-radius: 6px
    }

</style>


<body style="background-color: azure;">

    <!--search box-->
    <div style="position:relative">

        <div style="float:right; margin-right: 10px; margin-top: 30px">
            <div class="search-box" style="margin-right: 20px">
                <form action="" method="GET">
                    <input type="text" name="query" placeholder="search for users" style="width: 250px" />
                    <input type="submit" name="submit" value="Search" />
                </form>
            </div>

            <div class="search">
                <?php

                if(isset($_GET['submit'])){

                if(!empty($_GET['query'])) {
                    $query = $_GET['query'];
                    $mysql = pdodb::getInstance();
                    $res = $mysql->Execute("select * from sadaf.user where username like '%$query%' ");
                }


                    while($rec = $res->fetch())
                    {
                        echo "<div class='d-flex mt-2'>
                            <div class='col-9'>
                                <p class='mt-1'>"."@". $rec['username'] ."</p>
                            </div>
        
                           
                        </div>";

                    }
                }
                ?>
            </div>

            <img src="images/newpost.png"
                 style="margin-left: 40px; margin-top: 50px;width: 100px;height: 100px;">
            <img src="images/home.jpg"
                 style="margin-left: 30px; margin-top: 50px;width: 100px;height: 100px; border-radius: 60px">
        </div>

<!--    user-->
        <div style=" float:left" class='tcorners'>

            <?php

            $mysql = pdodb::getInstance();
            $res = $mysql->Execute("select * from sadaf.profile where userId= 2");
            while($rec = $res->fetch()) {
                echo "<div style='position:relative'>
                       <div style='float:left; margin-right: 5px'><img src=". $rec["profileimage"] ."></div> 
                       <div style= 'float:left; margin-top: 10px' ><b>"."@". $rec['username'] ."<b></div>
                    </div>";
            }
            ?>

            <br>

    <!--    terend-->
            <?php
                $mysql = pdodb::getInstance();
                $res = $mysql->Execute("select * from sadaf.post, sadaf.profile  where 
                   sadaf.post.username =  sadaf.profile.username and
                   sadaf.post.postId in (select postId from sadaf.likes  group by postId having count(*) > 10 ) limit 4");

                echo "<div style='margin-left:140px;margin-right:40px;margin-bottom: 15px;margin-top: 50px'><b>trends</b></div>";
                while($rec = $res->fetch())
                {
                    echo "<button type='button' class ='collapsible'>"."@". $rec['username'] ."</button>
                        <div class ='content'>
                          <p>".$rec["text"]."</p>
                           <img src='.\images\like.png' class='like'> 
                        </div>";
                }
            ?>
        </div>

        <!--post-->
        <div style=" float:right;" class="post">
            <?php
            $mysql = pdodb::getInstance();
            $res = $mysql->Execute("select * from sadaf.post, sadaf.profile where 
                                    sadaf.profile.userId=sadaf.post.userId and sadaf.post.userId in
                                   (select followedId from sadaf.follow where followingID = 2)");
            while($rec = $res->fetch())
            {
                if($rec["image"] != null && $rec["text"] != null)
                {
                    echo "<div class=\"rcorners\">
                            <div style='position:relative' >
                                 <img src=".$rec["profileimage"]." style='float: left;'>
                                 <p>"."@". $rec['username'] ."</p>
                            </div>
                            <p style='direction: rtl'>".$rec["text"]."</p>
                            <div>
                              <img src="."./postImg/".$rec["image"]." class='postImg'>
                            </div>
                            
                            <img src='.\images\like.png' style='margin-left: 10px; margin-top: 50px' class='like'> 
                            <img src='.\images\comment.png'style='margin-left: 10px; margin-top: 50px' class='like'></div>";

                }

                if($rec["image"] != null && $rec["text"] == null)
                    echo "<div class=\"rcorners\">
                            <div style='position:relative' >
                                 <img src=".$rec["profileimage"]." style='float: left;'>
                                 <p >"."@". $rec['username'] ."</p>
                            </div>
                            <div>
                              <img src="."./postImg/".$rec["image"]." class='postImg'>
                            </div>
                            <img src='.\images\like.png' style='margin-left: 10px; margin-top: 50px' class='like'> 
                            <img src='.\images\comment.png'style='margin-left: 10px; margin-top: 50px' class='like'></div>";

                if($rec["image"] == null && $rec["text"] != null)
                    echo "<div class=\"rcorners\">
                            <div style='position:relative' >
                                 <img src=".$rec["profileimage"]." style='float: left;'>
                                 <p>"."@". $rec['username'] ."</p>
                            </div>
                           <br>
                            <p style='direction: rtl'>".$rec["text"]."</p>
                            <img src='.\images\like.png' style='margin-left: 10px; margin-top: 150px' class='like'> 
                            <img src='.\images\comment.png'style='margin-left: 10px; margin-top: 150px' class='like'></div>";

            }
            ?>

        </div>
    </div>

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

</body>
</html>


