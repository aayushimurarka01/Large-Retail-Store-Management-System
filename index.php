<?php
    session_start();
    $user_first_name=$_SESSION['user_first_name'];
    $user_last_name=$_SESSION['user_last_name'];

    if(!empty($user_first_name)&& !empty($user_last_name)){

    
?>
<html>
    <head>
        <title>Store Management System</title>
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
                    </div><!--end of right-->
                </div><!--end of row-->
            </div>
            
            <div class="container-fluid border-top text-dark">
            <?php include('bottombar.php')?>
                
            </div>
        </div><!--@end of container-->
       
       
    </body>
</html>

 <?php
} else{
       header('location:login.php');
}

?> 
