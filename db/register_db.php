<?php
require_once('connection.php');

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
$mysqli->set_charset("utf8");

$uname = $_POST['username'];
$name  = $_POST['name'];
$surname  = $_POST['surname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$passwd = md5($_POST['password']);
$cpass = md5($_POST['re_password']);
$user_group = $_POST['user_group'];

$sql = "INSERT 
            INTO users (username,passwd,user_name,user_surname,email,phone,user_group) 
            VALUES (?, ?, ?, ?, ?, ?, ? )";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssss", $uname,$passwd, $name,$surname,$email,$phone,$user_group);
   
    $stmt->execute();
    // echo $stmt->affected_rows . " row inserted. ";
    echo '<script>alert("This Registration completed and Can login")</script>';
    header("location: ../login.php");