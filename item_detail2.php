<?php
session_start();

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
        <!-- print -->
        <link rel="stylesheet" type="text/css" href="css/print.css">
        

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
                        <?php  if(isset($_SESSION['loggedin']) AND $_SESSION['user_group'] == "U"){?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">บริการแจ้ง</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="create_found.php">แจ้งพบของหาย</a></li>
                                <li><a class="dropdown-item" href="create_lost.php">แจ้งของหาย</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">แสดงรายการ</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="index2.php">แสดงการแจ้งพบของหาย</a></li>
                                <li><a class="dropdown-item" href="index.php">แสดงการแจ้งของหาย</a></li>
                            </ul>
                        </li>
                        <?php
                        }else{
                            
                        }
                        ?>
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
        <header class="bg-dark  py-5 noPrint"  >
           
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
      FROM item_found
      INNER JOIN users
      ON user_id = users.ID_users
      WHERE ID_Item = ? ";

      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("s",$uid);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_object();
?>
       <center><h1><b><u style="color:red">ประกาศพบของหาย</u></b></h1></center>

      <section class="py-5 container" id="printJS-form">
      
      <center><h2>รายละเอียด</h2></center>
        <div class="row py-lg-5" >
            <div class="col-lg-6 col-md-8 mx-auto">
               
                <h2 class="fw-light"><?php echo $row->name ?></h2>
                <hr>
                <div >
                    <span class="noPrint">Post by <?php echo $row->user_name ?> at</span>
                    <span class="text-muted noPrint">
                    <?php echo $row->date ?>
                    </span>
                    
                    <img src="upload/<?php echo $row->image ?>" class="img-fluid rounded mt-3" alt="" >
                    <p class="my-4"><?php echo nl2br($row->detail);  ?></p>
                </div>
               
                <hr>
   
                <a class="btn btn-secondary noPrint" href="javascript:history.back()"><i class="bi bi-arrow-left"></i> Go back</a>
                <div align='right'>
                <a class="btn btn-info noPrint" id="print"href="" onclick="window.print()" data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-html="true" title="พิมพ์เอกสาร"><i class="bi bi-printer noPrint"></i> Print</a>
                <div>
            </div>
            
        </div>
    </section>
        
            
            
          
            
            
        
        <!-- Footer-->
        <footer class="py-5 bg-dark noPrint">
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

