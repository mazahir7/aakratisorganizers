<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Product</title>
    <link rel="stylesheet" href="./assets/css/style-prefix.css">
    <!-- <link rel="stylesheet" href="./assets/css/product-page.css"> -->
    <link rel="shortcut icon" href="./assets/images/logo/logo.png" type="image/x-icon">
    <script src="./assets/js/script.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <script src="https://kit.fontawesome.com/13a65c2b45.js" crossorigin="anonymous"></script>
    <script defer src="./assets/js/script2.js"></script>

    <style>
        /* Style for the ul element */
        .cart-ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        /* Style for the li elements */
        .cart-li {
            margin-bottom: 50px;
            padding: 15px;
            background-color: #fff;
            border-radius: 10px;
            border: 2px solid #000;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        /* Hover effect for li elements */
        .cart-li:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .product-img {
            width: 100px;
            height: 100px;
            margin-right: 20px;
            border: 2px solid #000;
            border-radius: 5px;
        }
        
        ul li{
            display: flex;
            gap: 20px;
            justify-content: start;
            align-items: center;
        }
        
        ul li div{
            font-size: 22px;
        }

        .delete{
            color: red;
            transform: scale(2.1);
            padding: 2px;
            margin: 0 20px;
            cursor: pointer;
            box-shadow: 0 0 2px #0002;
            transition: all .3s ease;
            border: 1px solid red;
            border-radius: 2px;
        }
        
        .delete:hover{
            transform: scale(2.3);
        }

        .padd{
            padding: 50px 20px 80px;
        }

        .padd h2{
            padding: 20px 0;
        }
        
        .checkout{
            width: 500px;
            border: 2px solid #000;
            border-radius: 5px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-size: 24px;
        }

        .cupon-code{
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .cupon-code input{
            width: 200px;
            padding: 3px 5px;
        }

        .cupon-code button{
            font-size: 22px;
            font-weight: 700;
            background: #668363;
            background: hsl(152, 51%, 52%);
            padding: 2px 4px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap:3px;
        }
        
        
        .cupon-code .status{
            position: absolute;
            bottom: -50%;
            font-size: 14px;
            font-weight: 700;
            color: hsl(152, 51%, 52%);
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
        
    <div class="overlay" data-overlay></div>
    <?php include_once "header.php"; ?>

    
    <div class="container padd">
    <?php
      
            // Include database connection

            include('./assets/php/connection.php');

            // Get user_id from session
            $user_id = $_SESSION['id'];

            // Fetch cart data from the database
            $cart_query = "SELECT cart.*, product.image FROM cart JOIN product ON cart.product_id = product.id WHERE user_id = $user_id";
            $cart_result = $conn->query($cart_query);

            // Check if cart data is available in the database
            if ($cart_result->num_rows > 0) {
                // Display cart items
                echo "<h2>Cart Items:</h2>";
                echo "<form action='delete_cart_item.php' method='post'>";
                echo "<ul class='cart-ul'>";
                while ($item = $cart_result->fetch_assoc()) {
                    echo "<li class='cart-li'>";
                    echo "<img src='./assets/images/Product/{$item['image']}' alt='Product Image' class='product-img'>";
                    
                    echo "<div>
                    <span><b>Dimensions - </b></span>
                    <span>{$item['size']}</span>
                    </div>";
                    
                    echo "<div>
                    <span><b>Color - </b></span>
                    <span>{$item['color']}</span>
                    </div>";
            
                    echo "<div>
                    <span><b>Quantity - </b></span>
                    <span>{$item['quantity']}</span>
                    </div>";
                    
                    echo "<div>
                    <span><b>Price - </b></span>
                    <span><b>₹ </b>{$item['price']}</span>
                    </div>";
                    
                    // Add a hidden input field for product_id to pass it to the delete_cart_item.php
                    echo "<input type='hidden' name='product_id' value='{$item['product_id']}'>";
            
                    echo "<button type='submit' name='delete_item' class='delete'><ion-icon name='trash-outline'></ion-icon></button>";
            
                    echo "</li>";
                }
                echo "</ul>";
                echo "</form>"; // Close the form
            } else {
                echo "<p>Your cart is empty.</p>";
            }

            // Close database connection
            $conn->close();

            ?>

            <div class="checkout">
                <p class="total">Total : ₹ 220.99</p>
                <div class="cupon-code">
                    <input type="text" name="cupon" placeholder="enter the code">
                    <button><ion-icon name="checkmark-circle-outline"></ion-icon> check</button>
                    <span class="status">applied</span>
                </div>

                <div class="pay-out">
                    <p class="final-total">Final Total : ₹ 220.99</p>
                    <button class="play">Proceed to Pay</button>
                </div>
            </div>
    </div>

    <?php include_once "footer.php"; ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
