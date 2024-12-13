<?php
require "../login-system/db.php";
if(!isset($_SESSION)) session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1){
    $email = $_SESSION['email'];
}

if(isset($_GET["submit"])){
    $to = $_SESSION['mail'];
    $from = "saimon.ctg@gmail.com"; 
    $subject = "Order Confirmed";
    $delId = $_SESSION['delId'];
    $name = $_SESSION['name'];
    $message = 'Hello '.$name.',
    Thank you for shopping on ghuri.com Your order '.$delId.' has been placed.';
    $headers = "From: ".$from."\r\n"."CC: ".$from;
    mail($to,$subject,$message,$headers);

    header('location: success.php');
}

if(isset($_GET['del'])){
    $sId = $_GET['del'];
    $delQuery = "DELETE FROM `delivery_info` WHERE `delivery_info`.`sId` = '$sId'";
    mysqli_query($mysqli,$delQuery);
    header('location: payment.php');
}

$sId = session_id();
$result = $mysqli->query("SELECT * FROM cart WHERE sId='$sId'");
$delId = $_SESSION['delId'];
$result2 = $mysqli->query("SELECT * FROM delivery_info WHERE id='$delId'");
$deliResult = $result2->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Review</title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        .order-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 25px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .order-table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .order-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        
        .order-table img {
            max-width: 70px;
            border-radius: 6px;
        }
        
        .summary-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
        }
        
        .shipping-details {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 25px;
        }
        
        .btn-confirm {
            background: #28a745;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-confirm:hover {
            background: #218838;
        }
        
        .btn-address {
            background: #F8A036;
            color: #fff;
            padding: 8px 18px;
            border: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .btn-address:hover {
            background: #e89430;
        }
    </style>
</head>

<body>
    <?php include "header.php" ?>
    <?php include "sidebar.php" ?>

    <div class="order-container">
        <h2 class="mb-4">Order Summary</h2>

        <table class="order-table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $sum = 0;
                while ($cartInfo = mysqli_fetch_array($result)){
                    $i++;
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td>
                            <?php echo "<img src='../seller/productPic/".$cartInfo['proPic']."' class='me-3'>";?>
                            <div>
                                <strong><?=$cartInfo['proName'];?></strong>
                                <br>
                                <small>Size: <?=$cartInfo['size'];?></small>
                            </div>
                        </td>
                        <td><?=$cartInfo['customerQty'];?></td>
                        <td>৳ <?=number_format($cartInfo['price']);?></td>
                        <td>৳ <?=number_format($total = ($cartInfo['price'] * $cartInfo['customerQty']));?></td>
                    </tr>
                    <?php $sum = ($sum + $total);?>
                <?php }?>
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-6">
                <div class="shipping-details">
                    <h3 class="mb-3">Shipping Details</h3>
                    <p>
                        <strong>Name:</strong> <?=$deliResult['name'];?><br>
                        <strong>Address:</strong> <?=$deliResult['deliAddress'];?><br>
                        <strong>Phone:</strong> <?=$deliResult['phone'];?>
                    </p>
                    <a href="?del=<?=$sId;?>" class="btn btn-address">Change Address</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="summary-box">
                    <h3 class="mb-3">Payment Summary</h3>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Items Total:</span>
                        <strong>৳ <?=number_format($sum);?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <strong>৳ <?=number_format($shippingCost=100);?></strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h4>Total:</h4>
                        <h4>৳ <?=number_format($grandTotal = ($sum + $shippingCost));?></h4>
                    </div>
                    <div class="text-center mt-3">
                        <a href="?submit" class="btn btn-confirm">Confirm Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <?php include "address.php"?>
        <?php include "footer.php"?>
    </div>

</body>
</html>