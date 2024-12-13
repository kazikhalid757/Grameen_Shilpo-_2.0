<?php

if(!isset($_SESSION)) session_start();

require "../login-system/db.php";

$male = "Men\'s Fashion";
$female = "Women\'s Fashion";
$baby = "Baby\'s Fashion";
$phone = "Phone and Tablets";
$sport = "Sports and Travels";

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	.li{
		margin-left: 75px;
	}

	.a{
		color: black;
	}
	.a:hover{
		opacity: 0.5;
	}
</style>

</head>
<body>
	<nav>
		    <ul class="nav navbar-nav" style="border-bottom: 2px solid gray;width: 100%">
				 <li class="li" ><a class="a" href="subIndex.php?pCat=<?= $male; ?>" > মৃৎশিল্প </a></li>
				 <li class="li"><a class="a" href="subIndex.php?pCat=<?= $female; ?>"> বাঁশ-বেত </a></li>
				 <li class="li"><a class="a" href="subIndex.php?pCat=<?= $baby; ?>"> বস্তু শিল্প </a></li>
				 <li class="li"><a class="a" href="subIndex.php?pCat=<?= $phone; ?>"> গহনা শিল্প</a></li>
				 <li class="li"><a class="a" href="subIndex.php?pCat=<?= $sport; ?>"> পাটজাত</a></li>
				 <li class="li"><a class="a" href="subIndex.php?pCat=<?= $sport; ?>"> শীতলপাটি</a></li>
				 <li class="li"><a class="a" href="allC.php">সকল ক্যাটাগরি</a></li>
		   </ul>
	
	</nav>

</body>
</html>