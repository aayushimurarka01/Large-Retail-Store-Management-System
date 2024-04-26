<?php
require('connection.php');
require('session.php');
?>
<html>
    <head>
        <title>Add Department</title>
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
                            <form action="add_department.php" method="GET">
                             Department
                            <input type="text" name="dept_name"><br><br>
                            <input type="submit" value="submit"class="btn btn-dark">
                            </form>
                            <?php
                            if(isset($_GET['dept_name'])){
                            $dept_name=$_GET['dept_name'];

                            $sql="INSERT INTO department(dept_name) VALUES ('$dept_name')";

                            if($conn->query($sql)==true){
                            echo "Data inserted";
                            }
                            else{
                            echo "Data Not inserted";
                            }
                            }
        
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
