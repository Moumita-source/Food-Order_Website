<?php include('partials/menu.php');  ?>

<!-- Main content starts here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>

            <br> <br>

            <?php

            //  Check whether id is set or not
            if(isset($_GET['id'])){
                //  Get the id and all other details
                // echo "Getting the data";
                // Get the id
                $id=$_GET['id'];

                //  Sql query to get all the data
                $sql="SELECT * FROM tbl_category WHERE id=$id";

                // Execute the query
                $res=mysqli_query($conn,$sql);

                // Count the number of rows
                $count=mysqli_num_rows($res);

                if($count==1){

                    // Get all the 
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }else{
                    // Redirect to manage category page and return message
                    $_SESSION['no-category-found']="<div class='error'>No category found!!!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }


            }else{
                //  Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }


              ?>
             
            <form action="" method="POST" enctype="multipart/form-data">
                
            <table class="tbl-30">
                <tr>
                    <td>Title : </td>
                     <td>
                         <input type="text" name="title" value="<?php echo $title;  ?>">
                     </td>
                </tr>
                <tr>
                    <td>Current image: </td>
                    <td>
                       <?php
                         
                         if($current_image!=""){

                            ?>
                             <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" alt="" srcset="" width="100px">
                            <?php

                         }else{
                            //  display the message
                            echo "<div class='error'>Image not added</div>";
                         }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="new_image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Featured : </td>
                    <td>
                        <input <?php if($featured=='Yes') echo "checked"; ?> type="radio" name="featured" id="" value="Yes"> Yes
                        <input <?php if($featured=='No') echo "checked"; ?> type="radio" name="featured" id="" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active : </td>
                    <td>
                        <input <?php if($active=='Yes') echo "checked"; ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=='No') echo "checked"; ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name='id' value="<?php echo $id;  ?>">
                        <input type="submit" name="submit" value="update category" class="btn-secondary">
                    </td>
                </tr>
            </table>

            </form>

          <?php

              if(isset($_POST['submit'])){
                  
                // Get all the values from form
                $id=$_POST['id'];
                $title=$_POST['title'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                // Updating the new image
                // Check whether the image is selected or not

                if(isset($_FILES['new_image']['name'])){
                    // Set the image
                    
                    $image_name=$_FILES['new_image']['name'];

                    if($image_name!=''){
                        //  Image is available
                        // Upload the new image
                            $ext=end(explode('.',$image_name));
            
                            // Rename the image
                            $image_name="food_category_".rand(000,999).'.'.$ext; //food_category_834.jpg
            
            
            
                            $source_path=$_FILES['new_image']['tmp_name'];
                            $desination_path="../images/category/".$image_name;
            
                            // Finally upload the image
                            $upload=move_uploaded_file($source_path,$desination_path);
            
                            // Check whether the image is uploaded
                            // And if the image is not uploaded then we will redirect with an error message
                            if($upload==FALSE){
                                // Redirect to manage cateory
                                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                // stop the process
                                die();
                            }
                        // Delete the current image

                        $remove_path="../images/category/".$current_image;
                        $remove=unlink($remove_path);

                        // Check whether the image is removed or not

                        // If failed to remove display message and stop the process

                        if($remove==false){
                            // Failed to remove the image
                            $_SESSION['remove-fail']="<div class='error'>Failed to remove current image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();  //Stop the process
                        }


                    }else{
                        $image_name=$current_image;
                    }

                }else{
                    $image_name=$current_image;
                }

                // Update the database
                $sql2="UPDATE tbl_category SET
                     title='$title',
                     image_name='$image_name',
                     featured='$featured',
                     active='$active'
                     WHERE id=$id
                "; 
                
                // Execute the query
                $res2=mysqli_query($conn,$sql2);



                // Redirect to manage category page with message
                // Check whether query executed or not
                if($res2==TRUE){
                    //  Category updated
                    $_SESSION['update']="<div class='success'>Category updated successfully!!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }else{
                    //   Failed to update category
                    $_SESSION['update']="<div class='error'>Failed to update category!!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }


              }

           ?>

        </div>
    </div>

<!-- Main content ends here -->

<?php include('partials/footer.php');  ?>