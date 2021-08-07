<?php include('../config/constants.php');  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
         <br>
        
         <?php

          if(isset($_SESSION['login'])){
              echo $_SESSION['login'];
              unset($_SESSION['login']);
          }
          if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }



          ?>
          <br><br>


         <!-- login form starts here -->
           <form action="" method="POST">
               Username: <br>
               <input type="text" name="username" placeholder="Enter your username"> <br>
                <br><br>
               Password: <br>
               <input type="password" name="password" placeholder="Enter your password"> <br>

               <br><br>
               <div class="text-center">
               <input type="submit" name="submit" value="Login" class="btn-primary">
               </div>
               <br>
           </form>


         <!-- login form ends here -->

        <p class="text-center">Created By <a href="#">Moumita Palit</a></p>
    </div>
</body>
</html>

<?php

//  Check if submit button is clicked
 if(isset($_POST['submit'])){

    //  Process the login
    //1. Get the data from login form
   $username=$_POST['username'];
   $password=md5($_POST['password']);

//    2.Check whether the username and password collected from login exists
     $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //  3.Execute sql query
    $res=mysqli_query($conn,$sql);

    // 4.Count rows to check whether user exists or not
    $count=mysqli_num_rows($res);

    if($count>=1){
        //User exists
        $_SESSION['login']="<div class='success text-center'>Login Successful!!</div>";
        $_SESSION['user']=$username; //To check whether user is logged in or not,logout will unset it
        // Redirect to home page of admin
        header('location:'.SITEURL.'admin/');
    }else{
        //User doesnot exists
        $_SESSION['login']="<div class='error text-center'>Username or password didnot matched!!</div>";
        // Redirect to login page of admin
        header('location:'.SITEURL.'admin/login.php');
    }


 }


?>