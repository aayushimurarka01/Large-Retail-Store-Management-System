<?php
    require('connection.php');
    require('session.php');
?>

<html>
    <head>
        <title>List of Order</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

    <div class="container bg-light">
            <div class="container-fluid border-bottom"><!--topbar-->
                <?php include('topbar.php')?>
                
            </div><!--end of topbar-->
            <div class="container-fluid">
                <div class="row"><!--start of row-->
                    <div class="col-sm-3 bg-light p-0 m-0"><!--left bar-->
                    <?php include('leftbar.php')?>
                    </div><!--end of left-->
                    <div class="col-sm-9 border-start "><!--start of right-->
                        <div class="container p-4 m-4"><!--start of container-->
                        <?php
                        $sql="SELECT * FROM order_table";
                        $query=$conn->query($sql);
                        echo "<table class='table table-secondary'><tr><th>Order_No</th><th>Customer_No</th><th>Price</th><th>Quantity</th></tr>";
                        while($data=mysqli_fetch_assoc($query)){
                            $order_no=$data['order_no'];
                            $cust_no=$data['cust_no'];
                            $price=$data['price'];
                            $quantity=$data['quantity'];
                            echo "<tr>
                            <td>$order_no</td>
                            <td>$cust_no</td>
                            <td>$price</td>
                            <td>$quantity</td>
                            </tr>";
                            }
                            echo "</table>";
                        ?>
                        </div><!--end of container-->
                    </div><!--end of right-->
                </div><!--end of row-->
            </div>
            
            <div class="container-fluid border-top text-dark">
            <?php include('bottombar.php')?>          
            </div>
        </div><!--@end of container-->

        
        
    </body>
</html>
