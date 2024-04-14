<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  session_start(); // Start the session

  // Check if the user is logged in
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
      // User is logged in, print session details
      echo "Session ID: " . $_SESSION['id'] . "<br>";
      echo "Session Full Name: " . $_SESSION['full_name'] . "<br>";
      echo "Session Email: " . $_SESSION['email'] . "<br>";
  } else {
      // User is not logged in, redirect to login.php
      header("Location: login.html");
      exit(); // Make sure to exit after redirecting
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aakrati's Organizers</title>

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="./assets/images/logo/logo.png" type="image/x-icon">

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style-prefix.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

</head>

<body>


  <div class="overlay" data-overlay></div>

 <?php include_once "header.php"; ?>




  <!--
    - MAIN
  -->

  <main>

    <!--
      - BANNER
    -->

    <div class="banner">

      <div class="container">

        <div class="slider-container has-scrollbar">

          <div class="slider-item">

            <img src="./assets/images/banner-1.jpg" alt="women's latest fashion sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Trending item</p>

              <h2 class="banner-title">Make-Up Pouch</h2>

              <p class="banner-text">
                starting at ₹ <b>399</b>.00
              </p>

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

          <div class="slider-item">

            <img src="./assets/images/banner-2.jpg" alt="modern sunglasses" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Trending item</p>

              <h2 class="banner-title">12 pieces watch organizer</h2>

              <p class="banner-text">
                starting at ₹ <b>1499</b>.00
              </p>

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

          <div class="slider-item">

            <img src="./assets/images/banner-3.jpg" alt="new fashion summer sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Trending item</p>

              <h2 class="banner-title">Shoe Organizer</h2>

              <p class="banner-text">
                starting at ₹ <b>399</b>.00
              </p>

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

        </div>

      </div>

    </div>





    <!--
      - CATEGORY
    -->

    <?php
    $query = "SELECT id, category_name, image FROM category GROUP BY category_name ORDER BY id";

    // Execute the query
    $result = mysqli_query($conn, $query);
    ?>

<div class="category">
    <div class="container">
        <div class="category-item-container has-scrollbar">

        <?php // Loop through the fetched data

while ($row = mysqli_fetch_assoc($result)) {

            $mainCategory_id = $row["id"];
            $category_name = $row["category_name"];
            $category_image = $row["image"];

            $countQuery = "SELECT COUNT(*) as totalCount FROM sub_category WHERE category_id = $mainCategory_id GROUP BY category_id";

            $subcategoriesCountResult = mysqli_query($conn, $countQuery);

            $subcategoriesCountRow = mysqli_fetch_assoc(
                $subcategoriesCountResult
            );
            if ($subcategoriesCountRow) {
                $subCategory_count = $subcategoriesCountRow["totalCount"];
            } else {
                $subCategory_count = 0;
            }

            // echo "$category_name" . "===" . "$subCategory_count"
            ?>

                <div class="category-item">
                    <div class="category-img-box">
                        <img src="assets/images/products/<?php echo $category_image; ?>" alt="<?php echo $category_name; ?>" width="30">
                    </div>

                    <div class="category-content-box">
                        <div class="category-content-flex">
                            <h3 class="category-item-title"><?php echo $category_name; ?></h3>
                            <p class="category-item-amount">(<?php echo $subCategory_count; ?>)</p>
                        </div>
                        <a href="specificcategory.php?category=<?php echo urlencode(
                            $category_name
                        ); ?>" class="category-btn">Show all</a>
                    </div>
                </div>

            <?php
        } ?>

        </div>
    </div>
</div>


    <!-- -----message--line----- -->

      <div class="message-box-line">
        <h2 class="message-box-text">Free Delievery on orders over ₹1599.00</h2>
      </div>

    <!--
      - PRODUCT
    -->

    <div class="product-container">

      <div class="container">


       


        <div class="product-box">

          <!--
            - PRODUCT MINIMAL
          -->

          <div class="product-minimal">

          <?php
          // Include your database connection file
          include "./assets/php/connection.php";

          // Fetch the latest added 8 products
          $latestProductsQuery = "SELECT p.*, c.category_name 
FROM product p 
INNER JOIN category c ON p.category_id = c.id
ORDER BY p.id DESC 
LIMIT 4;
";
          $latestProductsResult = $conn->query($latestProductsQuery);

          if ($latestProductsResult->num_rows > 0) { ?>
    <div class="product-showcase">
        <h2 class="title">New Arrivals</h2>
        <div class="showcase-wrapper has-scrollbar">
            <div class="showcase-container">
                <?php while ($row = $latestProductsResult->fetch_assoc()) { ?>
                    <div class="showcase">
                        <a href="#" class="showcase-img-box">
                            <img src="./assets/images/Product/<?php echo $row[
                                "image"
                            ]; ?>" alt="<?php echo $row[
    "name"
]; ?>" width="70" class="showcase-img">
                        </a>
                        <div class="showcase-content">
                            <a href="#">
                                <h4 class="showcase-title"><?php echo $row[
                                    "name"
                                ]; ?></h4>
                            </a>
                            <a href="#" class="showcase-category"><?php echo $row[
                                "category_name"
                            ]; ?></a>
                            <div class="price-box">
                                <p class="price">₹<?php echo number_format(
                                    $row["discounted_price"],
                                    2
                                ); ?></p>
                                <del>₹<?php echo number_format(
                                    $row["actual_price"],
                                    2
                                ); ?></del>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </div>
    <?php } else {echo "No latest products found.";}
          ?>


<?php
// Fetch the top 8 products with the highest ratings
$topRatedProductsQuery = "
SELECT p.*, c.category_name 
FROM product p 
INNER JOIN category c ON p.category_id = c.id
ORDER BY rating DESC 
LIMIT 4";
$topRatedProductsResult = $conn->query($topRatedProductsQuery);

