<?php
 echo ob_start();
?>

<?php include('partials/menu.php');  ?>

<?php

 if(isset($_GET['id'])){

    $id=$_GET['id'];

    // Sql query to get all the selected food
    $sql2="SELECT * FROM tbl_food WHERE id=$id";

    // Execute the query
    $res2=mysqli_query($conn,$sql2);

    // Get the value based on query executed
    $row2=mysqli_fetch_assoc($res2);

    $title=$row2['title'];
    $description=$row2['description'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    echo $current_image;
    $current_category=$row2['category_id'];
    $featured=$row2['featured'];
    $active=$row2['active'];



 }else{

    header('location:'.SITEURL.'admin/manage-food.php');
 }


?>


<!-- main content starts here -->
 
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br> <br>

        <form action="" method="POST" enctype="multipart/form-data">
          
         <table class="tbl-30">
             <tr>
                 <td>Title : </td>
                 <td>
                     <input type="text" name="title" placeholder="Title goes here" value="<?php echo $title; ?>">
                 </td>
             </tr>
             <tr>
                 <td>Description : </td>
                 <td>
                     <textarea name="description" id="" cols="30" rows="5" ><?php echo $description; ?></textarea>
                 </td>
             </tr>
             <tr>
                 <td>Price : </td>
                 <td>
                     <input type="number" name="price" value="<?php echo $price; ?>">
                 </td>
             </tr>
             <tr>
                 <td>Current Image</td>
                 <td>
                     <?php
                       if($current_image!=''){
                        ?>
                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="" width="100px">
                        <?php
                       }else{
                           echo "<div class='error'>Image not available </div>";
                       }

                       ?>
                 </td>
             </tr>
             <tr>
                 <td>Select New Image : </td>
                 <td>
                     <input type="file" name="image">
                 </td>
             </tr>
             <tr>
                 <td>Category : </td>
                 <td>
                     <select name="category" id="">

                        <?php 

                        //  Sql query to get data from category
                        $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                        // Execute the query
                        $res=mysqli_query($conn,$sql);

                        $count=mysqli_num_rows($res);

                        if($count>0){

                            while($row=mysqli_fetch_assoc($res)){

                                $title1=$row['title'];
                                $category_id=$row['category_id'];

                                ?>
                                <option <?php if($current_category==$category_id) echo "selected"; ?> value="<?php echo $category_id; ?>"><?php echo $title1; ?></option>                                
                                <?php  
                            }
                        }else{
                        ?>
                        <?php
                           echo "<option>No category found</option>";
                        }
                        ?>
                     </select>
                 </td>
             </tr>
             <tr>
                 <td>Featured : </td>
                 <td>
                     <input <?php if($featured=='Yes') echo "checked";?> type="radio" name="featured" value="Yes"> Yes
                     <input <?php if($featured=='No') echo "checked";?> type="radio" name="featured" value="No"> No
                 </td>
             </tr>
             <tr>
                 <td>Active : </td>
                 <td>
                     <input <?php if($active=='Yes') echo "checked";?> type="radio" name="active" value="Yes"> Yes
                     <input <?php if($active=='No') echo "checked";?> type="radio" name="active" value="No"> No
                 </td>
             </tr>
             <tr>
                 <td colspan="2">
                     <input type="submit" name="submit" value="Update Food" class="btn-secondary">

                 </td>
             </tr>
         </table>
    
    
    
    </form>

 <?php

   if(isset($_POST['submit'])){

    //   Get all the details of the form
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $currentimage=$current_image;
    echo $currentimage;
    $category=$_POST['category'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];

    // Upload the image is exists
    if(isset($_FILES['image']['name'])){

        $image_name=$_FILES['image']['name'];

        if($image_name!=''){
           
            $ext=end(explode('.',$image_name));

           $image_name="food-name-".rand(000,999).'.'.$ext;

           $source_path=$_FILES['image']['tmp_name'];
           $dest_path="../images/food/".$image_name;

           $upload=move_uploaded_file($source_path,$dest_path);

           if($upload==FALSE){
               $_SESSION['upload']="<div>Failed to upload new image</div>";
               header('location:'.SITEURL.'admin/manage-food.php');
               die();
           }

           if($currentimage!=''){

            $path="../images/food/".$currentimage;
            $remove=unlink($path);

            if($remove==FALSE){
                $_SESSION['remove-update']="<div class='error'> Failed to remove current image</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
           }

        }else{
            $image_name=$currentimage;
        }
    }else{
        $image_name=$currentimage;
    }
    echo $image_name;
    //  Update the form in the table
    $sql4="UPDATE tbl_food SET
           title='$title',
           description='$description',
           price=$price,
           image_name='$image_name',
           category_id='$category',
           featured='$featured',
           active='$active'
           WHERE id=$id
    ";

    //  Execute the query
    $res4=mysqli_query($conn,$sql4);

    if($res4==TRUE){
    //   $_SESSION['up']="<div class='success'>Successfull updation!!</div>";
      header('location:'.SITEURL.'admin/manage-food.php');
    }else{
        // $_SESSION['up']="<div class='error'>Failed to update!!</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

   }


   ?>



    </div>
</div>



<!-- main content ends here -->

<?php include('partials/footer.php');  ?>

<?php

 echo ob_end_flush();
?>