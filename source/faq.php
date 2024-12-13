<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>FAQ</title>
	<script>
	function showOverlay(id) {
	    document.getElementById(id).style.display = "block";
	}
	function hideOverlay(id) {
	    document.getElementById(id).style.display = "none";
	}
	</script>
</head>
<body class="faq">
	<?php include "header.php" ?>
	<?php include "sidebar.php" ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1><b>হ্যালো, আমরা আপনাকে কিভাবে সাহায্য করতে পারি?</b></h1>
			</div>
		</div>
	</div>
	<!-- OVERLAY TEXT START -->
	<!-- <div id="o1" class="overlay" onclick="hideOverlay('o1')">
	  <div id="text">ওভারলে টেক্সট ১ ওভারলে টেক্সট ১ ওভারলে টেক্সট ১ </div>  
	</div>
	<div id="o2" class="overlay" onclick="hideOverlay('o2')">
	  <div id="text">ওভারলে টেক্সট ২ ওভারলে টেক্সট ২ ওভারলে টেক্সট ২ </div>  
	</div>
	<div id="o3" class="overlay" onclick="hideOverlay('o3')">
	  <div id="text">ওভারলে টেক্সট ৩ ওভারলে টেক্সট ৩ ওভারলে টেক্সট ৩ </div>  
	</div>
	<div id="o4" class="overlay" onclick="hideOverlay('o4')">
	  <div id="text">ওভারলে টেক্সট ৪ ওভারলে টেক্সট ৪ ওভারলে টেক্সট ৪ </div>  
	</div>
	<div id="o5" class="overlay" onclick="hideOverlay('o5')">
	  <div id="text">ওভারলে টেক্সট ৫ ওভারলে টেক্সট ৫ ওভারলে টেক্সট ৫ </div>  
	</div> -->
	<!-- OVERLAY TEXT END -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="faq-section">
					<h2>আপনার সাহায্য দেখুন</h2>
					<div class="faq-list">
						<div class="faq-item" onclick="showOverlay('o1')">
							<h3>১. আমার জিনিসটা কোথায়? </h3>
						</div>
						<div class="faq-item" onclick="showOverlay('o2')">
							<h3>২. আপনার অর্ডার কীভাবে পরিচালনা করবেন? </h3>
						</div>
						<div class="faq-item" onclick="showOverlay('o3')">
							<h3>৩. অ্যাকাউন্ট সেটিংস এবং পেমেন্ট মেথড কীভাবে সেট করবেন? </h3>
						</div>
						<div class="faq-item" onclick="showOverlay('o4')">
							<h3>৪. প্রত্যাবর্তন এবং ফেরত কীভাবে করবেন? </h3>
						</div>
						<div class="faq-item" onclick="showOverlay('o5')">
							<h3>৫. শিপিং নীতিমালা কীভাবে পরিচালনা করবেন? </h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<p>আরো কোনো প্রশ্ন? <a href="contact.php">এখানে ক্লিক করুন।</a></p>
			</div>
		</div>
	</div>
	<?php include "address.php" ?>
	<?php include "footer.php" ?>
</body>
</html>