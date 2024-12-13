<?php 
require "../login-system/db.php";
if(!isset($_SESSION)) session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1){
    $email = $_SESSION['email'];
}

date_default_timezone_set("Asia/Dhaka");
$time = date("h:i:sa");
$day = date("d");
$month = date("m"); 
$year = date("y");

$sId = session_id();
$result = $mysqli->query("SELECT * FROM cart WHERE sId='$sId'");

while($cartInfo = mysqli_fetch_array($result)) {
    $productId = $cartInfo['productId'];
    
    $result2 = $mysqli->query("SELECT * FROM productlist WHERE id = '$productId'");
    $productInfo = $result2->fetch_assoc();

    $newQty = $productInfo['quantity'] - $cartInfo['customerQty'];

    $upQuery = "UPDATE productlist SET quantity = '$newQty', Day = '$day', Month = '$month', Year = '$year' WHERE id = '$productId'";
    mysqli_query($mysqli, $upQuery);

    $newQuery = "UPDATE productlist SET sellerQuantity = '$newQty' WHERE id = '$productId'";
    mysqli_query($mysqli, $newQuery);
}

$delQuery = "DELETE FROM cart WHERE sId='$sId'";
mysqli_query($mysqli, $delQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        .success-container {
            background: #fff;
            color: #333;
            padding: 50px;
            max-width: 700px;
            margin: 60px auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            text-align: center;
        }

        .success-icon {
            color: #28a745;
            font-size: 120px;
            margin-bottom: 30px;
        }

        .success-title {
            font-size: 36px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        .success-message {
            font-size: 18px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 35px;
        }

        .home-button {
            display: inline-block;
            padding: 12px 35px;
            font-size: 16px;
            font-weight: 500;
            background: #28a745;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .home-button:hover {
            background: #218838;
            color: #fff;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <?php include "header.php" ?>
    <?php include "sidebar.php" ?>

    <div class="success-container">
        <i class="fa fa-check-circle success-icon"></i>
        <h1 class="success-title">Order Successful!</h1>
        <div class="success-message">
            <p>Your order on Ghuri.com has been successfully placed.</p>
            <p>We will process and ship your order as soon as possible.</p>
            <p>For any queries, please contact our customer support.</p>
            <p>Thank you for shopping with us!</p>
        </div>
        <a href="index.php" class="home-button">
            <i class="fa fa-home"></i> Back to Home
        </a>
    </div>

    <footer>
        <?php include "footer.php" ?>
    </footer>
</body>
</html>