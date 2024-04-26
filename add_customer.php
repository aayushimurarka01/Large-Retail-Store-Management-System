<?php
require('connection.php');
require('session.php');
?>
<html>
    <head>
        <title>Add Customers</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

        <form action="<?php $_SERVER['PHP_SELF'];?>" method="GET">
            Customers_Name:<br>
            <input type="text" name="cust_name"><br><br>
            Customers_Job_Title:<br>
            <input type="text" name="job_title"><br><br>
            <input type="submit" value="submit">
        </form>
        <?php
            if(isset($_GET['cust_name'])){
                $cust_name=$_GET['cust_name'];
                $job_title=$_GET['job_title'];

                $sql="INSERT INTO customer(cust_name,job_title) 
                    VALUES (' $cust_name','$job_title')";

                if($conn->query($sql)==true){
                    echo "Data inserted";
                }
                else{
                echo "Data Not inserted";
                }
            }
        
        ?>
    </body>
</html>
