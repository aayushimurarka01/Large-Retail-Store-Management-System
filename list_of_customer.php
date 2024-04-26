<?php
    require('connection.php');
    require('session.php');
?>
<html>
    <head>
        <title>List of Customers</title>
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
            $sql="SELECT * FROM customer";
            $query=$conn->query($sql);
            echo "<table class='table table-secondary'><tr><th>Customer_No</th><th>Customer_Name</th><th>Customer_Address</th><th>Phone_Number</th><th>Job</th></tr>";
            while($data=mysqli_fetch_assoc($query)){
                 $cust_no=$data['cust_no'];
                 $cust_name=$data['cust_name'];
                 $address=$data['address'];
                 $phone_no=$data['phone_no'];
                 $job_title=$data['job_title'];
                 echo "<tr>
                 <td>$cust_no</td>
                 <td>$cust_name</td>
                 <td>$address</td>
                 <td>$phone_no</td>
                 <td>$job_title</td>
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
