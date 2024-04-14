<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.html");
    exit();
}

// Include database connection
include('./assets/php/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userId = $_SESSION['id'];
    $productId = $_POST['product_id'];
    $selectedSize = $_POST['selected_size'];
    $selectedColor = $_POST['selected_color'];
    $selectedQuantity = $_POST['selected_quantity'];
    $selectedPrice = $_POST['selected_price'];

    // Insert data into the cart table
    $insertQuery = "INSERT INTO cart (user_id, product_id, size, color, price, quantity) 
                    VALUES ('$userId', '$productId', '$selectedSize', '$selectedColor', '$selectedPrice', '$selectedQuantity')";

    if ($conn->query($insertQuery) === TRUE) {
        header("Location: cart.php");
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
} else {
    // If the form is not submitted, redirect to the product page or display an error message
    echo "Form submission error.";
}

// Close database connection
$conn->close();
?>
