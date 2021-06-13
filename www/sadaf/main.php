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
</style>

</head>
	<body >
   </body>
<ul>
<?php
$mysql = pdodb::getInstance();
$res = $mysql->Execute("select * from sadaf.post where userId in
(select followedId from sadaf.follow where followingID = 2)");
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

<?php
$mysql = pdodb::getInstance();
$res = $mysql->Execute("select * from sadaf.likes group by postId order by count(*) desc limit 10 ")
?>
</ul>
</html>
