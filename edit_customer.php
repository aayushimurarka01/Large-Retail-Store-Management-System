<?php
    require('connection.php');
    require('session.php');
?>

<html>
    <head>
        <title>Edit Customers</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <?php
            if(isset($_GET['id'])){
                $getid=$_GET['id'];

                $sql="SELECT * FROM customer WHERE cust_no=$getid";

                $query=$conn->query($sql);

                $data=mysqli_fetch_assoc($query);
                 $cust_no=$data['cust_no'];
                 $cust_name=$data['cust_name'];
                 $job_title=$data['job_title'];
                
            }
            // Update customer details
            if(isset($_GET['cust_name'])){
                $new_cust_name=$_GET['cust_name'];
                $new_job_title=$_GET['job_title'];
                $new_cust_no=$_GET['cust_no'];
                        
                            $sql2 = "UPDATE customer SET 
                                    cust_name = '$new_cust_name',
                                    job_title = '$new_job_title'
                                    WHERE cust_no = $new_cust_no ";
        
                            if($conn->query($sql2) == true){
                                echo 'Updated Successfully';
                            }
                            else{
                                echo 'Not Updated';
                            }
                        }
    
        ?>
        
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
                    Customer_Name:<br>
                    <input type="text" name="cust_name" value="<?php echo $cust_name?>"><br><br>
                    Job_Title:<br>
                    <input type="text" name="job_title" value="<?php echo $job_title ?>"><br><br>
                    <input type="text" name="cust_no" value="<?php echo $cust_no ?>" hidden><br><br>
                    <input type="submit" value="submit">
                </form> 
            </body>
        </html>
    </body>
</html>
