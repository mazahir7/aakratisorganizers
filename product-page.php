<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Product</title>
    <link rel="stylesheet" href="./assets/css/style-prefix.css">
    <link rel="stylesheet" href="./assets/css/product-page.css">
    <link rel="shortcut icon" href="./assets/images/logo/logo.png" type="image/x-icon">
    <script src="./assets/js/script.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <script src="https://kit.fontawesome.com/13a65c2b45.js" crossorigin="anonymous"></script>
    <script defer src="./assets/js/script2.js"></script>


    <style>
        
        .size-option, .color-option {
            padding: 5px 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
            margin-bottom: 10px; /* Add margin between each option */

        }
        .size-options, .color-options{
            display: flex;
            margin: 10px;
        }

        .color-option,.size-option{
            border: 5px solid rgba(0,0,,0,0.1);
        }

        .color-option {
            width: 40px; /* Set width for better alignment */
            height: 40px; /* Set height for better alignment */
            background-color: transparent; /* Set transparent background */
        }

        /* Optional: Add hover effect */
        .size-option:hover, .color-option:hover {
            filter: brightness(0.9); /* Reduce brightness on hover */
        }

        /* Optional: Add selected state */
        .size-option.selected, .color-option.selected {
            border: 5px solid #000; /* Add border for selected state */
            /* box-shadow: 0 0 5px #000; */
        }


    </style>
</head>
<body>
  <div class="overlay" data-overlay></div>
    
    
<?php include_once "header.php"; ?>
    <section>
        <main class="container">
        <?php
// Include your database connection file
include('./assets/php/connection.php');

// Ensure 'id' is set in the URL parameter
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $productId = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch product details from the database
    $sql = "SELECT p.*, c.category_name, s.subcategory_name
            FROM product p
            LEFT JOIN category c ON p.category_id = c.id
            LEFT JOIN sub_category s ON p.sub_category_id = s.id
            WHERE p.id = $productId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <div class="product-info">
            <div class="product-image-box">
                <img src="./assets/images/Product/<?php echo $row['image']; ?>" alt="product image" class="product-image">
            </div>
            <div class="product-details">
                <h1 class="product-name"><?php echo $row['name']; ?></h1>
                <div class="rating">
                    <?php
                    // Display star icons based on the 'rating' value
                    $rating = $row['rating'];
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                            echo '<i class="fa-sharp fa-solid fa-star"></i>';
                        } else {
                            echo '<i class="fa-sharp fa-regular fa-star"></i>';
                        }
                    }
                    ?>
                </div>

                <a href="#">
                    <div class="category-below-product">
                        <p><?php echo $row['subcategory_name']; ?></p>
                    </div>
                </a>

                <div class="product-price">
                    <p id="pay-price" class="product-main-price">₹<?php echo number_format($row['discounted_price'], 2); ?></p>
                    <?php if ($row['discounted_price'] !== null) { ?>
                        <del><p class="product-del-price">₹<?php echo number_format($row['actual_price'], 2); ?></p></del>
                    <?php } ?>
                </div>

                <p class="product-description"><?php echo $row['description']; ?></p>


                <!-- add fields and make fillcart.php -->
                <form action="fillCart.php" method="post" class="product-form">

                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="selected_size" id="selected-size" value="">
                    <input type="hidden" name="selected_color" id="selected-color" value="">
                    <input type="hidden" name="selected_quantity" id="selected-quantity" value="1">
                    <input type="hidden" name="selected_price" id="selected-price" value="0">

                    <label for="size">Size:</label>
                    <div class="size-options">
                        <?php
                        // Fetch product variations (sizes) from the database
                        $sizeQuery = "SELECT DISTINCT size, price FROM product_variations_dimension WHERE product_id = $productId";
                        $sizeResult = $conn->query($sizeQuery);
                        if ($sizeResult->num_rows > 0) {
                            while ($sizeRow = $sizeResult->fetch_assoc()) {
                                echo "<button type='button' class='size-option' data-size='" . $sizeRow['size'] . "' data-price='" . $sizeRow['price'] . "'>" . $sizeRow['size'] . "</button>";
                            }
                        } else {
                            echo "<p>No sizes available</p>";
                        }
                        ?>
                    </div>

            
            
                    <label for="size">Color:</label>
                    <div class="color-options">
                        <?php
                        // Fetch product variations (colors) from the database
                        $colorQuery = "SELECT DISTINCT color FROM product_variations_colors WHERE product_id = $productId";
                        $colorResult = $conn->query($colorQuery);
                        if ($colorResult->num_rows > 0) {
                            while ($colorRow = $colorResult->fetch_assoc()) {
                                // Set inline style with color background
                                echo "<button type='button' class='color-option' style='background-color: " . $colorRow['color'] . "' data-color='" . $colorRow['color'] . "'></button>";
                            }
                        } else {
                            echo "<p>No colors available</p>";
                        }
                        ?>
                    </div>
                        <label for="quantity" class="form-label">Quantity:</label>
                        <div class="quantity-input">
                            <button type="button" id="decrement-quantity">-</button>
                            <span id="quantity">1</span>
                            <button type="button" id="increment-quantity">+</button>
                        </div>
                        
                        <div class="button-container">
                            <button type="submit" class="form-button">Add to Cart</button>
                            <!-- <button type="submit" class="form-button">Buy Now</button> -->
                        </div>
                </form>

            </div>
        </div>
        <?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}
