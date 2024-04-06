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
      <img src="../images/logo/logo.png" alt="Anon's logo" width="120">
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
                require_once "connection.php";
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
                    $occupationResult = mysqli_prepare($conn, $occupationQuery);
                    mysqli_stmt_bind_param($occupationResult, "i", $categoryID);
                    mysqli_stmt_execute($occupationResult);
                    $occupationResult = mysqli_stmt_get_result(
                        $occupationResult
                    );

                    while (
                        $occupationRow = mysqli_fetch_assoc($occupationResult)
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
      </li>

      <li class="menu-category">
        <a href="#" class="menu-title">Return & Refunds</a>
      </li>
      
      <li class="menu-category">
        <a href="#" class="menu-title">Contact Us</a>
      </li>
    </ul>
    
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

  <button class="action-btn" data-mobile-menu-open-btn>
    <ion-icon name="grid-outline"></ion-icon>
  </button>

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

    <?php
    require_once "./assets/php/connection.php";

    // Fetch categories from the database
    $categoryQuery = "SELECT * FROM category";
    $categoryResult = mysqli_query($conn, $categoryQuery);

    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
        echo '<li class="menu-category">';
        echo '<button class="accordion-menu" data-accordion-btn>';
        echo '<p class="menu-title">' . $categoryRow["category_name"] . "</p>";
        echo "<div>";
        echo '<ion-icon name="add-outline" class="add-icon"></ion-icon>';
        echo '<ion-icon name="remove-outline" class="remove-icon"></ion-icon>';
        echo "</div>";
        echo "</button>";

        // Fetch occupations for the current category
        $categoryID = $categoryRow["id"];
        $occupationQuery = "SELECT * FROM sub_category WHERE category_id = ?";
        $occupationResult = mysqli_prepare($conn, $occupationQuery);
        mysqli_stmt_bind_param($occupationResult, "i", $categoryID);
        mysqli_stmt_execute($occupationResult);
        $occupationResult = mysqli_stmt_get_result($occupationResult);

        echo '<ul class="submenu-category-list" data-accordion>';
        while ($occupationRow = mysqli_fetch_assoc($occupationResult)) {
            echo '<li class="submenu-category">';
            $categoryName = urlencode($categoryRow["category_name"]);
            $occupationName = urlencode($occupationRow["subcategory_name"]);
            echo '<a class="submenu-title" href="./assets/php/fetch.php?category=' .
                $categoryName .
                "&subcategory=" .
                $occupationName .
                '">' .
                $occupationRow["subcategory_name"] .
                "</a>";
            echo "</li>";
        }
        echo "</ul>";

        echo "</li>";
    }
    ?>

    

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

</header>
