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
        FROM articles
        WHERE ID_articles  =?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    echo "<script> alert('ลบบทความแล้ว') </script>";
    header("Refresh:0; ../admin/admin_info.php");
}else {
    header("location: ../admin/admin_info.php");
}
?>