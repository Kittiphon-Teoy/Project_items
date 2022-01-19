<?php
$a="";
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
    } 
require_once('connection.php');

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
$mysqli->set_charset("utf8");

$user_id = $_POST['user_id'];
$ID_item = $_POST['ID_item'];
$name = $_POST['name'];
$title = $_POST['title'];
$date = $_POST['date'];
$detail = $_POST['detail'];
$reward = $_POST['reward'];

if(isset($_POST['submit'])){

    $checktype = $_FILES["file"]["type"];
    $checksize = $_FILES["file"]["size"];
    
    if($checksize == "image/jpg" || $checktype == "image/png" || $checktype == "image/jpeg"){
        if ($checksize < 10000000) { // check file size 1MB
            $dir = "../upload/";
            $fileImage = $dir . basename($_FILES["file"]["name"]);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $fileImage)){
                
            $image = $_FILES["file"]["name"];
          
           
        
          


            $sql = "UPDATE item_lost
            SET                        
            user_id = ?,
            image = ?,
            name = ?,
            title = ?,
            date = ?,
            detail = ?,
            reward = ?
            WHERE ID_item = ?";
            
            
            
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssssssss", $user_id,$image, $name,$title,$date,$detail,$reward,$ID_item);
            $stmt->execute();
            $a="pass";    

                echo "<script> alert('อัพโหลดเสร็จสิ้น') </script>";
                header("Refresh:0; url=../user_info.php");
                
        }
        } else {
            echo "<script> alert('ไฟล์ภาพของคุณมีขนาดใหญ่เกิน 10 MB') </script>";
            header("Refresh:0;../user_info.php");
            
        }
    } else {
        echo "<script> alert('โปรดอัพโหลดเป็นไฟล์ภาพ png และ jpg เท่านั้น') </script>";
        header("Refresh:0;../user_info.php");
        
    }  
}else {
    
    header("Refresh:0;../user_info.php");
   
}
if($a!="pass"){
    $sql = "UPDATE item_lost
    SET                        
    user_id = ?,
    name = ?,
    title = ?,
    date = ?,
    detail = ?,
    reward = ?
    WHERE ID_item = ?";
    
    
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssss", $user_id, $name,$title,$date,$detail,$reward,$ID_item);
    $stmt->execute();
   echo "<script> alert('อัพโหลดเสร็จสิ้น') </script>";
   header("Refresh:0; url=../user_info.php");
}

?>