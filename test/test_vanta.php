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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
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
                        <li class="nav-item"><a class="nav-link" href="#!">บทความ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">จัดการผู้ใช้</a></li>
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
        </div>
        
        <section class="py-5 text-center container" >
        <div align="left">
            <form action="test_vanta.php" id="sc" name="sc" method="POST">
                <div class="form-group row mb-1 ">
                    <div class="col-2 ">
                        <input type="text" name="text" id="text"  class="form-control" >
                   </div>
                    <div class="col-2 ">
                      <button class="btn btn-success" type="submit" name="submit">ค้นหา</button>
                    </div>
                </div>
            </form>
        </div>
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
           
                
               
           </tbody>
        </table>
        
    </section>   
    
    <script>
        $(function(){
            //เมื่อเริ่มหน้าเว็บก็จะเรียกฟังก์ชั้นนี้มาทำงานก่อน
            all_users();
            //ฟังกฺชั้นนี้คือ แสดงข้อมูล users ทั้งหมด
            function all_users(){
                $.ajax({
                    url:'show_user.php',
                    type:'GET',
                    dataType:'json',
                   
                    success: function(data){
                        if(data.leangth !=0){
                            //กำหนดตัวแปรแถวของตาราง
                            var TRstring ="";
                            //วนลูปข้อมูล Json
                            $.each(data,function(key,value){
                                //แสดงข้อมูลในตาราง
                                TRstring+=`
                                <tr>
                                    <th scope="row">${value.ID_users}</th>
                                    <td>${value.username}</td>
                                    <td>${value.user_name}</td>
                                    <td>${value.user_surname}</td>
                                    <td>${value.email}</td>
                                    <td>${value.phone}</td>
                                    <td>
                                    <a class="btn btn-outline-danger" onclick="return confirm('คุณต้องการที่จะลบผู้ใช้หรือไม่?');" href="#?id=${value.ID_users}" role="button">ลบ</a>
                                    </td>
                                </tr>`;
                                $('table tbody').html(TRstring);
                                
                            });

                        }else{
                            alert('ไม่พบข้อมูล');
                        }
                    }
                });
            }
            $('form#sc').submit(function(event){
                event.preventDefault();
                //รับค่าจากฟอร์ม
                var value = $('input#text').val();
               //ส่งค่า ไป ajex
                $.ajax({
                    url:'test.php',
                    type:'POST',
                    dataType:'json',
                    data:{
                        text:value
                    },
                    //เมื่อรับข้อมูลมาสำเร็จก็จะเข้าฟังก์ชั้น

                    success: function(data){
                        
                        if(data.leangth !=0){
                            //กำหนดตัวแปรแถวของตาราง
                            
                            
                            var TRstring ="";
                            //วนลูปข้อมูล Json
                            $.each(data,function(key,value){
                                //แสดงข้อมูลในตาราง
                                TRstring+=`
                                <tr>
                                    <th scope="row">${value.ID_users}</th>
                                    <td>${value.username}</td>
                                    <td>${value.user_name}</td>
                                    <td>${value.user_surname}</td>
                                    <td>${value.email}</td>
                                    <td>${value.phone}</td>
                                    <td>
                                    <a class="btn btn-outline-danger" onclick="return confirm('คุณต้องการที่จะลบผู้ใช้หรือไม่?');" href="#?id=${value.ID_users}" role="button">ลบ</a>
                                    </td>
                                </tr>`;
                                $('table tbody').html(TRstring);
                                
                            });

                       
                        }else{
                           
                            alert("ไม่พบข้อมูล");
                        }

                        if(data.leangth ==0){
                            alert("ไม่พบข้อมูล");
                        }
                        
                    }
                });
             
            });
        });
    </script>
</body>
</html>
