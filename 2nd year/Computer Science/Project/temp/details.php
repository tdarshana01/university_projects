<!DOCTYPE html>
<html>
<head>
    <title>Your Account</title>
    <link rel="stylesheet" type="text/css" href="./files/sample.css">

<style>
    td{
	font-size:18px;
	padding:5px;
}
</style>

</head>
<body>

<ul class="ul1" >
    <li><a href="index.php">Login</a></li>
    <li><a href="signup.php">Signup</a></li>
    <li><a href="help.php">Help</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>


<?php
session_start();

include("connection.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "<p style='color: red;'>You must log in first.<a href='index.php'>Login</a></p>";
    exit();
}

// Retrieve the customer ID from the session
$customerID = $_SESSION['customerID'];

// SQL query to fetch customer details
$sql = "SELECT * FROM customer_relation WHERE Customer_id = $customerID";
$result = $conn->query($sql);

// Check if the query was successful
if ($result !== false && $result->num_rows > 0) {
    // Display customer details in a list
    echo "<h2><u>Your Account Details</u></h2>";
    echo "<table>";

    while ($row = $result->fetch_assoc()){
        echo "<tr><td><b>Customer ID</b>:".$row['Customer_id']."</td></tr>";
        echo "<tr><td><b>First Name</b>:".$row['First_name']."</td></tr>";
        echo "<tr><td><b>Last Name</b>:".$row['Last_name']."</td></tr>";
        echo "<tr><td><b>Username</b>:".$row['Username']."</td></tr>";
        echo "<tr><td><b>Address</b>:".$row['Address']."</td></tr>";
        echo "<tr><td><b>Gender</b>:".$row['Gender']."</td></tr>";
        echo "<tr><td><b>Phone Number</b>:".$row['Phone_no']."</td></tr>";
        echo "<tr><td><b>NIC</b>:".$row['NIC']."</td></tr>";
        echo "<tr><td><b>Email</b>:".$row['Email']."</td></tr>";
        echo "<tr><td><b>Date of Birth</b>:".$row['Date_of_birth']."</td></tr>";
        echo "<tr><td><b>Hobby</b>:".$row['Hobby']."</td></tr>";
        echo "<tr><td><b>Preferred Language</b>:".$row['Preferred_language']."</td></tr>";
        echo "<tr><td><b>Job Title</b>:".$row['Job_title']."</td></tr>";
        echo "<tr><td><b>Preferred Payment Method</b>:".$row['Preferred_payment_method']."</td></tr>";
        echo "<tr><td><b>Customer Type</b>:".$row['Customer_type']."</td></tr>";
        echo "<tr><td></td></tr>";
        echo "<tr><td><p>Back to Home:<a href='crm.php'>Home</a></p></td></tr>";

    }
    
} else {
    if ($result === false) {
        echo "<p>Error fetching data: " . $conn->error . "</p>";
    } else {
        echo "<p>No data found for your account.</p>";
    }
}

?>

</body>
</html>
