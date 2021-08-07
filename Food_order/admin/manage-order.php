<?php include('partials/menu.php'); ?>




<!-- main content starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ORDER</h1>


        <br>
        <br>
        <?php

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>


        <br>
        <table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>

            <?php

            //    sql query to get all details from tbl_order
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Count the number of rows
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {

                while ($row = mysqli_fetch_assoc($res)) {

                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $orderDate = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

            ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $orderDate; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>

                        </td>
                    </tr>

            <?php
                }
            } else {

                echo "<div class='error'>Orders are not available yet!!</div>";
            }


            ?>


        </table>
    </div>
</div>

<!-- main content ends here -->

<?php include('partials/footer.php');    ?>