?>
                <?php
// Ensure 'id' is set in the URL parameter
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $productId = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch subcategory_id based on the provided product_id
    $subcategoryQuery = "SELECT sub_category_id FROM product WHERE id = $productId";
    $subcategoryResult = $conn->query($subcategoryQuery);

    if ($subcategoryResult->num_rows > 0) {
        $subcategoryRow = $subcategoryResult->fetch_assoc();
        $subcategoryId = $subcategoryRow['sub_category_id'];

        // Fetch 5 random products from the same subcategory
        $randomProductsQuery = "SELECT * FROM product WHERE sub_category_id = $subcategoryId ORDER BY RAND() LIMIT 5";
        $randomProductsResult = $conn->query($randomProductsQuery);

        if ($randomProductsResult->num_rows > 0) {
            ?>
            <div class="suggested-posts">
                <h4>You May Like</h4>
                <div class="suggested-posts-card-container">
                    <?php
                    while ($randomRow = $randomProductsResult->fetch_assoc()) {
                        ?>
                        <div class="suggested-post-card">
                            <img src="./assets/images/Product/<?php echo $randomRow['image']; ?>" alt="<?php echo $randomRow['name']; ?>">
                            <div class="suggested-post-card-details">
                                <p class="suggested-post-card-title"><?php echo $randomRow['name']; ?></p>
                                <div class="rating">
                                    <?php
                                    // Display star icons based on the 'rating' value
                                    $rating = $randomRow['rating'];
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="fa-solid fa-star"></i>';
                                        } else {
                                            echo '<i class="fa-regular fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="suggested-post-card-details-price">
                                    <p>₹<?php echo number_format($randomRow['actual_price'], 2); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        } else {
            echo "No suggested products found for this subcategory.";
        }
    } else {
        echo "Error fetching subcategory information.";
    }
} else {
    echo "Invalid product ID.";
}
?>

        </main>
    </section>

    <?php include_once "footer.php"; ?>

    <script>
       document.addEventListener("DOMContentLoaded", function() {
                var quantityValue = 1; // Initial quantity value

        function incrementQuantity() {
            quantityValue++;
            updateQuantityDisplay();
        }

        function decrementQuantity() {
            if (quantityValue > 1) {
                quantityValue--;
                updateQuantityDisplay();
            }
        }

        function updateQuantityDisplay() {
            document.getElementById('quantity').innerText = quantityValue;
            updateQuantity(quantityValue);
        }

        // Select increment and decrement buttons
        var incrementButton = document.getElementById('increment-quantity');
        var decrementButton = document.getElementById('decrement-quantity');

        // Add event listeners to the buttons
        incrementButton.addEventListener('click', incrementQuantity);
        decrementButton.addEventListener('click', decrementQuantity);

                
        const sizeButtons = document.querySelectorAll('.size-option');
        const colorButtons = document.querySelectorAll('.color-option');
        const productPrice = document.getElementById('pay-price');
        const formSize = document.getElementById("selected-size");
        const formColor = document.getElementById("selected-color");
        const formQuantity = document.getElementById("selected-quantity");
        const formPrice = document.getElementById("selected-price");

        sizeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const size = button.dataset.size;
                const price = parseFloat(button.dataset.price);

                updateSize(size);
                updatePrice(price);
                
                sizeButtons.forEach(btn => btn.classList.remove('selected'));
                button.classList.add('selected');
            });
        });

        colorButtons.forEach(button => {
            button.addEventListener('click', function() {
                
                const color = button.dataset.color;
                console.log(color);
                updateColor(color);
                colorButtons.forEach(btn => btn.classList.remove('selected'));
                button.classList.add('selected');
            });
        });

        // Function to update price based on selected size
        function updatePrice(price) {
            formPrice.value  = price.toFixed(2);
            productPrice.innerText = "₹" + price.toFixed(2);
        }

        function updateSize(size) {
            formSize.value = size;
        }
        
        function updateColor(color) {
            formColor.value = color;
        }

        function updateQuantity(quantity) {
            formQuantity.value = quantity;
        }

        });


    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
