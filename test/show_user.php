<?php
// echo "<pre>";
//     print_r($_POST);
//      echo"</pre>";
require_once('db/connection.php');
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
$mysqli->set_charset("utf8");

//เช็คว่ามีการส่งค่ามาหรือเปล่า

    $sql = "SELECT *
    FROM users
    ORDER BY ID_users ASC
    ";
    
    $result = $mysqli->query($sql);
    // เก็บตัวแปลไว้ จากการได้ข้อมูลจากการ query
    $all_data = array();
    // วนลูปข้อมูล
    while($row = $result->fetch_object()){
        $all_data[]=$row;
    }
    //ทดสอบการแสดงผล
    // echo "<pre>";
    // print_r($search_data);
    //  echo"</pre>";
    //แปลงเป็นJson เพื่อส่งข้อมูลกลับไป
    echo json_encode( $all_data);





?>