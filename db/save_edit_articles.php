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
$ID_article = $_POST['ID_article'];
$title = $_POST['title'];
$body = $_POST['body'];




if(isset($_POST['submit'])){

    $checktype = $_FILES["file"]["type"];
    $checksize = $_FILES["file"]["size"];
    
    if($checksize == "image/jpg" || $checktype == "image/png" || $checktype == "image/jpeg"){
        if ($checksize < 10000000) { // check file size 1MB
            $dir = "../upload/";
            $fileImage = $dir . basename($_FILES["file"]["name"]);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $fileImage)){
                
            $image = $_FILES["file"]["name"];
          
           
        
          


            $sql = "UPDATE articles
            SET                        
            authors_id = ?,
            image = ?,
            title = ?,
            body = ?
            WHERE ID_articles  = ?";
            
            
            
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sssss", $user_id,$image,$title,$body,$ID_article);
            $stmt->execute();
            $a="pass";    
            
                echo "<script> alert('อัพโหลดเสร็จสิ้น') </script>";
                header("Refresh:0; url=../admin/admin_info.php");
                
        }
        } else {
            echo "<script> alert('ไฟล์ภาพของคุณมีขนาดใหญ่เกิน 10 MB') </script>";
            header("Refresh:0;url=../admin/admin_info.php");
            
        }
    } else {
        echo "<script> alert('โปรดอัพโหลดเป็นไฟล์ภาพ png และ jpg เท่านั้น') </script>";
        header("Refresh:0;url=../admin/admin_info.php");
        
    }  
}else {
    
    header("Refresh:0;url=../admin/admin_info.php");
   
}
if($a!="pass"){
    $sql = "UPDATE articles
    SET                        
    authors_id = ?,
    title = ?,
    body = ?
    WHERE ID_articles  = ?";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $user_id,$title,$body,$ID_article);
    $stmt->execute();
    
   echo "<script> alert('อัพโหลดเสร็จสิ้น') </script>";
   header("Refresh:0; url=../admin/admin_info.php");
}

?>