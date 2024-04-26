<?php
// Include database connection
include('connection.php');
include('session.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
    // Retrieve customer information from the form
    $name = $_POST['name'];
    $job_title = $_POST['job_title'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Retrieve product information from the session
    $total_price = 0;
    $total_quantity = 0;
    foreach ($_SESSION["shopping_cart"] as $item_no => $product) {
        $total_price += $product["price"] * $product["quantity"];
        $total_quantity += $product["quantity"];
    }

    // Insert customer data into the database using prepared statement
    $sql_insert_customer = "INSERT INTO customer (cust_name, address, phone_no,job_title) VALUES (?, ?, ?, ?)";
    $stmt_insert_customer = $conn->prepare($sql_insert_customer);
    $stmt_insert_customer->bind_param("ssss", $name,$address, $phone,$job_title);
    $stmt_insert_customer->execute();

    // Check if customer insertion was successful
    if ($stmt_insert_customer->affected_rows > 0) {
        // If insertion was successful, retrieve customer ID
        $customer_id = $stmt_insert_customer->insert_id;

        // Insert order details into the database
        $sql_insert_order = "INSERT INTO order_table (cust_no, price, quantity) VALUES (?, ?, ?)";
        $stmt_insert_order = $conn->prepare($sql_insert_order);
        $stmt_insert_order->bind_param("iii", $customer_id, $total_price, $total_quantity);
        $stmt_insert_order->execute();

        // Check if order insertion was successful
        if ($stmt_insert_order->affected_rows > 0) {
            // If order insertion was successful, retrieve order ID
            $order_id = $stmt_insert_order->insert_id;

            // Insert order item details into the database
            foreach ($_SESSION["shopping_cart"] as $item_no => $product) {
                $item_name = $product["item_name"];
                $price = $product["price"];
                $quantity = $product["quantity"];
                $salesperson_id = $product["salesperson_id"]; // Retrieve salesperson ID from the session

                // Debugging: Print variables for verification
                //echo "Item No: $item_no, Order No: $order_id, Salesperson ID: $salesperson_id <br>";

                $sql_insert_order_item = "INSERT INTO order_item (order_no, item_no, sales_no) VALUES (?, ?, ?)";
                $stmt_insert_order_item = $conn->prepare($sql_insert_order_item);
                $stmt_insert_order_item->bind_param("iii", $order_id, $item_no, $salesperson_id);
                $stmt_insert_order_item->execute();

                // Check if order item insertion was successful
                if ($stmt_insert_order_item->affected_rows > 0) {
                    echo "Order item inserted successfully!<br>";
                } else {
                    echo "Error inserting order item!<br>";
                }

                // Close the prepared statement for order item insertion
                $stmt_insert_order_item->close();
            }

            // Display success message or perform other actions
            echo "<h3>Order placed successfully!</h3>";

            // Clear the shopping cart after successful order placement
            unset($_SESSION["shopping_cart"]);
        } else {
            // If order insertion failed, display an error message
            echo "<h3>Error placing order. Please try again.</h3>";
        }

        // Close the prepared statement for order insertion
        $stmt_insert_order->close();
    } else {
        // If customer insertion failed, display an error message
        echo "<h3>Error saving customer details. Please try again.</h3>";
    }

    // Close the prepared statement for customer insertion
    $stmt_insert_customer->close();
} else {
    // If form is not submitted via POST method or shopping cart is empty, redirect back to the form page or display an appropriate message
    echo "<h3>Error: Form not submitted or shopping cart is empty.</h3>";
}
?>
