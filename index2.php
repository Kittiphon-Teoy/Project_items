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
                                <li><a class="dropdown-item" href="#!">แจ้งพบของหาย</a></li>
                                <li><a class="dropdown-item" href="create_lost.php">แจ้งของหาย</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">แสดงรายการ</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">แสดงการแจ้งพบของหาย</a></li>
                                <li><a class="dropdown-item" href="#!">แสดงการแจ้งของหาย</a></li>
                            </ul>
                        </li>
                    </ul>

                    <?php 
                        if (isset($_SESSION['loggedin'])) { $user_id = $_SESSION['user_id']; ?>
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
                    <?php
                    } else { ?>
                         <form class="d-flex" action="login.php">
                        <button class="btn btn-outline-dark"  type="submit">
                        <i class="bi bi-box-arrow-in-left"></i>
                            Login
                        </button>
                    </form>
                    <?php
                    }
                    ?>    


                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark  py-5"  >
            
            <div class="container px-4  px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">ระบบแจ้งของหาย</h1>
                    <p class="lead fw-normal text-white-50 mb-0">ยินดีต้อนรับเข้าสู่ระบบของเรา</p>
                </div>
               
           </div>
      </header>
        <!-- Section-->
        <section class="py-5">
        <!-- search -->
        <div class="container ">
        <h2 align='center'><i class='fas fa-user' style='font-size:36px'></i><b><u> รายการแจ้งพบของหาย</b></u></h2>

        <?php 
        if (isset($_SESSION['loggedin'])) { ?>
        
        <h5 align='right'><i class='fas fa-user' style='font-size:36px;'></i> <i class="bi bi-person-lines-fill"></i> &nbsp; <?php echo $_SESSION["username"]; ?></h5>
        
        <?php
        } else {
          //do nothing
        }
        ?>
        
        
        
        <?php $q = (isset($_GET['q']) ? $_GET['q'] : ''); ?>
        <form action="index2.php" method="get" class="d-flex">
          <input class="me-2" type="text" name="q" >
          <button class="btn btn-outline-success" type="submit">ค้นหา</button>
        </form>
        <h5 align='left'><i class='fas fa-user' style='font-size:36px'></i> <b>รายการแจ้งพบของหาย </b><a class="btn btn-outline-info " href="index.php" role="button" data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-html="true" title="แสดงรายการแจ้งพบของหาย ">สลับรายการ</a></h5>
        
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
      
      $sql = "SELECT *
         FROM item_found il INNER JOIN users u
       ON user_id = u.ID_users 
        ORDER BY date DESC";
      $result = $mysqli->query($sql);
      $count =$result->num_rows;

      if (!$result) {
        echo ("Error: ". $mysqli->error);
        
      } else {
      ?>

      

    <div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
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
                                   
                                   <b>Post by :</b> <a  href="#"  data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-html="true" title="<b>Name</b>=<?php echo $row->user_name ?><br><b>Surname</b>=<?php echo $row->user_surname ?><br><b>Phone</b>=<?php echo $row->phone ?>"><u style="color:red" ><?php echo $row->username ?></u></a>
                                  
                                </div>
                            </div>
                            <!-- Product actions-->
                            
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="item_detail2.php?id=<?php echo $row->ID_Item?>">รายละเอียด</a></div>
                                
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
       FROM item_found il INNER JOIN users u
       ON user_id = u.ID_users 
       WHERE title LIKE '%$q%' OR name LIKE '%$q%'
       ORDER BY date DESC";
     $result = $mysqli->query($sql);

     if (!$result) {
       echo ("Error: ". $mysqli->error);
       
     } else {
     ?>

     

     <div class="container px-4 px-lg-5 mt-5">
                
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
     <?php while($row = $result->fetch_object()){ ?>
        <!-- card -->
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
                                   
                                   <b>Post by :</b> <a  href="#"  data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-html="true" title="<b>Name</b>=<?php echo $row->user_name ?><br><b>Surname</b>=<?php echo $row->user_surname ?><br><b>Phone</b>=<?php echo $row->phone ?>"><u style="color:red" ><?php echo $row->username ?></u></a>
                                  
                                </div>
                            </div>
                            <!-- Product actions-->
                            
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="item_detail2.php?id=<?php echo $row->ID_Item?>">รายละเอียด</a></div>
                                
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
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">จัดทำโดย &copy; นาย กิตติภณ ถนอมสุขสันต์ 61160086</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

<!-- tooltip -->
<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>