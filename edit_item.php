<?php
require('connection.php');
require('session.php');
?>

<html>
    <head>
        <title>Edit Item</title>
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

                $sql="SELECT * FROM item WHERE item_no=$getid";

                $query=$conn->query($sql);

                $data=mysqli_fetch_assoc($query);

                $item_no=$data['item_no'];
                $item_name=$data['item_name'];
                $item_dept=$data['item_dept'];
                $price=$data['price'];
                $quantity=$data['quantity'];
            }
            else {
                // Initialize variables if $_GET['id'] is not set
                $item_no= '';
                $item_name= '';
                $item_dept='';
                $price='';
                $quantity='';
            }

        
            // Update item details
            if(isset($_GET['item_name'])){
                        $new_item_name = $_GET['item_name'];
                        $new_item_dept = $_GET['item_dept'];
                        $new_price = $_GET['price'];
                        $new_quantity = $_GET['quantity'];
                        $new_item_no = $_GET['item_no'];
        
                        // Validate if the new department is logical for the item
                        if (!isValidDepartmentForItem($new_item_name, $new_item_dept)) {
                           echo 'Invalid department for the selected item.';
                           //echo "Invalid department for the selected item. Item: $new_item_name, Department: $new_item_dept";
                        } 
                        else {
                            // Perform the update
                            $sql2 = "UPDATE item SET item_name = '$new_item_name',
                                    item_dept = '$new_item_dept',
                                    price = '$new_price',
                                    quantity = '$new_quantity'
                                    WHERE item_no = $new_item_no";
        
                            if($conn->query($sql2) == true){
                                echo 'Updated Successfully';
                            }
                            else{
                                echo 'Not Updated';
                            }
                        }
                    }
        
                    // Function to check if the department is valid for any item
                    function isValidDepartmentForItem($itemname, $alloweddept) {
                        global $conn;  
        
                        $sql = "SELECT COUNT(*) as count FROM item_allowed_department WHERE item_name = '$itemname' AND allowed_dept = '$alloweddept'";
                        $query = $conn->query($sql);
                        $result = mysqli_fetch_assoc($query);
        
                        return $result['count'] > 0;
                    }
        
                    // Fetch department data for dropdown
                    $sql1 = "SELECT * FROM department";
                    $query = $conn->query($sql1);
                ?>
        
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
                    Item:<br>
                    <input type="text" name="item_name" value="<?php echo $item_name?>"><br><br>
                    Item_Department:<br>
                    <select name="item_dept">
                        <?php
                            // Populate dropdown list with department options
                            while($data = mysqli_fetch_array($query)){
                                $dept_no = $data['dept_no'];
                                $dept_name = $data['dept_name'];
                                ?>
                                <option value='<?php echo $dept_no?>'<?php if($dept_no==$item_dept){echo 'selected';}?>>
                                    <?php echo $dept_name?>
                                </option>
                                <?php
                            }
                        ?>
                    </select><br><br>
                    Price:<br>
                    <input type="text" name="price" value="<?php echo $price?>"><br><br>
                    Quantity:<br>
                    <input type="text" name="quantity" value="<?php echo $quantity?>"><br><br>
                    <input type="text" name="item_no" value="<?php echo $item_no?>" hidden>
                    <input type="submit" value="submit"  class='btn btn-dark'>
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
