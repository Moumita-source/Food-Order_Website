<?php include('partials/menu.php');   ?>

<!-- Main-content starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

         <br> <br>

         <?php

            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

          ?>
          <br> <br>

         <!-- Add Cateory form starts here -->
         <form action="" method="POST" enctype="multipart/form-data">

             <table class="tbl-30">
                 <tr>
                     <td>Title : </td>
                     <td>
                         <input type="text" name="title" id="" placeholder="Category title">
                     </td>
                 </tr>
                 <tr>
                     <td>Select Image : </td>
                     <td>
                         <input type="file" name="image" id="">
                     </td>
                 </tr>
                 <tr>
                     <td>Featured : </td>
                     <td>
                         <input type="radio" name="featured" id="" value="Yes"> Yes
                         <input type="radio" name="featured" id="" value="No"> No
                     </td>
                 </tr>
                 <tr>
                     <td>Active : </td>
                     <td>
                         <input type="radio" name="active" id="" value="Yes"> Yes
                         <input type="radio" name="active" id="" value="No"> No
                     </td>
                 </tr>
                 <tr>
                     <td colspan="2">
                         <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                     </td>
                 </tr>
             </table>

         </form>


          <!-- Add Cateory form ends here -->

          <?php

        //    Check if the Add Category button is clicked or not
        if(isset($_POST['submit'])){

            echo "Clicked";
             //1. Get the values from category form
                $title=$_POST['title'];
           
            $featured="No";
           
            $active="No";
            $image_name="";
             //2. For radio button we need to check if button is clicked or not
            if(isset($_POST['featured'])){
             //    Get the value from form
             $featured=$_POST['featured'];
            }

            if(isset($_POST['active'])){
             //    Get the value from form
             $active=$_POST['active'];
            }

             //Check whether the image is selected or not

            //  print_r($_FILES['image']);

            //  die();

            if(isset($_FILES['image']['name'])){

                // Upload the image
                $image_name=$_FILES['image']['name'];

                // Auto rename the image
                // Get the extension of the image(jpg,png,gif) etc
                 if($image_name!=''){
                $ext=end(explode('.',$image_name));

                // Rename the image
                $image_name="food_category_".rand(000,999).'.'.$ext; //food_category_834.jpg



                $source_path=$_FILES['image']['tmp_name'];
                $desination_path="../images/category/".$image_name;

                // Finally upload the image
                $upload=move_uploaded_file($source_path,$desination_path);

                // Check whether the image is uploaded
                // And if the image is not uploaded then we will redirect with an error message
                if($upload==FALSE){
                    // Redirect to manage cateory
                    $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                    // stop the process
                    die();
                }
            }
            }else{
                // Dont uload the image and set the image name value as blank
                $image_name="";
            }

         //    Create sql query to insert data into database
         $sql="INSERT INTO tbl_category SET
               title='$title',
               image_name='$image_name',
               featured='$featured',
               active='$active'
         ";
          echo $sql;
         //   Execute the query and save in database
           $res=mysqli_query($conn,$sql);

       

          //   Check whether the query executed and data added or not
          if($res==TRUE){
          //    Query executed and category added
          $_SESSION['add']="<div class='success'>Category added successfully!! </div>";
         
          // Redirect to manage category
          header('location:'.SITEURL.'admin/manage-category.php');

          }else{
              // Failed to add category
              $_SESSION['add']="<div class='error'>Failed to add category!!Try again </div>";
              // Redirect to manage category
              header('location:'.SITEURL.'admin/add-category.php');
    
          }





        }


           ?>

    </div>
</div>




<!-- Main-content ends here -->

<?php include('partials/footer.php');  ?>