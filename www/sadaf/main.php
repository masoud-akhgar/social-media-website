<?php
include('header.inc.php');
?>
<html dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
	<body >
    <p>Users:</p>
   </body>
<ul>
<?php
$mysql = pdodb::getInstance();
$res = $mysql->Execute("select * from sadaf.user");
while($rec = $res->fetch())
{
    echo "<li>".$rec["username"]."</li>";
}
?>
</ul>
</html>