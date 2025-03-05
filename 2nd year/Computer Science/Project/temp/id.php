<html>
<head>
	<title>User ID</title>
<link rel="stylesheet" type="text/css" href="./files/sample.css">

</head>
<body>

<ul class="ul1" >
    <li><a href="index.php">Login</a></li>
    <li><a href="signup.php">Signup</a></li>
    <li><a href="help.php">Help</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
<br/><br/><br/><br/>

<?php

session_start();

if (isset($_SESSION['customer_id'])) {
    $customerId = $_SESSION['customer_id'];
    echo "Your Customer ID is: $customerId";
} else {
    echo "Customer ID not found.";
}
?>

<p>Keep this for future use</p>
<p>Return to login:<a href="index.php">Login</a></p>
</body>
</html>