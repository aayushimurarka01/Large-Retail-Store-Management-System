<?php
require('connection.php');
require('session.php');
?>

<html>
    <head>
        <title>Edit Salesperson</title>
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
            if(isset($_GET['id'])){
                $getid=$_GET['id'];

                $sql="SELECT * FROM salesperson WHERE sales_id=$getid";

                $query=$conn->query($sql);

                $data=mysqli_fetch_assoc($query);

                $sales_id=$data['sales_id'];
                $sales_name=$data['sales_name'];
                $dept_no=$data['dept_no'];
                
            }
            else {
                // Initialize variables if $_GET['id'] is not set
                $sales_id= '';
                $sales_name= '';
                $dept_no='';
            }
            // Update salesperson details
            if(isset($_GET['sales_name'])){
                        $new_sales_name = $_GET['sales_name'];
                        $new_sales_dept_no = $_GET['dept_no'];
                        $new_sales_id = $_GET['sales_id'];
                        
                            $sql2 = "UPDATE salesperson SET sales_name = '$new_sales_name',
                                    dept_no = '$new_sales_dept_no'
                                    WHERE sales_id = $new_sales_id";
        
                            if($conn->query($sql2) == true){
                                echo 'Updated Successfully';
                            }
                            else{
                                echo 'Not Updated';
                            }
                        }
                        // Fetch department data for dropdown
                        $sql1 = "SELECT * FROM department";
                        $query = $conn->query($sql1);
        ?>
        
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
                    Salesperson:<br>
                    <input type="text" name="sales_name" value="<?php echo $sales_name?>"><br><br>
                    Department:<br>
                    <select name="dept_no">
                        <?php
                            // Populate dropdown list with department options
                            while($data = mysqli_fetch_array($query)){
                                $dept_num = $data['dept_no'];
                                $dept_name = $data['dept_name'];
                                ?>
                                <option value='<?php echo $dept_num?>'<?php if($dept_num==$dept_no){echo 'selected';}?>>
                                    <?php echo $dept_name?>
                                </option>
                                <?php
                            }
                        ?>
                    </select><br><br>
                    <input type="text" name="sales_id" value="<?php echo $sales_id?>" hidden>
                    <input type="submit" value="submit" class='btn btn-dark'>
                </form> 
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
    </body>
</html>
