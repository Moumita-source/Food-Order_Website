<?php include('partials/menu.php'); ?>

<!-- main content starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE FOOD</h1>
        <br>
        <br>
        <!-- button to add admin -->
        <a href="add-food.php" class="btn-primary">Add Food</a>
        <!-- button to add admin ends -->
        <br>
        <br>
        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['fail-delete'])) {
            echo $_SESSION['fail-delete'];
            unset($_SESSION['fail-delete']);
        }
        if (isset($_SESSION['success_delete'])) {
            echo $_SESSION['success_delete'];
            unset($_SESSION['success_delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['remove-update'])) {
            echo $_SESSION['remove-update'];
            unset($_SESSION['remove-update']);
        }
        if (isset($_SESSION['up'])) {
            echo $_SESSION['up'];
            unset($_SESSION['up']);
        }


        ?>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            //  Sql query to get all the data of food
            $sql = "SELECT * FROM tbl_food";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Count the number of rows
            $count = mysqli_num_rows($res);
            $sn=1;

            if ($count > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $id=$row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>$<?php echo $price; ?></td>
                        <td>
                            <?php
                               if($image!=''){
                                  ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image; ?>" alt="" width="100px">
                                 <?php
                               }else{

                                ?>
                                 <div class='error'>No Image found</div>
                                <?php
                               }

                            ?>


                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>


            <?php
                }
            }else{

                ?>
                <tr>
                    <td colspan="7">
                        <?php
                    echo "We have no food yet!!";
                    ?>
                    </td>
                </tr>
                <?php
            }


            ?>





        </table>
    </div>
</div>

<!-- main content ends here -->

<?php include('partials/footer.php');    ?>