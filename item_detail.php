<?php
session_start();

// if (!isset($_SESSION['loggedin'])) {
//     $username = $_SESSION['username'];
//   header("location: login.php");
// } else {
//   //do nothing
// }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>เว็บแจ้งของหาย</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        
    </head>
    <body >
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!"><h4>Lost-Items</h4></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">บทความ</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">บริการแจ้ง</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">แจ้งหายของหาย</a></li>
                                <li><a class="dropdown-item" href="#!">แจ้งพบของหาย</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                    <form class="d-flex" action="user_info.php">
                        <button class="btn btn-outline-dark"  type="submit">
                        <i class="bi bi-people-fill"></i>
                            บัญชี
                        
                        </button>
                    </form>
                    &nbsp;
                    <form class="d-flex" action="db/logout.php">
                        <button class="btn btn-outline-danger"  type="submit">
                        <i class="bi bi-box-arrow-in-left"></i>
                            Logout
                        
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark  py-5"  >
           
      </header>
<!-- data base -->
<?php
    // connect database 
    require_once('db/connection.php');
    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");
if(isset($_REQUEST['id'])){
         $uid = trim($_REQUEST['id']); //ลบช่องว่างที่ส่งมา
         $uid = htmlentities($uid); //เปลี่ยนตัวอักษรให้เป็น HTML กัน script
     

      $sql = "SELECT *
      FROM item_lost
      INNER JOIN users
      ON user_id = users.ID_users
      WHERE ID_Item = ? ";

      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("s",$uid);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_object();
?>
       
      <section class="py-5 container">
      <center><h1>รายละเอียด</h1></center>
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
               
                <h1 class="fw-light"><?php echo $row->name ?></h1>
                <hr>
                <div>
                    <span>Post by <?php echo $row->username ?> at</span>
                    <span class="text-muted">
                    <?php echo $row->date ?>
                    </span>
                    <img src="upload/<?php echo $row->image ?>" class="img-fluid rounded mt-4" alt="" >
                    <p class="my-4"><?php echo $row->detail ?></p>
                </div>
                <h5>reward: <?php echo $row->reward ?></h5>

                <hr>
                <a class="btn btn-secondary" href="javascript:history.back()"><i class="bi bi-arrow-left"></i> Go back</a>
            </div>
        </div>
    </section>
        
            
            
          
            
            
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">จัดทำโดย &copy; นาย กิตติภณ ถนอมสุขสันต์ 61160086</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
<?php
 }else {
  header("location: user_info.php");
}
?>   

   
    </body>
</html>
