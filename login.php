<?php
    session_start();
    require_once('db/connection.php');
?>
<!-- -------------database---------- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เข้าสู่ระบบ </title>

  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Main css -->
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>

    <div class="container-fluid">

       <!-- Sing in  Form -->
       <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                    <a href="index.php" class="col-xs-12 .col-md-8" ><h1><i class="bi bi-house-fill"></i>กลับสู่หน้าแรก</h1></a>
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="register.php" class="signup-image-link">สร้างบัญชี</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="login-form"  action="db/login_db.php">
                            <div class="form-group">
                                <label for="your_name"><i class="bi bi-person-fill"></i></label>
                                <input type="text" name="username" id="your_name" placeholder="Username"required/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="bi bi-lock-fill"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password"required/>
                            </div>
                            <?php if (isset($_SESSION['error'])) : ?>
                <div class="error" style="color: red;">
                    <h3>
                    <center><?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?></center>
                    </h3>
                </div>
                <?php endif ?>  
                <br>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>