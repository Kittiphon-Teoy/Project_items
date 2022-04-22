<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
    } 
require_once('connection.php');

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
$mysqli->set_charset("utf8");

$user_id = $_POST['user_id'];
$name = $_POST['name'];
$title = $_POST['title'];
$detail = $_POST['detail'];
$namesur =$_POST['namesur'];
$mail =$_POST['mail'];
$nphone =$_POST['nphone'];

if(isset($_POST['submit'])){

    $checktype = $_FILES["file"]["type"];
    $checksize = $_FILES["file"]["size"];
    
    if($checksize == "image/jpg" || $checktype == "image/png" || $checktype == "image/jpeg"){
        if ($checksize < 10000000) { // check file size 1MB
            $dir = "../upload/";
            $fileImage = $dir . basename($_FILES["file"]["name"]);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $fileImage)){
            $image = $_FILES["file"]["name"];
          

            $sql = "INSERT 
            INTO item_found (user_id,image,name,title,detail,namesur,mail,nphone) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssssssss", $user_id,$image, $name,$title,$detail,$namesur,$mail,$nphone);
            $stmt->execute();


                echo "<script> alert('อัพโหลดเสร็จสิ้น') </script>";
                header("Refresh:0; url=../user_info2.php");
        }
        } else {
            echo "<script> alert('ไฟล์ภาพของคุณมีขนาดใหญ่เกิน 10 MB') </script>";
            header("Refresh:0;../user_info2.php");
        }
    } else {
        echo "<script> alert('โปรดอัพโหลดเป็นไฟล์ภาพ png และ jpg เท่านั้น') </script>";
        header("Refresh:0;../user_info2.php");
    }  
}else {
   header("location: ../user_info2.php");
}



?>