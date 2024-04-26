<?php
// Include database connection
include('connection.php');
include('session.php');

$status = "";

// Ensure the shopping cart is initialized
if (!isset($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = [];
}

// Add to cart action
if (isset($_POST['item_no']) && $_POST['item_no'] != "") {
    $item_no = $_POST['item_no'];
    $sql = "SELECT * FROM `item` WHERE `item_no`='$item_no'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $item_name = $row['item_name'];
        $price = $row['price'];
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

        // Get department ID for the item
        $department_id = $row['item_dept'];

        // Retrieve salespersons for the department
        $sql_salespersons = "SELECT * FROM `salesperson` WHERE `dept_no`='$department_id'";
        $result_salespersons = $conn->query($sql_salespersons);

        // Build dropdown menu for salesperson selection
        $salesperson_select = "<select name='salesperson_$item_no'>";
        while ($salesperson_row = $result_salespersons->fetch_assoc()) {
            $selected = isset($_SESSION["shopping_cart"][$item_no]) && isset($_SESSION["shopping_cart"][$item_no]['salesperson_id']) && $_SESSION["shopping_cart"][$item_no]['salesperson_id'] == $salesperson_row['sales_id'] ? "selected" : "";
            $salesperson_select .= "<option value='" . $salesperson_row['sales_id'] . "' $selected>" . $salesperson_row['sales_name'] . "</option>";
        }
        $salesperson_select .= "</select>";

        // Set salesperson selection in session
        $_SESSION["shopping_cart"][$item_no] = array(
            'item_name' => $item_name,
            'price' => $price,
            'quantity' => $quantity,
            'salesperson_id' => isset($salesperson_row['sales_id']) ? $salesperson_row['sales_id'] : null // Store selected salesperson ID if available
        );

        $status = "<div class='box'>Product is added to your cart!</div>";
    } else {
        $status = "<div class='box' style='color: red;'>Item not found!</div>";
    }
}

// Remove from cart action
if (isset($_POST['remove_item']) && $_POST['remove_item'] != "") {
    $item_no = $_POST['remove_item'];
    if (isset($_SESSION["shopping_cart"][$item_no])) {
        unset($_SESSION["shopping_cart"][$item_no]);
        $status = "<div class='box'>Product is removed from your cart!</div>";
    }
}
?>

<div class="cart_div">
    <a href="cart.php" class="cart_link">
        <img src="cart.jpeg" class="cart_icon" />
        <span class="cart_count">
            <?php
            echo isset($_SESSION["shopping_cart"]) ? count($_SESSION["shopping_cart"]) : 0;
            ?>
        </span>
    </a>
</div>

<div class="product_container">
    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Salesperson</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $sql = "SELECT * FROM `item`";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
            // Get department ID for the item
            $department_id = $row['item_dept'];
            // Retrieve salespersons for the department
            $sql_salespersons = "SELECT * FROM `salesperson` WHERE `dept_no`='$department_id'";
            $result_salespersons = $conn->query($sql_salespersons);
            // Build dropdown menu for salesperson selection
            $salesperson_select = "<select name='salesperson_".$row['item_no']."'>";
            while ($salesperson_row = $result_salespersons->fetch_assoc()) {
                $selected = isset($_SESSION["shopping_cart"][$row['item_no']]) && isset($_SESSION["shopping_cart"][$row['item_no']]['salesperson_id']) && $_SESSION["shopping_cart"][$row['item_no']]['salesperson_id'] == $salesperson_row['sales_id'] ? "selected" : "";
                $salesperson_select .= "<option value='".$salesperson_row['sales_id']."' $selected>".$salesperson_row['sales_name']."</option>";
            }
            $salesperson_select .= "</select>";
            echo "<tr>
                <td>".$row['item_name']."</td>
                <td>Rs.".$row['price']."</td>
                <td>
                    <form method='post' action=''>
                        <input type='hidden' name='item_no' value='".$row['item_no']."'/>
                        <input type='number' name='quantity' value='1' min='1' max='".$row['quantity']."' />
                    </td>
                    <td>".$salesperson_select."</td>
                    <td>
                        <button type='submit' class='buy'>Buy Now</button>
                    </form>
                    </td>
                    <td>
                    <form method='post' action=''>
                        <input type='hidden' name='remove_item' value='".$row['item_no']."'/>
                        <button type='submit' class='remove'>Remove</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
    <?php echo $status; ?>
</div>

<style>
    .cart_div {
        position: relative;
        display: inline-block;
    }

    .cart_link {
        text-decoration: none;
    }

    .cart_icon {
        width: 32px; /* Set the desired size */
        height: auto;
    }

    .cart_count {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 5px;
        font-size: 12px;
    }
</style>
