<?php
include('header.inc.php');
?>
<html dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/main.css">
<style>
    .rcorners {
        border-radius: 25px;
        border: 2px solid darkslategrey;
        padding: 20px;
        width: 600px;
        height: 300px;
        margin-left:auto;
        margin-right:auto;
        margin-top: 20px;
    }

    img {

        border-radius: 4px;
        padding: 5px;
        width: 20px;
        height: 20px;
    }

    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }

</style>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.search-box input[type="text"]').on("keyup input", function(){
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("backend-search.php", {term: inputVal}).done(function(data){
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>

</head>
	<body >
   </body>
<ul>
<div style="position:relative">
    <div style="float:right; margin-right: 30px; x">
        <?php
        $mysql = pdodb::getInstance();
        $res = $mysql->Execute("select * from sadaf.post where userId in
        (select followedId from sadaf.follow where followingID = 2)");
        while($rec = $res->fetch())
        {
            if($rec["image"] != null && $rec["text"] != null){
                echo "<div class=\"rcorners\"><p>".$rec["username"]."</p>
                        <img src='.\profileImg\profile.png'>
                        <img>".$rec["image"]."</img>
                        <p style='direction: rtl'>".$rec["text"]."</p>
                        <img src='.\images\like.png' style='margin-left: 10px; margin-top: 190px'> 
                        <img src='.\images\comment.png'style='margin-left: 10px; margin-top: 190px'></div>";

            }

            if($rec["image"] != null && $rec["text"] == null)
                echo "<div class=\"rcorners\"><p>".$rec["username"]."</p><img>".$rec["image"]."
                        <img src='.\images\like.png' style='margin-left: 10px; margin-top: 190px'> 
                        <img src='.\images\comment.png'style='margin-left: 10px; margin-top: 190px'></div>";

            else
                echo "<div class=\"rcorners\"><p>".$rec["username"]."</p>
                        <img src='.\profileImg\profile.png'>
                        <p style='direction: rtl'>".$rec["text"]."</p>
                        <img src='.\images\like.png' style='margin-left: 10px; margin-top: 190px'> 
                        <img src='.\images\comment.png'style='margin-left: 10px; margin-top: 190px'></div>";

        }
        ?>
    </div>

    <div style="float:right; margin-right: 60px; margin-top: 30px ">

        <div class="search-box">
            <form action="" method="GET">
                <input type="text" name="query" />
                <input type="submit" name="submit" value="Search" />
            </form>
        </div>

        <?php

        if(isset($_GET['submit'])){
            if(empty($_GET['query'])){
                echo "Enter a search term";
            }

            $query=$_GET['query'];
            $mysql = pdodb::getInstance();
            $res = $mysql->Execute("select * from sadaf.user where username like '%$query%' ");

            while($rec = $res->fetch()) {
                echo "<div> ". $rec['username'] ." </div>";
            }
        }
        ?>


        <?php
        $mysql = pdodb::getInstance();
        $res = $mysql->Execute("select * from sadaf.post where 
                                postId in (select postId from sadaf.likes  group by postId having count(*) > 10 )");
        echo "<div style='margin-left:auto;margin-right:auto;'>trends</div>";
        while($rec = $res->fetch())
        {
            if($rec["image"] != null && $rec["text"] != null){
                echo "<div class=\"rcorners\"><p>".$rec["username"]."</p><img>".$rec["image"]."</img>
                        <p style='direction: rtl'>".$rec["text"]."</p>
                        <img src='.\images\like.png' style='margin-left: 10px; margin-top: 190px'> 
                        <img src='.\images\comment.png'style='margin-left: 10px; margin-top: 190px'></div>";

            }

            if($rec["image"] != null && $rec["text"] == null)
                echo "<div class=\"rcorners\"><p>".$rec["username"]."</p><img>".$rec["image"]."
                        <img src='.\images\like.png' style='margin-left: 10px; margin-top: 190px'> 
                        <img src='.\images\comment.png'style='margin-left: 10px; margin-top: 190px'></div>";

            else
                echo "<div class=\"rcorners\"><p>".$rec["username"]."</p><p style='direction: rtl'>".$rec["text"]."</p>
                        <img src='.\images\like.png' style='margin-left: 10px; margin-top: 190px'> 
                        <img src='.\images\comment.png'style='margin-left: 10px; margin-top: 190px'></div>";
        }
        ?>



</div>
</ul>
</html>


