<?php

// Include constants.php file here
   include('../config/constants.php');

//   1.Get the id of the admin
      $id=$_GET['id'];
    //   echo $id;

// 2.Create the sql query to delete that admin
      $sql="DELETE FROM tbl_admin WHERE id=$id";

    //   Execute the query
    $res=mysqli_query($conn,$sql);

    // Check if query executed successfully

    if($res){
        // Query executed successfully and admin deleted
        // echo "Admin Deleted!!";
        // Create session variable to display message
        $_SESSION['delete']="<div class='success'>Admin deleted Successfully!!</div>";
        // Redirect to manage admin page with (success)
        header('location:'.SITEURL.'admin/manage-admin.php');

    }else{
        // Query not executed successfully
        // echo "Failed to delete admin!!";
                // Create session variable to display message
                $_SESSION['delete']="<div class='error'>Failed to delete admin!!<div>";
                // Redirect to manage admin page with (success)
                header('location:'.SITEURL.'admin/manage-admin.php');
        
    }

//   3.Redirect to manage admin page with (success/error)
?>