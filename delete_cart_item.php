<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

// Include database connection
include('./assets/php/connection.php');

// Check if the delete button is clicked and if the product_id is set
if (isset($_POST['delete_item']) && isset($_POST['product_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['id'];
    // Sanitize the product_id
    $product_id = $_POST['product_id'];

    // Delete the item from the cart table for the specific user_id and product_id
    $delete_query = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id";

    if ($conn->query($delete_query) === TRUE) {
        // Item deleted successfully, redirect back to cart.php
        header("Location: cart.php");
        exit();
    } else {
        // Error occurred while deleting the item
        echo "Error: " . $conn->error;
    }
} else {
    // Redirect back to cart.php if delete button is not clicked or product_id is not set
    header("Location: cart.php");
    exit();
}

// Close database connection
$conn->close();
?>
