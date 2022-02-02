<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
    } 
?>
<?php 
    require_once('connection.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

if (isset($_REQUEST['id'])) {
    $id = trim($_REQUEST['id']);
    
    $id = stripslashes($id);
    $id = htmlspecialchars($id);

    $sql = "DELETE 
        FROM users
        WHERE ID_users =?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    echo "<script> alert('ลบผู้ใช้เรียบร้อย') </script>";
    header("Refresh:0; ../user_info.php");
}else {
    header("location: ../user_info.php");
}
?>