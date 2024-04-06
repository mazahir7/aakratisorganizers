<?php
require_once "./assets/php/connection.php"; ?>
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

<?php include_once "header.php"; ?>


<div class="product-container">
         <div class="container">
         <!--
            - SIDEBAR
            -->
         <div class="product-box">
            <!--
               - PRODUCT GRID
               -->
            <div class="product-main">
               <h2 class="title" align="middle" font-size="50">SEARCHED</h2>
               <div class="product-grid">
                  <?php // Replace with your database connection details


                  $category = $_GET["category"];
                  $subcategory = $_GET["subcategory"];
                  $sql = "SELECT p.*, c.category_name, s.subcategory_name
        FROM product p
        INNER JOIN sub_category s ON p.sub_category_id = s.id
        INNER JOIN category c ON p.category_id = c.id
        WHERE c.category_name = '$category' AND s.subcategory_name = '$subcategory' ";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) { ?>
        <div class="showcase">
            <div class="showcase-banner">
            <a href="product-page.php?id=<?php echo $row["id"]; ?>">
    <img src="./assets/images/products/<?php echo $row["image"]; ?>"
         alt="<?php echo $row["name"]; ?>"
         class="product-img-default"
         style="max-width: 200px !important; max-height: 150px !important; width: auto !important; height: auto !important;">


            </div>
            <div class="showcase-content" align="middle">
			
					<span class="product-catagory1110"><?php echo $row[
         "subcategory_name"
     ]; ?></span>
                    <h3 class="showcase-title"><?php echo $row["name"]; ?></h3>
                    </a>
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
    <?php include_once "footer.php"; ?>

    
      <script src="./assets/js/script.js"></script>

<!--
  - ionicon link
-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>