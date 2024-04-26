<?php
    require('connection.php');
    require('session.php');

    $sql1="SELECT * FROM department";
    $query1=$conn->query($sql1);

    $data_list=array();

    while($data1=mysqli_fetch_assoc($query1)){
        $dept_no=$data1['dept_no'];
        $dept_name=$data1['dept_name'];

        $data_list[$dept_no]=$dept_name;
    }
?>

<html>
    <head>
        <title>List of Salesperson</title>
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
            $sql="SELECT * FROM salesperson";
            $query=$conn->query($sql);
            echo "<table class='table table-secondary'><tr><th>Salesperson_Id</th><th>Salesperson_Name</th><th>Department</th><th>Update</th></tr>";
            while($data=mysqli_fetch_assoc($query)){
                 $sales_id=$data['sales_id'];
                 $sales_name=$data['sales_name'];
                 $dept_no=$data['dept_no'];
                 echo "<tr>
                 <td>$sales_id</td>
                 <td>$sales_name</td>
                 <td>$data_list[$dept_no]</td>
                 <td><a href='edit_salesperson.php?id=$sales_id'class='btn btn-dark'>Edit</a></td>
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
