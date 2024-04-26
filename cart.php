<?php
// Start session
//session_start();

// Include database connection and session files
include('connection.php');
include('session.php');

// Initialize total price
$total_price = 0;

// Check if shopping cart is not empty
if(isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
    ?>
    <div class="cart">
        <table class="table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each item in the shopping cart
                foreach ($_SESSION["shopping_cart"] as $item_no => $product) {
                    // Calculate subtotal for each item
                    $subtotal = $product["price"] * $product["quantity"];
                    // Update total price
                    $total_price += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $product["item_name"]; ?></td>
                        <td><?php echo "Rs.".$product["price"]; ?></td>
                        <td><?php echo $product["quantity"]; ?></td>
                        <td><?php echo "Rs.".$subtotal; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" align="right"><strong>Total:</strong></td>
                    <td><?php echo "Rs.".$total_price; ?></td>
                </tr>
            </tbody>
        </table>
        
        <!-- Order Form -->
        <div class="order-form">
            <h2>Enter Shipping Information</h2>
            <form method="post" action="place_order.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="job_title">Job Title:</label>
                <input type="text" id="job_title" name="job_title"><br>
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea><br>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required><br>
                <input type="submit" value="Place Order">
            </form>
        </div>
    </div>
    <?php
} else {
    // Display message if cart is empty
    echo "<h3>Your cart is empty!</h3>";
}
?>

<?php
// Store total price in session
$_SESSION["total_price"] = $total_price;

// Store quantity and salesperson selected ID in session
if(isset($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $item_no => $product) {
        $_SESSION["shopping_cart"][$item_no]['quantity'] = $product["quantity"];
        $_SESSION["shopping_cart"][$item_no]['salesperson_id'] = $product["salesperson_id"];
    }
}
?>
