<?php
require('connection.php');
require('session.php');
?>

<html>
    <head>
        <title>Add VALID_ITEM_DEPARTMENT</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

    <?php
        // Fetch department data for dropdown
        $sql1 = "SELECT * FROM department";
        $query = $conn->query($sql1);
    ?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="GET">
    Item Name:<br>
    <input type="text" name="item_name" required><br><br>

    Item Department:<br>
    <select name="allowed_dept" required>
        <?php
            // Populate dropdown list with department options
            while ($data = mysqli_fetch_array($query)) {
                $dept_no = $data['dept_no'];
                $dept_name = $data['dept_name'];
        ?>
            <option value='<?php echo $dept_no?>'>
                <?php echo $dept_name?>
            </option>
        <?php
            }
        ?>
    </select><br><br>

    <input type="submit" value="Add Item">
</form>

<?php
    // Process the form submission
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['item_name']) && isset($_GET['allowed_dept'])) {
        $item_name = $_GET['item_name'];
        $allowed_department = $_GET['allowed_dept'];

        // Insert data into the item_allowed_departments table
        $sql_insert = "INSERT INTO item_allowed_department (item_name, allowed_dept) VALUES ('$item_name', '$allowed_department')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Item added successfully!";
        } else {
            echo "Error adding item: " . $conn->error;
        }
    }
?>

    </body>
</html>
