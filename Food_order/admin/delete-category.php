<?php

  include('../config/constants.php');
//  Check whether the id and the image_name is set or not

   if(isset($_GET['id']) && isset($_GET['image_name'])){

    // Get the value and delete
    // echo "Get value and delete";
    // Get the id and the image name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    // Remove the physical image if available
    if($image_name!=''){
        // image is present
        $path="../images/category/".$image_name;
        // Remove the image
        $remove=unlink($path);

        if($remove==FALSE){
            // Set the session message
            $_SESSION['remove']="<div class='error'>Failed to remove image</div>";
            // Redirect to manage -category page
            header('location:'.SITEURL.'admin/manage-category.php');
            // Stop the process
            die();
        }

    }

    // Delete the data in that id
    // Sql query to delete data from database
     $sql="DELETE FROM tbl_category WHERE id=$id";

    //   Execute the query
    $res=mysqli_query($conn,$sql);

    // Check whether the data is deleted from table
    if($res==TRUE){
        // Set success message and redirect
        $_SESSION['delete']="<div class='success'>Successful deletion of category</div>";
        header('location:'.SITEURL.'admin/manage-category.php');

    }else{
        // Set fail message and redirect
        $_SESSION['delete']="<div class='success'>Successful deletion of category</div>";
        header('location:'.SITEURL.'admin/delete-category.php');
    }

    // Redirect to manage-category page with message

   }else{
    //    Redirect to the manage category page
    //    $_SESSION['delete']="<div class='error'>  </div>";
       header('loaction:'.SITEURL.'admin/manage-category.php');

   }





?>