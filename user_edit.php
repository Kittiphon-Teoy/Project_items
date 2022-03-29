<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
} else {
    //do nothing
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">บริการแจ้ง</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="create_found.php">แจ้งหายของหาย</a></li>
                                <li><a class="dropdown-item" href="create_lost.php">แจ้งพบของหาย</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                    <form class="d-flex" action="user_info.php">
                        <button class="btn btn-outline-dark"  type="submit">
                        <i class="bi bi-person-circle"></i> <b><?php echo $_SESSION["username"]; ?></b>  
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
        <header class="px-4  px-lg-5 my-5"  >
       
      </header>
        <!-- Section-->
        <section class="py-5">

        <!-- database -->
<?php
  // connect database 
    require_once('db/connection.php');
    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    $user_id = $_SESSION['user_id'];
     
      $sql = "SELECT *
      FROM users
      WHERE ID_users = ? ";

      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("i",$user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_object();
?>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">แก้ไขข้อมูลส่วนตัว</h1>
                <hr>
               
                <form action="db/save_edit_users.php" method="POST"  onsubmit="return formValidation()">
                <input type="hidden" name="user_id" value= "<?php echo  $user_id ?>">
                
                    <div  align="left" class="mb-3 ">
                        <label for="title" class="form-label"><i class="bi bi-person-circle"></i><b>Username:</b></label>
                        <input type="text" name="user_name" id="username" required class="form-control" placeholder="Username" value= "<?php echo $row->username;?>" maxlength="45" required>
                    </div>
                    <div  align="left" class="mb-3">
                        <label for="title" class="form-label"><i class="bi bi-person-fill"></i><b>Name:</b></label>
                        <input type="text" name="name" id="name" required class="form-control" placeholder="Name"  value= "<?php echo $row->user_name;?>" maxlength="45" required>
                    </div>
                    <div  align="left" class="mb-3">
                        <label for="title" class="form-label"><i class="bi bi-person-fill"></i><b>Surname:</b></label>
                        <input type="text" name="surname" id="surname" required class="form-control"  placeholder="Surname" value= "<?php echo $row->user_surname;?>" maxlength="45" required>
                    </div>
                    <div  align="left" class="mb-3">
                        <label for="title" class="form-label"><i class="bi bi-envelope-fill"></i><b>E-mail:</b></label>
                        <input type="text" name="email"  id="email" required class="form-control" placeholder="E-mail" value= "<?php echo $row->email;?>" maxlength="45" required>
                    </div>
                    <div  align="left" class="mb-3">
                        <label for="title" class="form-label"><i class="bi bi-telephone-fill"></i><b>Phone:</b></label>
                        <input type="text" name="phone" id="phone" required class="form-control"  placeholder="Phone" value= "<?php echo $row->phone;?>" maxlength="45" required>
                    </div>
                
                    
                    <button class="btn btn-success" type="submit" name="submit">ตกลง</button>
                    <div align="left">
                    <a href="user_info.php" class="btn btn-outline-info active " role="button" aria-pressed="true">ย้อนกลับ</a>
                    </div>
                </form>
            </div>
        </div>
        <script src= "js/validation.js"></script>
    </section>   
     
        


    </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">จัดทำโดย &copy; นาย กิตติภณ ถนอมสุขสันต์ 61160086</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        
        
    </body>
</html>
