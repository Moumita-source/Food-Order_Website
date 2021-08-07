<?php include('partials/menu.php'); ?>

<!-- main content starts here -->
<div class="main-content">
    <div class="wrapper">
    <h1>MANAGE CATEGORY</h1>
    <br>
           <br>

           <?php

               if(isset($_SESSION['add'])){
                   echo $_SESSION['add'];
                   unset($_SESSION['add']);
               }
               if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['remove-fail'])){
                echo $_SESSION['remove-fail'];
                unset($_SESSION['remove-fail']);
            }


            ?>
             <br> <br>

          <!-- button to add admin -->
           <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
          <!-- button to add admin ends -->
           <br>
           <br>
           <br>
          <table class="tbl-full">
              <tr>
                  <th>S.No</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Featured</th>
                  <th>Active</th>
                  <th>Actions</th>
              </tr>

              <?php

                //  Query to get all category from database
                $sql="SELECT * FROM tbl_category";

                // Execute the query
                $res=mysqli_query($conn,$sql);

                // Count rows
                $count=mysqli_num_rows($res);
                $sn=1;
                if($count>0){

                    while($row=mysqli_fetch_assoc($res)){

                        ?>
                <tr>
                  <td><?php echo $sn++; ?>.</td>
                  <td><?php echo $row['title']; ?></td>
                  <td>
                      <?php 
                    //   Check whether image name is available or not
                      if($row['image_name']!=''){
                        //   Display the image
                        ?>
                          <img src="<?php echo SITEURL;?>images/category/<?php echo $row['image_name']; ?>" alt="" width="120px" height="70px" >
                        <?php

                      }else{
                        //   Do not display the image
                        echo "<div class='error'>No image provided!!!</div>";
                      }
                      ?>
                
                
                </td>
                  <td><?php echo $row['featured']; ?></td>
                  <td><?php echo $row['active']; ?></td>
                  <td>
                      <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $row['id']; ?>&image_name=<?php echo $row['image_name']; ?>" class="btn-secondary">Update Category</a>
                      <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $row['id']; ?>&image_name=<?php echo $row['image_name']; ?>" class="btn-danger">Delete Category</a>
                  </td>
              </tr>



                        <?php

                    
                    }
                }else{

                    ?>
                    // We do not have data
                    <tr>
                        <td colspan="6">
                            <div class="error">We do not have data in category!!</div>
                        </td>
                    </tr>
                    <?php
                }
                
                ?>
          </table>
    </div>
</div>

<!-- main content ends here -->

<?php include('partials/footer.php');  ?>