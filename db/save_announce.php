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

    $text =$_POST['text'];
    


   

    $sql = "UPDATE announce
            SET 
            text = ?";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $text  );
    $stmt->execute();

    
    
    header("Refresh:0; url=../admin/announce.php");
   
?>