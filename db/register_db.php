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

//check user ซ้ำ
$check = "SELECT username
            FROM users
            WHERE username = '$uname'";
    $result = $conn->query($check);
    if ($result->num_rows > 0) {
        echo "<script>";
        echo "alert(' ข้อมูลซ้ำ กรุณาเพิ่มใหม่อีกครั้ง !');";
        echo "window.history.back();";
        echo "</script>";
    }else{
 $sql = "INSERT 
            INTO users (username,passwd,user_name,user_surname,email,phone,user_group) 
            VALUES (?, ?, ?, ?, ?, ?, ? )";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssss", $uname,$passwd, $name,$surname,$email,$phone,$user_group);
    $stmt->execute();
    echo '<script>alert("ลงทะเบียนสำเร็จ สามารถเข้าสู่ระบบ")</script>';
    header("Refresh:0;../login.php");
    }
    
    // echo $stmt->affected_rows . " row inserted. ";
    