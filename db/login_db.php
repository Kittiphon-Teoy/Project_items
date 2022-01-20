<?php
    session_start();
    require_once('connection.php'); 

    $errors = array();

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $passwd = mysqli_real_escape_string($conn, $_POST['password']);

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
    $sql = "SELECT *
            FROM users
            WHERE username = '$username' AND passwd = md5('$passwd')";
    $result = $conn->query($sql);
      echo $sql;
    //  if ($_POST['username'] == 'wittawas' and $_POST['password'] == '12345')
    
    // $result->num_rows > 0 หมายความว่า ได้ผลลัพธ์จากคำสั่ง SELECT 1 แถวขึ้นไป
    if ($result->num_rows > 0) {
      $_SESSION['loggedin'] = true;
      while ($row = $result->fetch_object()){
        $_SESSION['user_id'] = $row->ID_users;
        $_SESSION['username']=$row->username;
        $_SESSION['name']=$row->user_name;
        $_SESSION['surname']=$row->user_surname;
        $_SESSION['email']=$row->email;
        $_SESSION['phone']=$row->phone;
        $_SESSION['user_group'] = $row->user_group;
    } 
          if($_SESSION['user_group'] == "U"){
            header("location: ../index.php"); //เเยกuser
          }elseif($_SESSION['user_group'] == "A"){
            header("location: ../index.php"); //admin
          }
    
      exit(0);
    } else if (($username != "" and $passwd != "") and $result->num_rows == 0) {
      //array_push($errors, "Username or Password is incorrect");
      $_SESSION['error'] = "Wrong Username or Password";
     
      header("location: ../index.php");
    }
    ?>