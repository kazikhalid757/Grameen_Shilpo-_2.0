<?php
/* Displays user information and some useful messages */

session_start();

// Check if user is logged in using the session variable
if ($_SESSION['logged_in'] == 0) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
    exit();  // Ensure script stops here after redirect
} else {
    // Check if session variables are set before using them
    $user_name = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';  // Default value if not set
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : 'No email provided';  // Default value if not set
    $active = isset($_SESSION['active']) ? $_SESSION['active'] : false;  // Default value if not set
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= htmlspecialchars($user_name) ?></title>
</head>

<body>
  <div class="form">
      <h1>Welcome</h1>

      <p>
      <?php
      // Display message about account verification link only once
      if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];

          // Don't annoy the user with more messages upon page refresh
          unset($_SESSION['message']);
      }
      ?>
      </p>

      <?php
      // Keep reminding the user this account is not active, until they activate
      if (!$active) {
          echo '<div class="info">Account is unverified, please confirm your email by clicking on the email link!</div>';
      }
      ?>

      <h2><?php echo htmlspecialchars($user_name); ?></h2>
      <p><?php echo htmlspecialchars($email); ?></p>

  </div>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/index.js"></script>

</body>
</html>
