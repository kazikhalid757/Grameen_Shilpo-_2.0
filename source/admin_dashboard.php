<?php
// Include database connection
include '../login-system/db.php';

// Start session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: ../login-system/admin_login.php");
    exit();
}

// Delete Seller Logic (delete by email)
if (isset($_POST['delete_seller'])) {
    $email = $_POST['email'];  // Get email from POST data
    // DELETE query using the email column
    $mysqli->query("DELETE FROM sellerinfo WHERE email = '$email'");
    header("Location: admin_dashboard.php");
    exit();
}

// Delete User Logic (delete by email)
if (isset($_POST['delete_user'])) {
    $email = $_POST['email'];  // Get email from POST data
    // DELETE query using the email column
    $mysqli->query("DELETE FROM users WHERE email = '$email'");
    header("Location: admin_dashboard.php");
    exit();
}
// Delete Store Logic (delete by store_id)
if (isset($_POST['delete_store'])) {
    $store_id = $_POST['store_id'];  // Get store_id from POST data
    // DELETE query using the store_id column
    $mysqli->query("DELETE FROM store WHERE store_id = '$store_id'");
    header("Location: admin_dashboard.php");
    exit();
}

// Fetch data from the database
$sellers = $mysqli->query("SELECT * FROM sellerinfo");
$users = $mysqli->query("SELECT * FROM users");
$stores = $mysqli->query("SELECT * FROM store");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Grameen Shilpo</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }
    header {
        background-color: #007bff;
        color: white;
        padding: 20px;
        font-size: 24px;
        display: flex;
        justify-content: space-between; /* Space out elements */
        align-items: center; /* Vertically center items */
    }

    .header-content {
        text-align: center;
        flex-grow: 1; /* Allow the text to take up available space */
    }

    .logout-link {
        color: white;
        text-decoration: none;
        font-weight: 500;
        margin-left: 20px;
        transition: color 0.3s;
    }

    .logout-link:hover {
        color: #cce7ff;
    }

        header {
            background-color: #7c522c;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        header a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            margin-left: 20px;
            transition: color 0.3s;
        }

        header a:hover {
            color: #7c522c;
        }

        main {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 28px;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background-color: #7c522c;
            color: white;
            font-size: 16px;
        }

        td {
            font-size: 14px;
            color: #555;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c82333;
        }

        .table-container {
            margin-bottom: 30px;
        }

        .actions-column {
            text-align: center;
        }

        .form-inline {
            display: inline;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            font-size: 14px;
            color: #777;
        }

        footer a {
            color: #007bff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            table, th, td {
                font-size: 12px;
            }

            .table-container {
                margin-bottom: 20px;
            }

            header h1 {
                font-size: 22px;
            }
        }

    </style>
</head>
<body>

<header>
    Welcome to Grameen Shilpo Admin Dashboard
    <a href="logout.php" class="logout-link">Logout</a>
</header>

<main>
    <div class="table-container">
        <h2>Manage Sellers</h2>
        <table>
            <tr>
                <th>Email</th>
                <th>Address</th>
                <th>Category</th>
                <th>Postal Code</th>
                <th class="actions-column">Actions</th>
            </tr>
            <?php while ($row = $sellers->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['postal_code']; ?></td>
                    <td class="actions-column">
                        <!-- Delete Seller Button -->
                        <form action="admin_dashboard.php" method="POST" class="form-inline" onsubmit="return confirm('Are you sure you want to delete this seller?');">
                            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                            <button type="submit" name="delete_seller">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <div class="table-container">
        <h2>Manage Users</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th class="actions-column">Actions</th>
            </tr>
            <?php while ($row = $users->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td class="actions-column">
                        <!-- Delete User Button -->
                        <form action="admin_dashboard.php" method="POST" class="form-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                            <button type="submit" name="delete_user">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <h2>Manage Stores</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Store Description</th>
            <th>Banner</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $stores->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['store_name']; ?></td>
                <td><?php echo $row['store_description']; ?></td>
                <td><img src="<?php echo $row['store_banner']; ?>" alt="Store Banner" width="100"></td>
                <td>
                    <!-- Delete Store Button -->
                    <form action="admin_dashboard.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this store?');">
                        <input type="hidden" name="store_id" value="<?php echo $row['store_id']; ?>"> <!-- Send store_id to delete -->
                        <button type="submit" name="delete_store">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
</main>

<footer>
    <p>© 2024 Grameen Shilpo. All rights reserved. | <a href="privacy.php">Privacy Policy</a></p>
</footer>

</body>
</html>
