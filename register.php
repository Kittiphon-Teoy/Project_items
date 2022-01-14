<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Main css -->
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <div class="container-fluid">
         <!-- Sign up form -->
        <section class="signup">
         <div class="container">
             <div class="signup-content">
                   <div class="signup-form">
                   <a href="index.php" class="col-xs-12 .col-md-8" ><h1><i class="bi bi-house-fill"></i>กลับสู่หน้าแรก</h1></a>
                      <h2 class="form-title">Sign up</h2>
                      <!-- --form-- -->
                        <form method="POST" class="register-form" id="register-form" action="db/register_db.php">
                            <div class="form-group">
                                <label for="username"><i class="bi bi-person-circle"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="bi bi-person-fill"></i></label>
                                <input type="text" name="name" id="name" placeholder="Name"/>
                            </div>
                            <div class="form-group">
                                <label for="surname"><i class="bi bi-person-fill"></i></label>
                                <input type="text" name="surname" id="surname" placeholder="Surname"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="bi bi-envelope-fill"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="bi bi-telephone-fill"></i></label>
                                <input type="text" name="phone" id="phone" placeholder="Phone" maxlength="10"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="bi bi-lock-fill"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re_password"><i class="bi bi-lock"></i></label>
                                <input type="password" name="re_password" id="re_password" placeholder="Repeat your password"/>
                                <input type="hidden" id="user_group" name="user_group" value="U">
                            </div>
                         
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>