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
                                <li><a class="dropdown-item" href="create_found.php">แจ้งพบของหาย</a></li>
                                <li><a class="dropdown-item" href="create_lost.php">แจ้งของหาย</a></li>
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
        
        
        <section class="py-5 text-center container" >
        
            <div class="col-lg-6 col-md-8 mx-auto" style=" border-radius: 5px; padding: 20px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <h1 class="fw-light">ลงทะเบียนแจ้งของหาย</h1>
                <hr>
                <form action="db/save_lost.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value= "<?php echo  $_SESSION['user_id'] ?>">

                    <div class="mb-3" >
                        <label for="image" class="form-label">Image</label>
                        <input type="file" accept="image/*" id="imgInput" name="file" class="form-control">
                        <img id="previewImg" class="img-fluid rounded" />
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Name</label>
                        <input type="text" name="name" required class="form-control"  placeholder="ชื่อสิ่งของ..." maxlength="45" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" required class="form-control"  placeholder="ชื่อหัวข้อ..." maxlength="30" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Detail</label>
                        <textarea class="form-control" required name="detail" rows="10" placeholder="รายละเอียด..." maxlength="1000" required></textarea>
                    </div>
                    <div align="left">
                        <h5><u>ค่าตอบแทน</u></h5>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="reward" id="inlineRadio1" value="ไม่ระบุ" checked>
                            <label class="form-check-label" for="inlineRadio1">ไม่ระบุ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="reward" id="inlineRadio2" value="มี">
                             <label class="form-check-label" for="inlineRadio2">มีค่าตอบแทน</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="reward" id="inlineRadio2" value="ไม่มี">
                             <label class="form-check-label" for="inlineRadio2">ไม่มีค่าตอบแทน</label>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit" name="submit">Create</button>
                    <div align="left">
                    <a href="javascript:history.back()" class="btn btn-outline-info active " role="button" aria-pressed="true">ย้อนกลับ</a>
                    </div>
                </form>
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
    </body>
</html>
