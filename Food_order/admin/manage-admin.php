<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ADMIN</h1>
        <br>
        <br>

        <?php
        if (isset($_SESSION['add'])) {

            echo $_SESSION['add']; //Displaying session message
            unset($_SESSION['add']); //Removing session message,like if we do refresh then message is gone
        }

        if(isset($_SESSION['delete'])){

            echo $_SESSION['delete'];//Displaying session message
            unset($_SESSION['delete']);//Removing session message,like if we do refresh then message is gone
        }

         if(isset($_SESSION['update'])){

             echo $_SESSION['update'];//Displaying session message
             unset($_SESSION['update']);//Removing session message,like if we do refresh then message is gone
         }
         if(isset($_SESSION['user_not_found'])){

            echo $_SESSION['user_not_found'];//Displaying session message
            unset($_SESSION['user_not_found']);//Removing session message,like if we do refresh then message is gone
        }


        ?>
        <br>
        <br>
        <br>
        <!-- button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <!-- button to add admin ends -->
        <br>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Full Name</th>
                <th>UserName</th>
                <th>Actions</th>
            </tr>

            <?php
            //   Query to get all Admin
            $sql = "SELECT * FROM tbl_admin";
            //   Execute the query
            $res = mysqli_query($conn, $sql);
            $sn=1;  //Create a variable to to assign numbers to the admins
            // Check whether the query is executed or not
            if ($res) {

                // Count rows to check if there is data in database
                $count = mysqli_num_rows($res); //Function to get all the rows in the database
                if ($count > 0) {

                    // We have data in database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        // Using while loop to get all data from database  
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Now we will display the values in our table
            ?>
                        <tr>
                            <td><?php echo $sn; ?>.</td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
                        
            <?php
                 $sn=$sn+1;   //Increment the value after each iteration
                    }
                } else {
                    // We do not have data in database
                }
            }


            ?>
        </table>

    </div>
</div>
<!-- Main Content section ends -->

<?php include('partials/footer.php');    ?>