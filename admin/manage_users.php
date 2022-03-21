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
                        <li class="nav-item"><a class="nav-link" href="index-articles.php">บทความ</a></li>
                        <li class="nav-item"><a class="nav-link" href="articles.php">เพิ่มบทความ</a></li>
                        <li class="nav-item"><a class="nav-link" href="announce.php">จัดการประกาศ</a></li>
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
        <header class="px-4  px-lg-5 my-5"  >
       
      </header>
      
       




      
      
      
        <!-- Section-->
        <section class="py-5">
        <center><h2><i class="bi bi-file-earmark-person-fill"></i><b>จัดการผู้ใช้</b></h2></center>
        <div class="container">
        <a class="btn btn-info" href="javascript:history.back()" role="button">ย้อนกลับ</a>
        <?php $q = (isset($_GET['q']) ? $_GET['q'] : ''); ?>
        <form action="manage_users.php" method="get" class="py-1">
          <input class="me-2" type="text" name="q" >
          <button class="btn btn-outline-success" type="submit">ค้นหา</button>
        </form>
        </div>
        <!-- ค้นหา -->
       


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
    $user_id = $_SESSION['user_id'];
      $sql = "SELECT *
        FROM users
        ORDER BY ID_users ASC";
      $result = $mysqli->query($sql);

      if (!$result) {
        echo ("Error: ". $mysqli->error);
        } 
      ?>
        <section class="py-3 text-center container" >
        
        <table class="table">
            <thead class="table-dark"> <!--หัวเรื่อง-->
                <tr>
                    <th scope="col">ID_users </th>
                    <th scope="col">Username</th>
                    <th scope="col">User_name</th>
                    <th scope="col">User_surname</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            
            <tbody>  <!--เนื้อ-->
            <?php while($row = $result->fetch_object()){ ?>
                <tr>
                    <th scope="row"><?php echo $row->ID_users ?></th>
                    <td><?php echo $row->username ?></td>
                    <td><?php echo $row->user_name ?></td>
                    <td><?php echo $row->user_surname ?></td>
                    <td><?php echo $row->email ?></td>
                    <td><?php echo $row->phone ?></td>
                    <td>
                    <a class="btn btn-outline-danger" onclick="return confirm('คุณต้องการที่จะลบผู้ใช้หรือไม่?');" href="../db/delete_users.php?id=<?php echo $row->ID_users?>" role="button">ลบ</a>
                    </td>
                </tr>
                <?php
                }
                ?>
           </tbody>
        </table>
    <?php
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
    $user_id = $_SESSION['user_id'];
      $sql = "SELECT *
        FROM users
        WHERE username LIKE '$q%' OR user_name LIKE '$q%' OR user_surname LIKE '$q%' OR email LIKE '%$q%' OR phone LIKE '%$q%'
       ORDER BY ID_users ASC";
      $result = $mysqli->query($sql);

      if (!$result) {
        echo ("Error: ". $mysqli->error);
        } 
      ?>
        <section class="py-3 text-center container" >
        
        <table class="table">
            <thead class="table-dark"> <!--หัวเรื่อง-->
                <tr>
                    <th scope="col">ID_users </th>
                    <th scope="col">Username</th>
                    <th scope="col">User_name</th>
                    <th scope="col">User_surname</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            
            <tbody>  <!--เนื้อ-->
            <?php while($row = $result->fetch_object()){ ?>
                <tr>
                    <th scope="row"><?php echo $row->ID_users ?></th>
                    <td><?php echo $row->username ?></td>
                    <td><?php echo $row->user_name ?></td>
                    <td><?php echo $row->user_surname ?></td>
                    <td><?php echo $row->email ?></td>
                    <td><?php echo $row->phone ?></td>
                    <td>
                    <a class="btn btn-outline-danger" onclick="return confirm('คุณต้องการที่จะลบผู้ใช้หรือไม่?');" href="../db/delete_users.php?id=<?php echo $row->ID_users?>" role="button">ลบ</a>
                    </td>
                </tr>
                <?php
                }
                ?>
           </tbody>
        </table>
        <?php 
    }
    ?>
    
        
   
    </section>   
    </section>   
     <!-- Bootstrap core JS-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
        
        
    </body>
</html>
</body>
</html>
