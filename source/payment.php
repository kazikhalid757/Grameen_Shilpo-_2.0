<?php if(!isset($_SESSION)) session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/phone_validation.js"></script>

    <style>
        .payment-container {
            max-width: 900px;
            margin: 80px auto;
            padding: 50px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        }

        .payment-header {
            text-align: center;
            margin-bottom: 50px;
            padding: 0 20px;
        }

        .payment-header h1 {
            color: #2c3e50;
            font-size: 36px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .payment-header h3 {
            color: #7f8c8d;
            font-size: 20px;
            line-height: 1.5;
        }

        .msg {
            margin: 35px auto;
            padding: 20px;
            border-radius: 12px;
            color: #155724;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            width: 70%;
            text-align: center;
            font-size: 16px;
        }

        .payment-form {
            padding: 30px;
            background: #f8f9fa;
            border-radius: 15px;
        }

        .card-icons {
            font-size: 45px;
            margin: 25px 0;
        }

        .card-icons i {
            margin: 0 15px;
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        .card-icons i:hover {
            transform: scale(1.1);
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            margin-bottom: 10px;
            font-size: 16px;
            color: #34495e;
        }

        .form-control {
            height: 50px;
            border-radius: 10px;
            border: 2px solid #ddd;
            padding: 10px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #27ae60;
            box-shadow: 0 0 8px rgba(39, 174, 96, 0.2);
        }

        textarea.form-control {
            height: auto;
            min-height: 100px;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
            background: #27ae60;
            border: none;
            border-radius: 12px;
            color: white;
            margin-top: 30px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-submit:hover {
            background: #219a52;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33, 154, 82, 0.3);
        }

        .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        .col-md-6 {
            padding: 0 15px;
        }

        input[type="radio"] {
            margin-right: 8px;
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .payment-container {
                margin: 40px auto;
                padding: 30px;
            }

            .payment-form {
                padding: 20px;
            }

            .card-icons {
                font-size: 35px;
            }
        }
    </style>
</head>

<body>
    <?php include "header.php" ?>
    <?php include "sidebar.php" ?>

    <div class="payment-container">
        <div class="payment-header">
            <h1>Payment Information</h1>
            <h3>Please enter your credit card information below & click submit.</h3>
        </div>

        <?php if(isset($_SESSION['msg'])): ?>
            <div class="msg">
                <?php
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                ?>
                <a href="paymentTwo.php" class="btn btn-info mt-2">Proceed to Payment</a>
            </div>
        <?php endif; ?>

        <div class="payment-form">
            <form method="POST" action="../seller/storeDeliveryInfo.php" onsubmit="return !!(phonenumber(this) && validateCardNumber(this) && cardname(this) && delname(this) && scode(this) && expiry(this))">
                <div class="form-group">
                    <label><strong>Credit Cards Accepted</strong></label>
                    <div class="card-icons text-center">
                        <label><input type="radio" name="card" value="visa"><i class="fa fa-cc-visa"></i></label>
                        <label><input type="radio" name="card" value="master"><i class="fa fa-cc-mastercard"></i></label>
                        <label><input type="radio" name="card" value="amex"><i class="fa fa-cc-amex"></i></label>
                        <label><input type="radio" name="card" value="discover"><i class="fa fa-cc-discover"></i></label>
                    </div>
                </div>

                <div class="form-group">
                    <label><strong>Card Number</strong></label>
                    <input class="form-control" type="number" name="cardNumber" placeholder="Enter card number">
                </div>

                <div class="form-group">
                    <label><strong>Name On Card</strong></label>
                    <input class="form-control" type="text" name="holderName" placeholder="Enter card holder name">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Expiry Date</strong></label>
                            <input type="text" class="form-control" name="expiryDate" placeholder="MM/YYYY">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Security Code</strong></label>
                            <input class="form-control" type="number" name="sCode" placeholder="CVV">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><strong>Full Name</strong></label>
                    <input class="form-control" type="text" name="name" placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label><strong>Email Address</strong></label>
                    <input class="form-control" type="email" name="email" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label><strong>Delivery Address</strong></label>
                    <textarea name="deliAddress" class="form-control" rows="3" placeholder="Enter your delivery address"></textarea>
                </div>

                <div class="form-group">
                    <label><strong>Phone Number</strong></label>
                    <input class="form-control" type="number" name="phone" placeholder="Enter your phone number">
                </div>

                <button type="submit" name="submit" class="btn-submit">Complete Payment</button>
            </form>
        </div>
    </div>

    <footer>
        <?php include "footer.php" ?>
    </footer>
</body>
</html>