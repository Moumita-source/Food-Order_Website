<?php include('partials/menu.php'); ?>

<!-- Main content starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br> <br>

        <?php

          if(isset($_GET['id'])){

            $id=$_GET['id'];
            // Sql query to get all the order details
            $sql="SELECT * FROM tbl_order WHERE id=$id";

            // Execute the order
            $res=mysqli_query($conn,$sql);

            $count=mysqli_num_rows($res);

            if($count>0){

               $row=mysqli_fetch_assoc($res);

               $food=$row['food'];
               $price=$row['price'];
               $qty=$row['qty'];
               $total=$row['total'];
               $status=$row['status'];
               $customer_name=$row['customer_name'];
               $customer_contact=$row['customer_contact'];
               $customer_email=$row['customer_email'];
               $customer_address=$row['customer_address'];

            }else{
               header('location:'.SITEURL.'admin/manage-order.php');
            }
            

          }else{
              header('loaction:'.SITEURL.'admin/manage-order.php');
          }

         ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name : </td>
                    <td><?php echo $food; ?></td>
                   
                </tr>
                <tr>
                    <td>Food Price : </td>
                     <td>
                         <input type="number" name="price" value="<?php echo $price; ?>">
                     </td>
                </tr>
                <tr>
                    <td>Quantity : </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status : </td>
                    <td>
                       <select name="status" id="">
                           <option <?php if($status=='Ordered') echo "selected"; ?> value="Ordered">Ordered</option>
                           <option <?php if($status=='On-Delivery') echo "selected"; ?> value="On-Delivery">On-Delivery</option>
                           <option <?php if($status=='Delivered') echo "selected"; ?> value="Delivered">Delivered</option>
                           <option <?php if($status=='Cancelled') echo "selected"; ?> value="Cancelled">Cancelled</option>
                       </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name : </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact : </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email : </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address : </td>
                    <td>
                       <textarea name="customer_address" id="" cols="20" rows="10">
                           <?php echo $customer_address; ?>
                       </textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="hidden" name='id' value='<?php echo $id; ?>'>
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


        <?php

         if(isset($_POST['submit'])){
            
            $id2=$_POST['id'];
            $price2=$_POST['price'];
            $qty2=$_POST['qty'];
            $total2=$price2*$qty2;
            $status2=$_POST['status'];
            $customer_name2=$_POST['customer_name'];
            $customer_contact2=$_POST['customer_contact'];
            $customer_email2=$_POST['customer_email'];
            $customer_address2=$_POST['customer_address'];

            // Sql query to update
            $sql2="UPDATE tbl_order SET
                   price=$price2,
                   qty=$qty2,
                   total=$total2,
                   status='$status2',
                   customer_name='$customer_name2',
                   customer_contact='$customer_contact2',
                   customer_email='$customer_email2',
                   customer_address='$customer_address2'
                   WHERE id=$id2
            ";

            // Execute the query
            $res2=mysqli_query($conn,$sql2);

            if($res2==TRUE){
                $_SESSION['update']="<div class='success'>Successfull in updating!!</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }else{
                $_SESSION['update']="<div class='success'>Failed updating!!</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }




         }


         ?>

    </div>
</div>



<!-- Main content ends here -->

<?php include('partials/footer.php');  ?>