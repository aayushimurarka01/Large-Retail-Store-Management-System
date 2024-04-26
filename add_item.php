<?php
require('connection.php');
require('session.php');
?>

<html>
    <head>
        <title>Add Item</title>
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
                            $sql1="SELECT * FROM department";
                            $query=$conn->query($sql1);
                            ?>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
                            Item:<br>
                            <input type="text" name="item_name"><br><br>
                            Item_Department:<br>
                            <select name="item_dept">
                            <?php
                            while($data=mysqli_fetch_array($query)){
                            $dept_no=$data['dept_no'];
                            $dept_name=$data['dept_name'];
                            echo "<option value='$dept_no'>$dept_name</option>";
                            }
                            ?>
                
                            </select><br><br>
                            Price:<br>
                            <input type="text" name="price"><br><br>
                            Quantity:<br>
                            <input type="text" name="quantity"><br><br>
                            <input type="submit" value="submit" class='btn btn-dark'>
                            </form>
                            <?php
                            if(isset($_GET['item_name']))
                                {
                                    $item_name=$_GET['item_name'];
                                    $item_dept=$_GET['item_dept'];
                                    $price=$_GET['price'];
                                    $quantity=$_GET['quantity'];


                                    $sql="INSERT INTO item(item_name,item_dept,price,quantity) 
                                    VALUES ('$item_name','$item_dept','$price','$quantity')";

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
