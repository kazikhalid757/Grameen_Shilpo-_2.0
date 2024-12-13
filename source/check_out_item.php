<?php
if(!isset($_SESSION)) session_start();

$_SESSION['ref'] = "";

if($_SESSION['ref'] == '1'){
    header("Refresh:0; url=check_out_item.php");
    $_SESSION['ref'] = 0;
}
require "../login-system/db.php";

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1){
    $email = $_SESSION['email'];
}

if(isset($_GET['del'])){
    $cId = $_GET['del'];
    header("Refresh:0; url=check_out_item.php");
    $delQuery = "DELETE FROM `cart` WHERE `cart`.`cartId` = '$cId'";
    mysqli_query($mysqli, $delQuery);
}

if(isset($_POST['submit'])){
    $cartId = $_POST['cartId'];
    $updateQuantity = $_POST['quantity'];

    $upQuery = "UPDATE cart SET customerQty='$updateQuantity' WHERE cartId='$cartId'";
    mysqli_query($mysqli, $upQuery);
}

$sId = session_id();
$result = $mysqli->query("SELECT * FROM cart WHERE sId='$sId'");
$empty = "";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check Out | Item</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="padding-top: 20px;">
    <?php include "header.php" ?>
    <?php include "header2.php" ?>
    <?php include "sidebar.php" ?>
    
    <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="check_out_item" style="padding: 20px;">
            <h3 class="text-center" style="margin-bottom: 30px;">Items in your cart</h3>
            
            <div class="table-responsive" style="margin-bottom: 25px;">
                <table class="table table-hover">
                    <thead>
                        <tr style="background-color: #f8f9fa;">
                            <th style="padding: 15px;">SL</th>
                            <th style="padding: 15px;">Item</th>
                            <th style="padding: 15px;">Quantity</th>
                            <th style="padding: 15px;">Unit Price</th>
                            <th style="padding: 15px;">Total</th>
                            <th style="padding: 15px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $sum = 0;
                        while ($cartInfo = mysqli_fetch_array($result)){
                            $i++;
                            $empty = $cartInfo['sId'];
                        ?>
                        <tr>
                            <td style="vertical-align: middle; padding: 15px;"><?= $i; ?></td>
                            <td style="vertical-align: middle; padding: 15px;">
                                <div style="display: flex; align-items: center;">
                                    <?php echo "<img src='../seller/productPic/".$cartInfo['proPic']."' class='img-thumbnail' style='width:100px; margin-right: 15px;'>"; ?>
                                    <div>
                                        <h5 style="margin-bottom: 5px;"><?= $cartInfo['proName']; ?></h5>
                                        <p style="margin: 0;">Size: <?= $cartInfo['size']; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; padding: 15px;">
                                <form action="" method="post" style="display: flex; align-items: center;">
                                    <input type="hidden" name="cartId" value="<?= $cartInfo['cartId']; ?>">
                                    <input class="form-control" style="width: 80px; margin-right: 10px;" type="number" name="quantity" value="<?= $cartInfo['customerQty']; ?>" min="1">
                                    <button type="submit" name="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </td>
                            <td style="vertical-align: middle; padding: 15px;">৳ <?= number_format($cartInfo['price']); ?></td>
                            <td style="vertical-align: middle; padding: 15px;">৳ <?= number_format($total = ($cartInfo['price'] * $cartInfo['customerQty'])); ?></td>
                            <td style="vertical-align: middle; padding: 15px;">
                                <button class="btn btn-danger btn-sm" onclick="deleteCartItem(<?= $cartInfo['cartId']; ?>)" style="padding: 8px 12px;">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            </td>
                        </tr>
                        <?php $sum = ($sum + $total); ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php $_SESSION['cart'] = $i; ?>
        </div>

        <div class="row" style="margin-top: 30px;">
            <div class="col-md-6" style="margin-bottom: 20px;">
                <a href="index.php" class="btn btn-secondary" style="padding: 10px 20px;">
                    <i class="fa fa-arrow-left"></i> Continue Shopping
                </a>
            </div>
            <div class="col-md-6">
                <div class="card" style="box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div class="card-body" style="padding: 20px;">
                        <h4 style="margin-bottom: 15px;">Order Summary</h4>
                        <hr style="margin: 15px 0;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span>Item Total:</span>
                            <span>৳ <?= number_format($sum); ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span>Shipping:</span>
                            <span>৳ <?= $shippingCost=100; ?></span>
                        </div>
                        <hr style="margin: 15px 0;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                            <strong>Total:</strong>
                            <strong>৳ <?= number_format($grandTotal = ($sum + $shippingCost)); ?></strong>
                        </div>
                        <a href="payment.php" class="btn btn-success btn-block <?php if($empty==''){ echo 'disabled'; } ?>" style="padding: 12px;">
                            Proceed to Checkout <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 40px;">
        <?php include "address.php" ?>
        <?php include "footer.php" ?>
    </div>

    <script>
    function deleteCartItem(cartId) {
        if(confirm("Are you sure you want to remove this item?")) {
            window.location.href = 'check_out_item.php?del=' + cartId;
        }
    }
    </script>

</body>
</html>