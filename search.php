
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aakrati's Organizers</title>

  <link rel="shortcut icon" href="../images/logo/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="./assets/css/style-prefix.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

</head>

<div class="overlay" data-overlay></div>

<?php include_once "header.php"; ?>

<div class="product-container">
         <div class="container">
    
         <div class="product-box">
         
            <div class="product-main">
               <h2 class="title" align="middle">SEARCHED Organizers<?php echo $searchTerm ??
                   ""; ?></h2>
               <div class="product-grid">
                  <?php
                  $search = $_GET["search"];
                  // SQL query to search all columns of the 'sahayak' table
                  $sql = "SELECT p.*, c.category_name, s.subcategory_name
        FROM product p
        INNER JOIN sub_category s ON p.sub_category_id = s.id
        INNER JOIN category c ON p.category_id = c.id
        WHERE p.name LIKE '%$search%'
        OR p.product_code LIKE '%$search%'
        OR c.category_name LIKE '%$search%'
        OR s.subcategory_name LIKE '%$search%'";

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

<script src="./assets/js/script3.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
</body>

</html>