if ($topRatedProductsResult->num_rows > 0) { ?>
    <div class="product-showcase">
        <h2 class="title">Top Rated</h2>
        <div class="showcase-wrapper has-scrollbar">
            <div class="showcase-container">
                <?php while ($row = $topRatedProductsResult->fetch_assoc()) { ?>
                    <div class="showcase">
                        <a href="#" class="showcase-img-box">
                            <img src="./assets/images/Product/<?php echo $row[
                                "image"
                            ]; ?>" alt="<?php echo $row[
    "name"
]; ?>" width="70" class="showcase-img">
                        </a>
                        <div class="showcase-content">
                            <a href="#">
                                <h4 class="showcase-title"><?php echo $row[
                                    "name"
                                ]; ?></h4>
                            </a>
                            <a href="#" class="showcase-category"><?php echo $row[
                                "category_name"
                            ]; ?></a>
                            <div class="price-box">
                                <p class="price">₹<?php echo number_format(
                                    $row["discounted_price"],
                                    2
                                ); ?></p>
                                <del>₹<?php echo number_format(
                                    $row["actual_price"],
                                    2
                                ); ?></del>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </div>
    <?php } else {echo "No top-rated products found.";}
?>


          

          </div>
          

            <!--
               - PRODUCT GRID
               -->
            <div class="product-main">
               <h2 class="title" align="middle" font-size="50">New Product'S</h2>
               <div class="product-grid">
               <?php
               // Replace with your database connection details
               $sql = "SELECT p.*, c.category_name, s.subcategory_name
        FROM product p
        LEFT JOIN category c ON p.category_id = c.id
        LEFT JOIN sub_category s ON p.sub_category_id = s.id
        ORDER BY p.id DESC";

               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                   while ($row = $result->fetch_assoc()) { ?>
        <div class="showcase">
            <div class="showcase-banner">
                <a href="./assets/php/product-page.php?id=<?php echo $row[
                    "id"
                ]; ?>">
                    <img src="./assets/images/product/<?php echo $row[
                        "image"
                    ]; ?>"
                         alt="<?php echo $row["name"]; ?>"
                         class="product-img-default"
                         style="max-width: 100% !important; max-height: 100% !important; width: auto !important; height: auto !important;">
                </a>
            </div>
            <div class="showcase-content">
                <span class="product-catagory1110"><?php echo $row[
                    "subcategory_name"
                ]; ?></span>
                <h3 class="showcase-title"><?php echo $row["name"]; ?></h3>
                <div class="showcase-rating">
                    <?php
                    // Assuming 'rating' is a column in your 'product' table
                    $rating = $row["rating"];
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                            echo '<ion-icon name="star"></ion-icon>';
                        } else {
                            echo '<ion-icon name="star-outline"></ion-icon>';
                        }
                    }
                    ?>
                </div>
                <div class="price-box">
                    <p class="price">₹<?php echo number_format(
                        $row["actual_price"],
                        2
                    ); ?></p>
                    <?php if ($row["discounted_price"] !== null) { ?>
                        <del>₹<?php echo number_format(
                            $row["discounted_price"],
                            2
                        ); ?></del>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php }
               } else {
                   echo "0 results";
               }
               ?>


               </div>
            </div>
			</div>
			</div>
			</div>


        </div>

      </div>

    </div>





    <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

    <div>

      <div class="container">

        <div class="testimonials-box">

          <!--
            - TESTIMONIALS
          -->

          <div class="testimonial">

            <h2 class="title">testimonial</h2>

            <div class="testimonial-card">

              <img src="./assets/images/testimonial-1.jpg" alt="alan doe" class="testimonial-banner" width="80" height="80">

              <p class="testimonial-name">Mohit Bhatt</p>

              <p class="testimonial-title">Student</p>

              <img src="./assets/images/icons/quotes.svg" alt="quotation" class="quotation-img" width="26">

              <p class="testimonial-desc">
                Lorem ipsum dolor sit amet consectetur Lorem ipsum
                dolor dolor sit amet.
              </p>

            </div>

          </div>

          



          <!--
            - CTA
          -->

          <div class="cta-container">

            <img src="./assets/images/cta-banner.jpg" alt="summer collection" class="cta-banner">

            <a href="#" class="cta-content">

              <p class="discount">Free Shipping</p>

              <h2 class="cta-title">On Orders</h2>

              <p class="cta-text">Above ₹1500.00</p>

              <button class="cta-btn">Shop now</button>

            </a>

          </div>



          <!--
            - SERVICE
          -->

          <div class="service">

            <h2 class="title">Our Services</h2>

            <div class="service-container">

              <a href="#" class="service-item">

                <div class="service-icon">
                  <ion-icon name="boat-outline"></ion-icon>
                </div>

                <div class="service-content">

                  <h3 class="service-title">Worldwide Delivery</h3>
                  <p class="service-desc">For Order Over ₹2500</p>

                </div>

              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="rocket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">2 Days delivery</h3>
                  <p class="service-desc">for Order above ₹1500</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="call-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Best Online Support</h3>
                  <p class="service-desc">Hours: 8AM - 11PM</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="arrow-undo-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Return Policy</h3>
                  <p class="service-desc">Easy & Free Return</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="ticket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">30% money back</h3>
                  <p class="service-desc">For Order Over ₹1500</p>
              
                </div>
              
              </a>

            </div>

          </div>

        </div>

      </div>

    </div>




  </main>





  <!--
    - FOOTER
  -->

 <?php include_once "footer.php"; ?>






  <!--
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
</body>

</html>