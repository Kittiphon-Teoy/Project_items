<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
} else {
    if($_SESSION['user_group'] == "U"){
        header("location: ../user_info.php"); //เเยกuser
      }
}
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
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        
        
    </head>
    <body >
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!"><h4>Lost-Items</h4></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="index-articles">บทความ</a></li>
                        <li class="nav-item"><a class="nav-link" href="articles.php">เพิ่มบทความ</a></li>
                     </ul>
                    

                     <form class="d-flex" action="admin_info.php">
                        <button class="btn btn-outline-dark"  type="submit">
                        <i class="bi bi-person-circle"></i> <b><?php echo $_SESSION["username"]; ?></b>  
                        </button>
                    </form>
                    &nbsp; 
                    <form class="d-flex" action="../db/logout.php">
                        <button class="btn btn-outline-danger"  type="submit">
                        <i class="bi bi-box-arrow-in-left"></i>
                            Logout
                        
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark  py-4"  >
        <br>
      </header>
      <?php
        // connect database 
      require_once('../db/connection.php');

      $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
      $mysqli->set_charset("utf8");

      // check connection error 
      if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
      } else {
      // connect success, do nothng
      }
      $sql = "SELECT *
         FROM announce ";
      $result = $mysqli->query($sql);
     
      
      if (!$result) {
        echo ("Error: ". $mysqli->error);
        
      }
      $row = $result->fetch_object()
      ?>
      <marquee bgcolor="#CE6F5B" onmouseover="this.stop();" onmouseout="this.start();"><i class="bi bi-bell-fill"></i><?php echo $row->text ?></marquee>
      <section class="py-6">
        
        
        <section class="py-5 text-center container" >
        
            <div class="col-lg-9 col-md-8 mx-auto" style=" border-radius: 5px; padding: 20px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <h1 class="fw-light">จัดการประกาศ</h1>
                <hr>
                <form action="../db/save_announce.php" method="POST" >
                    <div class="mb-3">
                        <label for="title" class="form-label"><b>Announce</label>
                        <textarea class="form-control"  name="text" required   placeholder="ประกาศ..."  required></textarea>
                    </div>
                    
                    <button class="btn btn-success" type="submit" name="submit" onclick="return confirm('กรุณายืนยันข้อมูล');" href="../db/save_announce.php">ยืนยัน</button>
                    <div align="left">
                    <a href="javascript:history.back()" class="btn btn-outline-info active " role="button" aria-pressed="true">ย้อนกลับ</a>
                    </div>
                </form>
            </div>
        
    </section>   
     <!-- Bootstrap core JS-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
        
        
    </body>
</html>