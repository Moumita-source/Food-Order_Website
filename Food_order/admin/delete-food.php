<?php

  include('../config/constants.php');

 if(isset($_GET['id']) && isset($_GET['image_name'])){

//   echo "Process to delete";
    //  1.Get id and image_name
         $id=$_GET['id'];
         $image_name=$_GET['image_name'];


        // 2.Remove the image if available
           if($image_name!=''){
               $path="../images/food/".$image_name;

               $remove=unlink($path);

               if($remove==FALSE){
                //    Failed to delete
                $_SESSION['fail-delete']="<div class='error'>Failed to delete</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();

               }

           }


        //    3.Delete the food from database
        // Sql query to delete the food with that id
        $sql="DELETE FROM tbl_food WHERE id=$id";

        // Execute the query
        $res=mysqli_query($conn,$sql);

        if($res==TRUE){

            $_SESSION['success_delete']="<div class='success'>Successfull in deleting!!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }else{

            $_SESSION['success_delete']="<div class='error'>Successfull in deleting!!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }


        //    4.Redirect to manage food with message 




 }else{

    // Redirect to manage food
     $_SESSION['delete']="<div>Unauthorized access!!</div>";
     header('loaction:'.SITEURL.'admin/manage-food.php');
 }





?>