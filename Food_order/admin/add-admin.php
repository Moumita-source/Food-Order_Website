<?php include('partials/menu.php');   ?>

<!-- main content starts here -->
 <div class="main-content">
     <div class="wrapper">
         <h1>Add Admin</h1>
         <br>
         <br>

         <?php
          
          if(isset($_SESSION['add'])){    //Checking whether session is set or not
              echo $_SESSION['add']; //Displaying the session message if set
              unset($_SESSION['add']); //Removing session message,like if we do refresh then message is gone
          }

         ?> 

         <form action="" method="POST">
             <table class="tbl-30">
                 <tr>
                     <td>Full Name: </td>
                     <td><input type="text" name="full_name" id="" placeholder="Enter your name "></td>
                 </tr>
                 <tr>
                     <td>User Name: </td>
                     <td><input type="text" name="username" id="" placeholder="Enter your user name "></td>
                 </tr>
                 <tr>
                     <td>Password: </td>
                     <td><input type="password" name="password" id="" placeholder="Enter your password "></td>
                 </tr>
                 <tr>
                     <td colspan="2">
                         <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                     </td>
                 </tr>
             </table>
         </form>
     </div>
 </div>


<!-- main content ends here -->


<?php include('partials/footer.php')  ?>


<?php

// Process the value from form and save in database
// Check whether the submit button is clicked or not

if(isset($_POST['submit'])){

    // Button clicked
    // echo "button clicked";

    //1. Get the data from form
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);  //Password Encryption with md5

    //2. sql query to save data into database
    $sql="INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'

     ";

    //3.Executing query and saving data in database
    $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

    //4.Check whether (Query is executed or not) is inserted or not and display appropriate message
    if($res==TRUE){
        //data is inserted
        //echo "Data inserted!!";
        // Create a session variable to display message
        $_SESSION['add']="Admin added successfully!!";  //Here, add is session variable that holds "Admin added successfully"
        // Redirect page to MANAGE ADMIN  
        header("location:".SITEURL.'admin/manage-admin.php');
    }else{
        // data failed to get inserted
        //echo "Failed to insert data";
         // Create a session variable to display message
         $_SESSION['add']="Failed to Add Admin";  //Here, add is session variable that holds "Admin added successfully"
         // Redirect page to ADD ADMIN  
         header("location:".SITEURL.'admin/add-admin.php');
    }

}


?>