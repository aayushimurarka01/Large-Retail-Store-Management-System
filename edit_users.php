<?php
require('connection.php');
require('session.php');
?>

<html>
    <head>
        <title>Edit Users</title>
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

                $sql="SELECT * FROM users WHERE user_id=$getid";

                $query=$conn->query($sql);

                $data=mysqli_fetch_assoc($query);
                 $user_id=$data['user_id'];
                 $user_first_name=$data['user_first_name'];
                 $user_last_name=$data['user_last_name'];
                 $user_email=$data['user_email'];
                 $user_password=$data['user_password'];
                
            }
            else {
                // Initialize variables if $_GET['id'] is not set
                $user_id= '';
                $user_first_name= '';
                $user_last_name='';
                $user_email='';
                $user_password='';
            }
            // Update users details
            if(isset($_GET['user_first_name'])){
                $new_user_first_name=$_GET['user_first_name'];
                $new_user_last_name=$_GET['user_last_name'];
                $new_user_email=$_GET['user_email'];
                $new_user_password=$_GET['user_password'];
                $new_user_id=$_GET['user_id'];
                        
                            $sql2 = "UPDATE users SET 
                                    user_first_name = '$new_user_first_name',
                                    user_last_name = '$new_user_last_name',
                                    user_email = '$new_user_email',
                                    user_password = '$new_user_password'
                                    WHERE user_id = $new_user_id";
        
                            if($conn->query($sql2) == true){
                                echo 'Updated Successfully';
                            }
                            else{
                                echo 'Not Updated';
                            }
                        }
    
        ?>
        
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
                    Users_First_Name:<br>
                    <input type="text" name="user_first_name" value="<?php echo $user_first_name?>"><br><br>
                    Users_Second_Name:<br>
                    <input type="text" name="user_last_name" value="<?php echo $user_last_name ?>"><br><br>
                    Users_Email:<br>
                    <input type="email" name="user_email" value="<?php echo $user_email?>"><br><br>
                    Users_Password:<br>
                    <input type="password" name="user_password" value="<?php echo $user_password?>"><br><br>
                    <input type="text" name="user_id" value="<?php echo $user_id ?>" hidden><br><br>
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
