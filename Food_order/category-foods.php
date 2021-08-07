<?php include('partials-front/menu.php');  ?>

<?php

$category_id=$_GET['category_id'];

//   Sql to get food from category id
// Get the category title from category id
$sql="SELECT title FROM tbl_category WHERE id=$category_id";

// Execute the query
$res=mysqli_query($conn,$sql);

$row=mysqli_fetch_assoc($res);

$title=$row['title'];


?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

           <?php

            //  Sql query to get food based on category_id
            $sql2="SELECT * FROM tbl_food WHERE category_id=$category_id";

            // Execute the query
            $res2=mysqli_query($conn,$sql2);

            $count2=mysqli_num_rows($res2);

            if($count2>0){

                while($row2=mysqli_fetch_assoc($res2)){
                    $id2=$row2['id'];
                    $title2=$row2['title'];
                    $image_name2=$row2['image_name'];
                    $description2=$row2['description'];
                    $price2=$row2['price'];
                    
                    ?>
                 
                 <div class="food-menu-box">
                <div class="food-menu-img">

                   <?php

                       if($image_name2==''){
                           echo "<div class='error'>No image found!!</div>";
                       }else{
                           ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name2; ?>" alt="<?php echo $title2; ?>" class="img-responsive img-curve">
                           <?php
                       }

                    ?>


                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title2;  ?></h4>
                    <p class="food-price"><?php echo $price2; ?></p>
                    <p class="food-detail">
                        <?php echo $description2;  ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id2; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                    <?php
                }
            }else{
                echo "<div>No food with this category available!!</div>";
            }


            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

  <?php include('partials-front/footer.php');  ?>