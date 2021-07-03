<?php
session_start();

// Include the database configuration file
include "sys_config.class.php";
require_once "DateUtils.inc.php";
require_once "SharedClass.class.php";
require_once "UI.inc.php";



$statusMsg = '';


// File upload path
$targetDir = "profileImg/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


if(isset($_POST["submit"]) && !empty($_FILES["image"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');

    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if (move_uploaded_file($_FILES['image']['tmp_name'],$targetFilePath)){
            // Insert image file name into database

            $mysql = pdodb::getInstance();
            $mysql->Prepare("select * from sadaf.user where userId=?");

            $res = $mysql->ExecuteStatement(array($_SESSION['UserID']));

            if($trec = $res->fetch())
            {
                session_start();
                $_SESSION["UserName"] = $trec["username"];

                $mysql->Prepare("Insert into sadaf.profile (profileimage) values (?) where userId = ?");
                $res = $mysql->ExecuteStatement(array( $fileName, $_SESSION['UserID']));
                if($res){
                    $statusMsg = "The photo ".$fileName. " has been uploaded successfully.";
                }else{
                    $statusMsg = "File upload failed, please try again.";
                }
            }
            else
                $message = "Sorry, you are not a valid user.";
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
?>
