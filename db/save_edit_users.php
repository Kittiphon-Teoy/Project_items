<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
    } 
?>
<html>
<meta charset="UTF-8">
    <?php
    // connect database 
    require_once('connection.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    $user_id =$_POST['user_id'];
    $uname = $_POST['user_name'];
    $name  = $_POST['name'];
    $surname  = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];


   

    $sql = "UPDATE users
            SET 
            username = ?,     
            user_name =?,
            user_surname =?,
            email =?,
            phone =?
         WHERE ID_users   = ?";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssss", $uname , $name, $surname , $email,$phone ,$user_id );
    $stmt->execute();

    echo "<script> alert('เสร็จสิ้น') </script>";
    header("Refresh:0; url=../user_info.php");
   
?>
