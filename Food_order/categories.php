<?php include('partials-front/menu.php');   ?>


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php

        // Display all the categories that are active
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Count the number of rows
        $count = mysqli_num_rows($res);

        if ($count > 0) {

            while ($rows = mysqli_fetch_assoc($res)) {

                $id = $rows['id'];
                $title = $rows['title'];
                $image_name = $rows['image_name'];

        ?>

                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">

                          <?php
                             
                             if($image_name==''){
                                 echo "<div class='error'>Image not available!!</div>";
                             }else{

                                ?>
                                 <img src="<?php SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                 <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                <?php
                             }
                          ?>
                    </div>
                </a>

        <?php
            }
        } else {

            echo "<div class='error'>No Categories are active!!</div>";
        }

        ?>




















        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php');  ?>