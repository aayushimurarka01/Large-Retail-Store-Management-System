<?php
    require('connection.php');
    require('session.php');
?>
<html>
    <head>
        <title>List of Users</title>
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
            $sql="SELECT * FROM users";
            $query=$conn->query($sql);
            echo "<table class='table table-secondary'><tr><th>User_Id</th><th>User_First_Name</th><th>User_Last_Name</th><th>User_Email</th><th>User_Type</th><th>Update</th></tr>";
            while($data=mysqli_fetch_assoc($query)){
                 $user_id=$data['user_id'];
                 $user_first_name=$data['user_first_name'];
                 $user_last_name=$data['user_last_name'];
                 $user_email=$data['user_email'];
                 $user_type=$data['user_role'];
                 //$user_password=$data['user_password'];
                 echo "<tr>
                 <td>$user_id</td>
                 <td>$user_first_name</td>
                 <td>$user_last_name</td>
                 <td>$user_email</td>
                 <td>$user_type</td>
                 <td><a href='edit_users.php?id=$user_id' class='btn btn-dark'>Edit</a></td>
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
