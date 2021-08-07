<?php include('partials-front/menu.php');   ?>

<?php

  if(isset($_GET['food_id'])){

    $id=$_GET['food_id'];

    //  Get the details of the selected food table id
    $sql="SELECT * FROM tbl_food WHERE id=$id";

    // Execute the query
    $res=mysqli_query($conn,$sql);

    // Count the number of rows
    $count=mysqli_num_rows($res);

    if($count>0){

        $row=mysqli_fetch_assoc($res);

        $title=$row['title'];
        $image_name=$row['image_name'];
        $price=$row['price'];
        $description=$row['description'];


    }else{
        header('location:'.SITEURL);
    }


  }else{

    header('location:'.SITEURL);
  }



?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                         <?php

                            if($image_name==''){
                                echo "<div class='error'>Image Not there</div>";
                            }else{
                                ?>
                               <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

                                <?php
                            }
                           ?>

                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price"><?php echo $price; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


        <?php
        
        // Check whether submit button is clicked
        if(isset($_POST['submit'])){

            // Get all the details from the form
            $food=$title;
            $price2=$price;
            $qty=$_POST['qty'];
            $total=$price2*$qty;
            $order_date=date("Y-m-d h:i:sa");
            $status="Ordered";
            $customer_name=$_POST['full-name'];
            $customer_contact=$_POST['contact'];
            $customer_email=$_POST['email'];
            $customer_address=$_POST['address'];

            // Sql query to insert into order table
            $sql2="INSERT INTO tbl_order SET
                   food='$food',
                   price=$price2,
                   qty=$qty,
                   total=$total,
                   order_date='$order_date',
                   status='$status',
                   customer_name='$customer_name',
                   customer_contact='$customer_contact',
                   customer_email='$customer_email',
                   customer_address='$customer_address'
            ";

            // Execute the query
            $res2=mysqli_query($conn,$sql2);

            if($res2==TRUE){

                $_SESSION['order']="<div class='success text-center'>Food ordered successfully!!</div>";
                header('location:'.SITEURL);
            }else{
                
                $_SESSION['order']="<div class='error text-center'>Failed to order food!!</div>";
                header('loaction:'.SITEURL);
            }

        }
        
        ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

  <?php include('partials-front/footer.php');  ?>