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
        direction: rtl
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
    <img src="www\sadaf\images\like.png">
   </body>
<ul>
<?php
$mysql = pdodb::getInstance();
$res = $mysql->Execute("select * from sadaf.post where userId in
(select followedId from sadaf.follow where followingID = 2)");
while($rec = $res->fetch())
{
    if($rec["image"] != null && $rec["text"] != null){
        echo "<div class=\"rcorners\"><p>".$rec["username"]."</p><img>".$rec["image"]."</img>".$rec["text"]."
                <img src='\www\sadaf\images\like.png'><img src='\www\sadaf\images\comment.png'></div>";

    }

    if($rec["image"] != null && $rec["text"] == null)
        echo "<div class=\"rcorners\"><p>".$rec["username"]."</p><img>".$rec["image"]."</img>
                <img src='\www\sadaf\images\like.png'> <img src='\www\sadaf\images\comment.png'></div>";

    else
        echo "<div class=\"rcorners\"><p>".$rec["username"]."</p>".$rec["text"]."
                <img src='\www\sadaf\images\like.png'> <img src='\www\sadaf\images\comment.png'></div>";

}
?>

</ul>
</html>
