<?php include('partials/menu.php')  ?>

<!-- Main-content starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
         <br>
         <br>

         <?php
           
        //    1.Get the id of the selected admin
           $id=$_GET['id'];
        // 2.Create the sql query to get the details
           $sql="SELECT * FROM tbl_admin WHERE id=$id";

        //    3.Execute the query
           $res=mysqli_query($conn,$sql);

        //  4.Check whether the query is executed
           if($res==TRUE){
            
            // Check whether the data is available or not
            $count=mysqli_num_rows($res);
            //    Check whether we have admin details or not
               if($count==1){
                  //Get the deatils
                  //echo "Admin available";
                  $row=mysqli_fetch_assoc($res);
                  $full_name=$row['full_name'];
                  $username=$row['username'];
               }else{
                   //Redirect to manage admin page
                   header('location:'.SITEURL.'admin/manage-admin.php');
               }




           }

         ?>

        <form action="" method="POST">
        <table class="tbl-30">
                 <tr>
                     <td>Full Name: </td>
                     <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                 </tr>
                 <tr>
                     <td>User Name: </td>
                     <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                 </tr>
                    <tr>
                     <td colspan="2">
                         <input type="hidden" name="id" id="" value="<?php echo $id; ?>">
                         <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                     </td>
                 </tr>
             </table>
        </form>
    </div>
</div>


<!-- Main-content ends here -->

<!-- Check if the submit button is clicked -->
<?php

  if(isset($_POST['submit'])){

    // echo "Button Clicked!!";
    // 1.Get all the values from form to update
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    

     //  Create sql query to update admin
     $sql="UPDATE tbl_admin SET 
          full_name='$full_name',
          username='$username'
          WHERE id='$id'
     ";

     //   Execute the query
     $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

     // Check whether the query executed successfully or not

      if($res==TRUE){
         //  Query executed and admin updated
         $_SESSION['update']="<div class='success'>Admin updated successfully!!</div>";
         // Redirect to manage admin page
         header('location:'.SITEURL.'admin/manage-admin.php');

      }else{
         //  Failed to execute query
         $_SESSION['update']="<div class='success'>Failed to update admin!!</div>";
         // Redirect to manage admin page
         header('location:'.SITEURL.'admin/manage-admin.php');
      }


  }



?>

<!-- Check if the submit button is clicked ends here-->

<?php include('partials/footer.php')   ?>