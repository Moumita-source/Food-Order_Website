<?php include('partials/menu.php');   ?>

<!-- Main content starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br> <br>

        <?php

          if(isset($_SESSION['upload'])){
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
          }

         ?>

         <form action="" method="POST" enctype="multipart/form-data">
             <table class="tbl-30">
                <tr>
                    <td>Title : </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter title of food">
                    </td>
                </tr>
                <tr>
                    <td>Description : </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Descriebe the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price : </td>
                    <td>
                        <input type="number" name="price" placeholder="Enter the price">
                    </td>
                </tr>
                <tr>
                    <td>Image name : </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category : </td>
                    <td>
                        <select name="category" id="">

                            <!-- Create php code to select category from database   -->
                            <?php

                                // 1.Sql query to get all active category from database
                                     $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                    //  Execute the query
                                    $res=mysqli_query($conn,$sql);

                                    // Check rows to see if we have categories which are active
                                    $count=mysqli_num_rows($res);
                                
                                    if($count>0){
                                    //    We have category
                                        while($row=mysqli_fetch_assoc($res)){

                                            $id=$row['id'];
                                            $title=$row['title'];

                                            ?>
                                              <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                            <?php
                                        }

                                    }else{
                                    //   We do not have category

                                      ?>
                                       <option value="0">No category found</option>
                                      <?php
                                    }

                                 // 2.Display on dropdown
                             ?>

                           
                        </select>
                    </td>
                </tr>
                 <tr>
                     <td>Featured : </td>
                     <td>
                         <input type="radio" name="featured" value="Yes"> Yes
                         <input type="radio" name="featured" value="No"> No
                     </td>
                 </tr>
                 <tr>
                     <td>Active : </td>
                     <td>
                         <input type="radio" name="active" value="Yes"> Yes
                         <input type="radio" name="active" value="No"> No
                     </td>
                 </tr>
                 <tr>
                     <td colspan="2">
                     <input type="submit" name="submit" value="Add food" class="btn-secondary">
                     </td>

                 </tr>
             </table>
         </form>

    <?php

    // Check if the Add food button is clicked
       if(isset($_POST['submit'])){

        //    Get all the data from form
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $categoryid=$_POST['category'];
        
        // Check if the featured and active buttons are set or not
        if(isset($_POST['featured'])){
            $featured=$_POST['featured'];  
        }else{
            $featured='No';
        }

        if(isset($_POST['active'])){
            $active=$_POST['active'];  
        }else{
            $active='No';
        }

        // Upload the image

        if(isset($_FILES['image']['name'])){

            $image_name=$_FILES['image']['name'];

            if($image_name!=''){

                $ext=end(explode('.',$image_name));

                $image_name="food-name-".rand(000,999).'.'.$ext;

                $source_path=$_FILES['image']['tmp_name'];
                $dest_path="../images/food/".$image_name;

                $upload=move_uploaded_file($source_path,$dest_path);

                if($upload==false){

                    $_SESSION['upload']="<div class='error'>Failed to upload the image!!</div>";
                    header('loaction:'.SITEURL.'admin/add-food.php');
                    die();
                }

            }else{
                $image_name='';
            }
        }else{
            $image_name='';
        }
         

        //Upload data into database

        // Sql query to insert
        $sql2="INSERT INTO tbl_food SET
               title='$title',
               description='$description',
               price=$price,
               image_name='$image_name',
               category_id=$categoryid,
               featured='$featured',
               active='$active'

        ";

        // Execute the query
        $res2=mysqli_query($conn,$sql2);

        if($res2==TRUE){
            // Data inserted successfully
            $_SESSION['add']="<div class='success'>Successfully added the food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            // Failed to insert data
            $_SESSION['add']="<div class='error'>Failed to upload the food!!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

       }


     ?>



    </div>
</div>

<!-- Main content ends here -->

<?php include('partials/footer.php');  ?>