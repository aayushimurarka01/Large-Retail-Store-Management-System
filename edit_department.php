<?php
    require('connection.php');
    require('session.php');
?>

<html>
    <head>
        <title>Edit Department</title>
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
                		$get_id=$_GET['id'];

                $sql="SELECT * FROM department WHERE dept_no=$get_id";

                $query=$conn->query($sql);
                $data=mysqli_fetch_assoc($query);
                $dept_no=$data['dept_no'];
                $dept_name=$data['dept_name'];

            }
            else {
                // Initialize variables if $_GET['id'] is not set
                $dept_no = '';
                $dept_name = '';
            }
            
        ?>
        <form action="edit_department.php" method="POST">
            Department:<input type="text" name="dept_name" value="<?php echo $dept_name?>"><br><br>
            <input type="hidden" name="dept_no" value="<?php echo $dept_no; ?>">
            <input type="submit" value="Update"  class='btn btn-dark'>

        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST['dept_name'])){
                $new_dept_name=$_POST['dept_name'];
                $new_dept_no=$_POST['dept_no'];

                $sql1="UPDATE department SET dept_name='$new_dept_name' WHERE dept_no='$new_dept_no'";

                if($conn->query($sql1)== true){
                    echo 'Updated Successfully';
                }
                else{
                        echo 'Not Updated';
                }
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
