<?php
require_once("./assets/php/connection.php");

// Start session
session_start();

// Get form data
$full_name = $_POST['full_name'];
$contact_number = $_POST['contact_number'];
$city = $_POST['city'];
$address = $_POST['address'];
$state = $_POST['state'];
$country = $_POST['country'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Prepare SQL statement to insert data into users table
$sql = "INSERT INTO users (full_name, contact_number, city, address, state, country, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $full_name, $contact_number, $city, $address, $state, $country, $email, $password);

// Execute the statement
if ($stmt->execute()) {
    // Registration successful, store user information in session
    $_SESSION['email'] = $email;
    $_SESSION['full_name'] = $full_name;
    
    // Redirect to index.php
    header("Location: index.php");
    exit; // Ensure script stops execution after redirection
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
