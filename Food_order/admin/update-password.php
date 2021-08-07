<?php include('partials/menu.php') ?>

<!-- Main content starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <br>

         <?php
        
            if(isset($_GET['id'])){
                $id=$_GET['id'];
            }

          ?>


        <form action="" method="POST">

           <table class="tbl-30">
             <tr>
                 <td>Old Password: </td>
                 <td>
                     <input type="password" name="old_password" placeholder="Enter old password">
                 </td>
             </tr>
             <tr>
                 <td>New Pasword: </td>
                 <td>
                     <input type="password" name="new_password" id="" placeholder="Enter new password">
                 </td>
             </tr>
             <tr>
                 <td>Confirm Password:</td>
                 <td>
                     <input type="password" name="confirm_password" id="" placeholder="Enter the new password again">
                 </td>
             </tr>
             <tr>
                 <td colspan="2">
                     <input type="hidden" name="id" id="" value="<?php echo $id; ?>">
                     <input type="submit" name="submit" id="" value="Change Password" class="btn-secondary">
                 </td>
             </tr>
           </table>
        </form>



    </div>
</div>

<!-- Main content ends here -->

<?php

//  Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){

        // echo "Clicked";
        // 1.Get the data from form
        $id=$_POST['id'];
        $old_password=md5($_POST['old_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);

        // 2.Check whether the person with old_password and id exists
        $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$old_password'";  //We have put cotations in password as it is string value

        // Execute the query
        $res=mysqli_query($conn,$sql);

        if($res==TRUE){

            // Check whether data is available
            $count=mysqli_num_rows($res);
             echo $count;
            if($count==1){
                // User exists and password can be changed
                // echo "User found!!";
                // Check whether the new password and confirm password match or not
                if($new_password==$confirm_password){
                //   Update the password
                // echo "Password matched!!";
                 $sql2="UPDATE tbl_admin SET
                     password='$new_password'
                     WHERE id=$id;
                 ";

                //  Execute the query
                $res2=mysqli_query($conn,$sql2);

                 if($res2==TRUE){
                    //  Display success message!!
                    $_SESSION['user_not_found']="<div class='success'>Successful in changing the password!!</div>";
                    // Redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');

                 }else{
                    //  Display error message
                    // Redirect the page to manage admin with error message
                    $_SESSION['user_not_found']="<div class='error'>Failed to change password!!Something went wrong!!</div>";
                    // Redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                 }


                }else{
                    // Redirect the page to manage admin with error message
                    $_SESSION['user_not_found']="<div class='error'>Your new password and confirm password don't match!!!Please try again!!</div>";
                    // Redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }else{
                // Password cannot be changed so we will redirect
                $_SESSION['user_not_found']="<div class='error'>User cannot be found!!!</div>";
                // Redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        // 3.Check whether the new password and confirm password match or not

        // 4.Change the password if above all are true
    }


?>



<?php include('partials/footer.php')  ?>