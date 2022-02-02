<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    $username = $_SESSION['username'];
  header("location: login.php");
} else {
    if($_SESSION['user_group'] == "A"){
        header("location: admin/admin_info.php"); //เเยกuser
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
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin/index-articles.php">บทความ</a></li>
                     </ul>
                    

                     <i class="bi bi-person-circle"></i> <b><?php echo $_SESSION["username"]; ?></b>  &nbsp; &nbsp;
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
        <header class="bg-dark  py-4"  >
        <br>
      </header>
        <!-- Section-->
       
        <marquee bgcolor="#CE6F5B" onmouseover="this.stop();" onmouseout="this.start();"><i class="bi bi-bell-fill"></i>โปรดระมัดระวังมิจฉาชิพ.. การพบเจอหรือการส่งของหายโปรดขอข้อมูลเพื่อยืนยันตัวตนทุกครั้ง</marquee>
        <section class="py-5">
            
        <!-- search -->
        <div class="container ">
        <h2 align='center'><i class='fas fa-user' style='font-size:36px'></i><b><u> ข้อมูลบัญชี</b></u></h2>
        <div align="right"class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                แจ้ง
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="create_found.php">แจ้งพบของหาย</a></li>
                <li><a class="dropdown-item" href="create_lost.php">แจ้งของหาย</a></li>
            </ul>
            <a class="btn btn-warning" href="user_edit.php" role="button">แก้ไขข้อมูลส่วนตัว</a>
        </div>
        
        <?php $q = (isset($_GET['q']) ? $_GET['q'] : ''); ?>
        <form action="user_info.php" method="get" class="d-flex">
          <input class="me-2" type="text" name="q" >
          <button class="btn btn-outline-success" type="submit">ค้นหา</button>
        </form>
        <h5 align='left'><i class='fas fa-user' style='font-size:36px'></i> <b>รายการแจ้งของหาย <a class="btn btn-outline-info" href="user_info2.php" role="button">สลับรายการ</a></b></h5>
         </div>
         <!-- ------------------search----------------- -->
<?php
if($q==''){
            
        // connect database 
      require_once('db/connection.php');

      $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
      $mysqli->set_charset("utf8");

      // check connection error 
      if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
      } else {
      // connect success, do nothng
      }

      // select data from tables
      // $limit = ($_GET['limit']<>"")? $_GET['limit'] : 10;
      $user_id = $_SESSION['user_id'];
      $sql = "SELECT *
        FROM item_lost il INNER JOIN users u
        ON user_id = u.ID_users 
        WHERE u.ID_users = $user_id
        ORDER BY date DESC";
      $result = $mysqli->query($sql);

      if (!$result) {
        echo ("Error: ". $mysqli->error);
        
      } else {
      ?>

      

    <div class="container px-4 px-lg-5 mt-5" >
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left" >
      <?php while($row = $result->fetch_object()){ ?>
        
        
            <!-- card -->
            
                
                
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" style="width:300;height:200px;"src="upload/<?php echo $row->image ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body ">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row->name ?></h5>
                                    <!-- Product price-->
                                </div>
                                <p style="text-indent:10px;"><?php echo $row->title ?><p>
                                <div class="text-left">
                                   วันที่-เวลา <?php echo $row->date ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="item_detail.php?id=<?php echo $row->ID_Item?>">รายละเอียด</a></div>
                                
                               
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-warning mt-auto" href="edit_item_lost.php?id=<?php echo $row->ID_Item?>">แก้ไข</a>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <a class="btn btn-danger mt-auto" onclick="return confirm('คุณต้องการที่จะลบรายการหรือไม่?');" href="db/delete_item_lost.php?id=<?php echo $row->ID_Item?>">ลบ</a>
                                </div>
                            </div>
                            
                        </div>
                    </div> 
                
            
      <?php
      }
      
      ?>
      <?php
      
    }
}else if($q!=''){
     // connect database 
     require_once('db/connection.php');

     $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
     $mysqli->set_charset("utf8");

     // check connection error 
     if ($mysqli->connect_errno) {
     echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
     } else {
     // connect success, do nothng
     }

     // select data from tables
     // $limit = ($_GET['limit']<>"")? $_GET['limit'] : 10;

     
     $sql = "SELECT *
       FROM item_lost il INNER JOIN users u
       ON user_id = u.ID_users 
       WHERE title LIKE '%$q%' OR name LIKE '%$q%'
       ORDER BY date DESC";
     $result = $mysqli->query($sql);

     if (!$result) {
       echo ("Error: ". $mysqli->error);
       
     } else {
     ?>

     

     <div class="container px-4 px-lg-5 mt-5">
                
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left" >
     <?php while($row = $result->fetch_object()){ ?>
        <!-- card -->
         <!-- card -->
         <div class="col mb-5" >
         <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" style="width:300;height:200px;"src="upload/<?php echo $row->image ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body ">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row->name ?></h5>
                                    <!-- Product price-->
                                </div>
                                <p style="text-indent:10px;"><?php echo $row->title ?><p>
                                <div class="text-left">
                                   วันที่-เวลา <?php echo $row->date ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="item_detail.php?id=<?php echo $row->ID_Item?>">รายละเอียด</a></div>
                                
                               
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-warning mt-auto" href="edit_item_lost.php?id=<?php echo $row->ID_Item?>">แก้ไข</a>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <a class="btn btn-danger mt-auto" onclick="return confirm('คุณต้องการที่จะลบรายการหรือไม่?');" href="db/delete_item_lost.php?id=<?php echo $row->ID_Item?>">ลบ</a>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div> 
            
            <?php
            }
            ?>
            <?php
     }
            }
       
?>


            
        </section>
       
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        
        
    </body>
</html>
