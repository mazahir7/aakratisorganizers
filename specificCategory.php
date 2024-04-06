<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
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

  <!--
    - MODAL
  -->

   <!-- <div class="modal" data-modal>

    <div class="modal-close-overlay" data-modal-overlay></div>

    <div class="modal-content">

      <button class="modal-close-btn" data-modal-close>
        <ion-icon name="close-outline"></ion-icon>
      </button>

      <div class="newsletter-img">
        <img src="./assets/images/newsletter.png" alt="subscribe newsletter" width="400" height="400">
      </div>

      <div class="newsletter">

        <form action="#">

          <div class="newsletter-header">

            <h3 class="newsletter-title">Subscribe Newsletter.</h3>

            <p class="newsletter-desc">
              Subscribe the <b>Anon</b> to get latest products and discount update.
            </p>

          </div>

          <input type="email" name="email" class="email-field" placeholder="Email Address" required>

          <button type="submit" class="btn-newsletter">Subscribe</button>

        </form>

      </div>

    </div>

  </div> -->





  <!--
    - NOTIFICATION TOAST
  -->

  <!-- <div class="notification-toast" data-toast>

    <button class="toast-close-btn" data-toast-close>
      <ion-icon name="close-outline"></ion-icon>
    </button>

    <div class="toast-banner">
      <img src="./assets/images/products/jewellery-1.jpg" alt="Rose Gold Earrings" width="80" height="70">
    </div>

    <div class="toast-detail">

      <p class="toast-message">
        Someone in new just bought
      </p>

      <p class="toast-title">
        Rose Gold Earrings
      </p>

      <p class="toast-meta">
        <time datetime="PT2M">2 Minutes</time> ago
      </p>

    </div>

  </div> -->





  <!--
    - HEADER
  -->

  <header>

    <div class="header-top">

      <div class="container alert-news-center">

         <ul class="header-social-container">

          <li>
            <a href="https://www.facebook.com/aakraticollections?mibextid=ZbWKwL " class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href=" https://www.instagram.com/aakratisorganizers?igsh=MWM5a3Vvd21tMXFqMQ== " class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

        </ul> 

        <div class="header-alert-news">
          <p>
            <b>Free Shipping</b>
            On Orders Over - ₹1500
          </p>
        </div>

        <!-- <div class="header-top-actions">

          <select name="currency">

            <option value="usd">USD &dollar;</option>
            <option value="eur">EUR &euro;</option>

          </select>

          <select name="language">

            <option value="en-US">English</option>
            <option value="es-ES">Espa&ntilde;ol</option>
            <option value="fr">Fran&ccedil;ais</option>

          </select>

        </div> -->

      </div>

    </div>

    <div class="header-main">

      <div class="container">

        <a href="#" class="header-logo">
          <img src="./assets/images/logo/logo.png" alt="Anon's logo" width="120">
        </a>
        <div class="header-search-container">
                  <form action="./assets/php/search.php" method="GET">
                     <input type="search" name="search" class="search-field" placeholder="Search For Organizer">
                     <button class="search-btn" type="submit">
                        <ion-icon name="search-outline"></ion-icon>
                     </button>
                  </form>
               </div>

        <div class="header-user-actions">

          <!-- <button class="action-btn">
            <ion-icon name="person-outline"></ion-icon>
          </button>

          <button class="action-btn">
            <ion-icon name="heart-outline"></ion-icon>
            <span class="count">0</span>
          </button> -->

          <button class="action-btn">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count">0</span>
          </button>

        </div>

      </div>

    </div>

    <nav class="desktop-navigation-menu">

      <div class="container">

        <ul class="desktop-menu-category-list">

          <li class="menu-category">
            <a href="#" class="menu-title">Home</a>
          </li>

          <li class="menu-category">
                <a href="#" class="menu-title">Categories</a>
                <ul class="dropdown-panel">
                    <?php
                    require_once "./assets/php/connection.php";
                    // Fetch categories from the database
                    $categoryQuery = "SELECT * FROM category";
                    $categoryResult = mysqli_query($conn, $categoryQuery);

                    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                        echo '<ul class="dropdown-panel-list">';
                        echo '<li class="menu-title"><a href="#">' .
                            $categoryRow["category_name"] .
                            "</a></li>";

                        // Fetch occupations for the current category
                        $categoryID = $categoryRow["id"];
                        $occupationQuery =
                            "SELECT * FROM sub_category WHERE category_id = ?";
                        $occupationResult = mysqli_prepare(
                            $conn,
                            $occupationQuery
                        );
                        mysqli_stmt_bind_param(
                            $occupationResult,
                            "i",
                            $categoryID
                        );
                        mysqli_stmt_execute($occupationResult);
                        $occupationResult = mysqli_stmt_get_result(
                            $occupationResult
                        );

                        while (
                            $occupationRow = mysqli_fetch_assoc(
                                $occupationResult
                            )
                        ) {
                            echo '<li class="panel-list-item">';
                            $categoryName = urlencode(
                                $categoryRow["category_name"]
                            );
                            $occupationName = urlencode(
                                $occupationRow["subcategory_name"]
                            );
                            echo '<a href="./assets/php/fetch.php?category=' .
                                $categoryName .
                                "&subcategory=" .
                                $occupationName .
                                '">' .
                                $occupationRow["subcategory_name"] .
                                "</a>";
                            echo "</li>";
                        }

                        echo "</ul>";
                    }
                    ?>
                </ul>
            </li>

          <li class="menu-category">
            <a href="#" class="menu-title">About Us</a>

            <!-- <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Shirt</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Shorts & Jeans</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Safety Shoes</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Wallet</a>
              </li>

            </ul> -->
          </li>

          <li class="menu-category">
            <a href="#" class="menu-title">Return & Refunds</a>

            <!-- <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Dress & Frock</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Earrings</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Necklace</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Makeup Kit</a>
              </li>

            </ul> -->
          </li>

           <li class="menu-category">
            <a href="#" class="menu-title">Contact Us</a>

            <!-- <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Earrings</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Couple Rings</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Necklace</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Bracelets</a>
              </li>

            </ul>
          </li>

          <li class="menu-category">
            <a href="#" class="menu-title">Perfume</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Clothes Perfume</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Deodorant</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Flower Fragrance</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Air Freshener</a>
              </li>

            </ul>
          </li>

          <li class="menu-category">
            <a href="#" class="menu-title">Blog</a>
          </li>

          <li class="menu-category">
            <a href="#" class="menu-title">Hot Offers</a>
          </li>

        </ul>

      </div> --> 

    </nav>

    <div class="mobile-bottom-navigation">

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>

      <button class="action-btn">
        <ion-icon name="bag-handle-outline"></ion-icon>

        <span class="count">0</span>
      </button>

      <button class="action-btn">
        <ion-icon name="home-outline"></ion-icon>
      </button>

      <!-- <button class="action-btn">
        <ion-icon name="heart-outline"></ion-icon>

        <span class="count">0</span>
      </button> -->

      <!-- <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button> -->

    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

      <div class="menu-top">
        <h2 class="menu-title">Menu</h2>

        <button class="menu-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <ul class="mobile-menu-category-list">

        <li class="menu-category">
          <a href="#" class="menu-title">Home</a>
        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Wardrobe Organizers</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 1</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 2 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 3 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 4</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 5</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 6</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Accessories Organizers</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 1</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 2 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 3 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 4</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 5</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 6</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Travel Organizers</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 1</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 2 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 3 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 4</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 5</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 6</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Drawer Organizers</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 1</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 2 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 3 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 4</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 5</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 6</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Storage Boxes</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 1</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 2 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 3 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 4</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 5</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 6</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Bathroom Organizers</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 1</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 2 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 3 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 4</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 5</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 6</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Men's Accessories Organizers</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 1</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 2 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 3 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 4</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 5</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 6</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Ethnic Treasures</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 1</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 2 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 3 </a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 4</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 5</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Sub-Category 6</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">About Us</a>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Return & Refunds</a>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Contact Us</a>
        </li>

      </ul>

      <div class="menu-bottom">

        <!-- <ul class="menu-category-list">

          <li class="menu-category">

            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Language</p>

              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>

              <li class="submenu-category">
                <a href="#" class="submenu-title">English</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Espa&ntilde;ol</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Fren&ccedil;h</a>
              </li>

            </ul>

          </li>

          <li class="menu-category">
            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Currency</p>
              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>
              <li class="submenu-category">
                <a href="#" class="submenu-title">USD &dollar;</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">EUR &euro;</a>
              </li>
            </ul>
          </li>

        </ul> -->

        <ul class="menu-social-container">

          <li>
            <a href="https://www.facebook.com/aakraticollections?mibextid=ZbWKwL " class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="https://www.instagram.com/aakratisorganizers?igsh=MWM5a3Vvd21tMXFqMQ== " class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

        </ul>

      </div>

    </nav>

    <style>

        .product-padding{
            padding: 5rem;
        }
    </style>

  </header>





  <!--
    - MAIN
  -->

    
    <main>
         <!-- PRODUCT GRID -->
        <div class="product-main product-padding">
            <h2 class="title" align="middle" font-size="50">New Product'S</h2>
            <div class="product-grid">
                <?php
                // Replace with your database connection details
                $category = $_GET['category'];

                $sql = "SELECT p.*, c.category_name
                        FROM product p
                        INNER JOIN category c ON p.category_id = c.id
                        WHERE c.category_name = '$category'";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <div class="showcase">

                                <div class="showcase-banner">
                                    <a 
                                        style="max-width: 100% !important; max-height: 150% !important; width: 100% !important; height: 150% !important; object-fit: cover; aspect-ratio: 16/9;"
                                        href="./assets/php/product-page.php?id=<?php echo $row["id"]; ?>">
                                        <img src="./assets/images/product/<?php echo $row["image"]; ?>"
                                        alt="<?php echo $row["name"]; ?>"
                                        class="product-img-default"
                                        style="max-width: 100% !important; max-height: 150% !important; width: 100% !important; height: 150% !important; object-fit: cover; aspect-ratio: 16/9;">
                                    </a>
                                </div>

                                <div class="showcase-content">
                                    <span class="product-catagory1110"><?php echo $row["category_name"]; ?></span>
                                    <h3 class="showcase-title"><?php echo $row["name"]; ?></h3>
                                
                                    <div class="showcase-rating">
                                        <?php
                                            // Assuming 'rating' is a column in your 'product' table
                                            $rating = $row["rating"];
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<ion-icon name="star"></ion-icon>';
                                                }
                                                else {
                                                    echo '<ion-icon name="star-outline"></ion-icon>';
                                                }
                                            }
                                        ?>
                                    </div>

                                    <div class="price-box">
                                        <p class="price">₹<?php echo number_format($row["actual_price"],2); ?></p>
                                        <?php
                                            if ($row["discounted_price"] !== null) 
                                            { 
                                                ?><del>₹<?php echo number_format($row["discounted_price"], 2); ?></del> <?php
                                            } 
                                        ?>
                                    </div>

                                </div>
                            </div><?php
                        }
                    }
                    else {
                    echo "0 results";
                    }
                ?>


            </div>
        </div>
    </main>




  <!--
    - FOOTER
  -->

  <footer>

    <div class="footer-nav">

      <div class="container">

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Popular Categories</h2>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">category</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">category</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">category</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">category</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">category</a>
          </li>

        </ul>

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Products</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Products</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Products</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Products</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Products</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Products</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Our Company</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Delivery</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Legal Notice</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Terms and conditions</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">About us</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Secure payment</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Services</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Prices drop</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">New products</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Best sales</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Contact us</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Sitemap</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Contact</h2>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="location-outline"></ion-icon>
            </div>

            <address class="content">
              61, Anand nagar University Road Ayad, Udaipur, Rajasthan, India
            </address>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="call-outline"></ion-icon>
            </div>

            <a href="tel:+607936-8058" class="footer-nav-link">+91 6375 618 863</a>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="mail-outline"></ion-icon>
            </div>

            <a href="mailto:aakratisorganizers@gmail.com " class="footer-nav-link">aakratisorganizers@gmail.com</a>
          </li>

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Follow Us</h2>
          </li>

          <li>
            <ul class="social-link">

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-linkedin"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>

            </ul>
          </li>

        </ul>

      </div>

    </div>

    <div class="footer-bottom">

      <div class="container">

        <img src="./assets/images/payment.png" alt="payment method" class="payment-img">

        <p class="copyright">
          Copyright &copy; <a href="#">Aakrati's Organizers</a> all rights reserved.
        </p>

      </div>

    </div>

  </footer>






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