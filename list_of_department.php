<?php
    require('connection.php');
    require('session.php');
?>

<html>
    <head>
        <title>List of Department</title>
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
                        $sql="SELECT * FROM department";
                        $query=$conn->query($sql);
                        echo "<table class='table table-secondary'><tr><th>Department_No</th><th>Department</th><th>Update</th></tr>";
                        while($data=mysqli_fetch_assoc($query)){
                            $dept_no=$data['dept_no'];
                            $dept_name=$data['dept_name'];
                            echo "<tr>
                            <td>$dept_no</td>
                            <td>$dept_name</td>
                            <td><a href='edit_department.php?id=$dept_no' class='btn btn-dark'>Edit</a></td>
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
