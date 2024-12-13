<?php
/* Displays user information and some useful messages */
if(!isset($_SESSION)) session_start();
require ('../login-system/db.php');

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] == 0 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");    
} else {
    // Makes it easier to read
    $user_name = $_SESSION['UserName'];
    $email = $_SESSION['email']; 
    $active = $_SESSION['active'];
    $account_type = $_SESSION['account_type'];

    $result = $mysqli->query("SELECT * FROM sellerinfo WHERE email='$email'");
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?= $user_name ?></title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .profile-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 5px solid #f8f9fa;
        }

        .profile-name {
            font-size: 32px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .profile-email {
            font-size: 18px;
            color: #7f8c8d;
            margin-bottom: 25px;
        }

        .action-buttons {
            margin: 20px 0;
        }

        .action-buttons .btn {
            margin: 5px;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 500;
        }

        .alert-message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .store-button {
            text-align: right;
            margin: 30px 0;
        }
    </style>
</head>

<body>
    <?php include "header.php" ?>
    <?php include "sidebar.php" ?>

    <div class="profile-container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert-message">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']); 
                ?>
            </div>
        <?php endif; ?>

        <?php if (!$active): ?>
            <div class="alert-message">
                Account is unverified, please confirm your email by clicking on the email link!
            </div>
        <?php endif; ?>

        <div class="profile-header">
            <?php if ($account_type == 'Personal'): ?>
                <img class="profile-image" src="../images/car.jpg" alt="Profile Picture">
            <?php endif; ?>

            <?php if ($account_type == 'Business'): ?>
                <img class="profile-image" src="../seller/sellerPic/<?php echo $user['seller_photo']; ?>" alt="Seller Photo">
            <?php endif; ?>

            <h1 class="profile-name"><?php echo $user_name; ?></h1>
            <p class="profile-email"><?php echo $email; ?></p>

            <div class="action-buttons">
                <?php if ($account_type == 'Business'): ?>
                    <a href="cp_seller.php" class="btn btn-primary">Update Profile</a>
                <?php endif; ?>

                <?php if ($account_type == 'Personal'): ?>
                    <a href="cp_buyer.php" class="btn btn-primary">Update Profile</a>
                <?php endif; ?>

                <a href="../login-system/delete.php" class="btn btn-danger" onclick="return confirm_delete()">Delete Account</a>
            </div>
        </div>

        <?php if ($account_type == 'Business'): ?>
            <div class="store-button">
                <a href="new_store_description.php">
                    <button class="btn btn-primary" <?php if ($active == '0') echo 'disabled'; ?>>
                        Go to store
                    </button>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <?php include "footer.php" ?>
    </footer>

    <script>
        function confirm_delete() {
            return confirm("Are you sure you want to permanently delete this account?");
        }
    </script>

</body>
</html>
