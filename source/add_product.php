<?php
require "../login-system/db.php";
require "../seller/storeProductList.php";
if (!isset($_SESSION)) session_start();

$email = $_SESSION['email'];
$result = $mysqli->query("SELECT * FROM store WHERE email='$email'");
$user = $result->fetch_assoc();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
    $store_name = $user['store_name'];
} else {
    header("location:index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $singleRec = mysqli_query($mysqli, "SELECT * FROM productlist WHERE id=$id");
    $records = mysqli_fetch_array($singleRec);

    $productFor = $records['productFor'];
    $productPic = $records['productPic'];
    $productName = $records['productName'];
    $description = $records['description'];
    $price = $records['price'];
    $quantity = $records['quantity'];
    $edit_state = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .form-label {
            font-weight: bold;
            color: #444;
        }
        .btn-custom {
            background-color: #182938;
            color: white;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #f8a036;
            color: white;
        }
        .product-img {
            height: 220px;
            width: 220px;
            object-fit: cover;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>

    <div class="container">
        <div class="text-center mb-4">
            <h1><strong style="color: #f8a036;"><?php echo $store_name; ?></strong> Store</h1>
            <h4 class="text-muted">Add or Edit Your Product</h4>
        </div>

        <form action="../seller/storeProductList.php" method="post" enctype="multipart/form-data">
            <?php if (isset($_GET['edit'])) { ?>
                <input type="hidden" name="id" value="<?= $id ?>">
            <?php } ?>

            <div class="mb-4 text-center">
                <label for="productPic" class="form-label">Picture of Product</label>
                <div class="d-flex justify-content-center">
                    <label class="btn btn-secondary btn-file">
                        Choose Image
                        <input type="file" name="productPic" style="display: none;" accept="image/*" id="product_select">
                    </label>
                </div>
                <?php if ($edit_state == false): ?>
                    <img id="product_image" src="../img/addp.jpg" class="mt-3 product-img">
                <?php else: ?>
                    <input type="hidden" name="productPic" value="<?= $productPic; ?>">
                    <img src="../seller/productPic/<?= $records['productPic']; ?>" class="mt-3 product-img">
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="productFor" class="form-label">Select a Category</label>
                <select name="productFor" class="form-select" required>
                    <option value="<?= $productFor; ?>"><?= $productFor ? $productFor : 'Select a Category'; ?></option>
                    <option value="Men's Fashion">Men's Fashion</option>
                    <option value="Women's Fashion">Women's Fashion</option>
                    <option value="Baby's Fashion">Baby's Fashion</option>
                    <option value="Phone and Tablets">Phone & Tablets</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Home and Living">Home & Living</option>
                    <option value="Sports and Travels">Sports & Travels</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" name="productName" class="form-control" value="<?= $productName; ?>" required>
            </div>

            <div class="mb-3">
                <label for="productDes" class="form-label">Description</label>
                <textarea name="productDes" class="form-control" rows="4" required><?= $description; ?></textarea>
            </div>

            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="price" class="form-label">Price (TK)</label>
                    <input type="number" name="price" class="form-control" value="<?= $price; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="<?= $quantity; ?>" required>
                </div>
            </div>

            <div class="text-center">
                <?php if ($edit_state == false): ?>
                    <button type="submit" name="submit" class="btn btn-custom">Add Product</button>
                <?php else: ?>
                    <button type="submit" name="update" class="btn btn-custom">Update Product</button>
                <?php endif; ?>
            </div>
        </form>
    </div>

     <?php include "address.php"; ?>
     <?php include "footer.php"; ?>
</body>
</html>
