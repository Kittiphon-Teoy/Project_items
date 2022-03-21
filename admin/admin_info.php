<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    $username = $_SESSION['username'];
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
                        <li class="nav-item"><a class="nav-link" href="index-articles.php">บทความ</a></li>
                     </ul>
                    

                     <i class="bi bi-person-circle"></i> <b><?php echo $_SESSION["username"]; ?></b>  &nbsp; &nbsp;
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
        <!-- Section-->
       
       
        <section class="py-5">
            
        <!-- search -->
        <div class="container ">
        <h2 align='center'><i class='fas fa-user' style='font-size:36px'></i><b><u> ข้อมูลบัญชี</b></u></h2>
        <div align="right"class="dropdown">
        <a class="btn btn-primary" href="articles.php" role="button">เพิ่มบทความ</a>
        <a class="btn btn-warning" href="manage_users.php" role="button">จัดการผู้ใช้</a>
        <a class="btn btn-info" href="announce.php" role="button">จัดการประกาศ</a>
        </div>
        <h4>บทความ</h4>
        <?php $q = (isset($_GET['q']) ? $_GET['q'] : ''); ?>
        <form action="admin_info.php" method="get" class="d-flex">
          <input class="me-2" type="text" name="q" >
          <button class="btn btn-outline-success" type="submit">ค้นหา</button>
        </form>
       
         </div>
         <!-- ------------------search----------------- -->
<?php
if($q==''){
            
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

      // select data from tables
      // $limit = ($_GET['limit']<>"")? $_GET['limit'] : 10;
      $user_id = $_SESSION['user_id'];
      $sql = "SELECT *
        FROM articles il INNER JOIN users u
        ON authors_id = u.ID_users 
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
                            <img class="card-img-top" style="width:300;height:200px;"src="../upload/<?php echo $row->image ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body ">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row->title ?></h5>
                                    <!-- Product price-->
                                </div>
                                
                                <div class="text-left">
                                   วันที่-เวลา <?php echo $row->date ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent ">
                                <div class="text-center "><a class="btn btn-outline-dark mt-auto container" href="articles_detail.php?id=<?php echo $row->ID_articles ?>">อ่าน</a></div>
                                
                               
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-warning mt-auto" href="edit_articles.php?id=<?php echo $row->ID_articles?>">แก้ไข</a>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <a class="btn btn-danger mt-auto" onclick="return confirm('คุณต้องการที่จะลบบทความหรือไม่?');" href="../db/delete_articles.php?id=<?php echo $row->ID_articles?>">ลบ</a>
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
     require_once('../db/connection.php');

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
        FROM articles il INNER JOIN users u
        ON authors_id = u.ID_users 
       
       WHERE title LIKE '%$q%' OR date LIKE '%$q%'
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
         <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" style="width:300;height:200px;"src="../upload/<?php echo $row->image ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body ">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row->title ?></h5>
                                    <!-- Product price-->
                                </div>
                                
                                <div class="text-left">
                                   วันที่-เวลา <?php echo $row->date ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent ">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto container" href="articles_detail.php?id=<?php echo $row->ID_articles ?>">รายละเอียด</a></div>
                                
                               
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-warning mt-auto" href="edit_articles.php?id=<?php echo $row->ID_Item?>">แก้ไข</a>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <a class="btn btn-danger mt-auto" onclick="return confirm('คุณต้องการที่จะลบบทความหรือไม่?');" href="../db/delete_articles.php?id=<?php echo $row->ID_Item?>">ลบ</a>
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
        <script src="../js/scripts.js"></script>
        
        
    </body>
</html>
