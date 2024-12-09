<?php
require "../login-system/db.php";
require "../seller/storeProductList.php";
if (!isset($_SESSION)) session_start();

$email = $_SESSION['email'] ?? null;
$result = $mysqli->query("SELECT * FROM store WHERE email='$email'");
$user = $result ? $result->fetch_assoc() : null;

$store_name = $user['store_name'] ?? '';
$edit_state = false;
$productFor = $productPic = $productName = $description = $price = $quantity = '';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
  $store_name = $user['store_name'] ?? '';
} else {
  header("location:index.php");
}

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $singleRec = mysqli_query($mysqli, "SELECT * FROM productlist WHERE id=$id");
  if ($singleRec) {
    $records = mysqli_fetch_array($singleRec);
    $productFor = $records['productFor'] ?? '';
    $productPic = $records['productPic'] ?? '';
    $productName = $records['productName'] ?? '';
    $description = $records['description'] ?? '';
    $price = $records['price'] ?? '';
    $quantity = $records['quantity'] ?? '';
    $edit_state = true;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/cp_seller.js"></script>
  <script type="text/javascript" src="../js/add_product.js"></script>
  <style>
    body {
      background-color: #f9f9f9;
      font-family: Arial, sans-serif;
    }
    .form-container {
      background: #fff;
      margin: 20px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      max-width: 800px;
    }
    .form-title {
      color: #F8A036;
      font-size: 24px;
      text-align: center;
      margin-bottom: 20px;
    }
    .form-group label {
      font-weight: bold;
      margin-bottom: 5px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-control {
      border-radius: 5px;
      padding: 10px;
      width: 100%;
    }
    .btn-primary {
      background-color: #F8A036;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      color: #fff;
      cursor: pointer;
      font-weight: bold;
    }
    .btn-primary:hover {
      background-color: #d37d2b;
    }
    .product-image {
      display: block;
      margin: 0 auto 20px;
      width: 200px;
      height: 200px;
      object-fit: cover;
      border: 2px dashed #ccc;
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <?php include "header.php"; ?>
  <?php include "sidebar.php"; ?>

  <div class="form-container">
    <h1 class="form-title"><?= $store_name ?> Store</h1>
    <form action="../seller/storeProductList.php" method="post" enctype="multipart/form-data">
      <?php if (isset($_GET['edit'])) { ?>
        <input type="hidden" name="id" value="<?= $id ?>">
      <?php } ?>
      <div class="form-group">
        <img src="<?= $edit_state ? "../seller/productPic/$productPic" : "../img/addp.png"; ?>" class="product-image" alt="Product Image">
        <label>Picture of Product</label>
        <input type="file" name="productPic" class="form-control">
        
      </div>
      <div class="form-group">
        <label>Category</label>
        <select name="productFor" class="form-control" required>
          <option value="<?= $productFor ?>"><?= $productFor ?: "Select a Category" ?></option>
          <option value="Men's Fashion">মৃৎশিল্প</option>
          <option value="Women's Fashion">বাঁশ-বেত</option>
          <option value="Baby's Fashion">বস্তু শিল্প</option>
          <option value="Phone and Tablets">গহনা শিল্প</option>
          <option value="Home and Living">পাটজাত</option>
          <option value="Sports and Travels">শীতলপাটি</option>
          <option value="Others">অন্যান্য</option>
        </select>
      </div>
      





      <div class="form-group">
        <label>Name of the Product</label>
        <input type="text" name="productName" value="<?= $productName ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea name="productDes" rows="4" class="form-control" required><?= $description ?></textarea>
      </div>
      <div class="form-group">
        <label>Price (TK)</label>
        <input type="number" name="price" value="<?= $price ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Quantity</label>
        <input type="number" name="quantity" value="<?= $quantity ?>" class="form-control" required>
      </div>
      <button type="submit" name="<?= $edit_state ? 'update' : 'submit'; ?>" class="btn-primary">
        <?= $edit_state ? 'Update Product' : 'Add Product' ?>
      </button>
    </form>
  </div>

  <?php include "footer.php"; ?>
</body>
</html>
