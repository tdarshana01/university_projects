<!DOCTYPE html>
<html>
<head>
    <title>Your Account</title>
    <link rel="stylesheet" type="text/css" href="./files/sample.css">

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
    echo "<ul>";

    $row = $result->fetch_assoc();

    echo "<li><strong>Customer ID:</strong> " . $row['Customer_id'] . "</li><br/>";
    echo "<li><strong>First Name:</strong> " . $row['First_name'] . "</li><br/>";
    echo "<li><strong>Last Name:</strong> " . $row['Last_name'] . "</li><br/>";
    echo "<li><strong>Username:</strong> " . $row['Username'] . "</li><br/>";
    echo "<li><strong>Address:</strong> " . $row['Address'] . "</li><br/>";
    echo "<li><strong>Gender:</strong> " . $row['Gender'] . "</li><br/>";
    echo "<li><strong>Phone Number:</strong> " . $row['Phone_no'] . "</li><br/>";
    echo "<li><strong>NIC:</strong> " . $row['NIC'] . "</li><br/>";
    echo "<li><strong>Email:</strong> " . $row['Email'] . "</li><br/>";
    echo "<li><strong>Date of Birth:</strong> " . $row['Date_of_birth'] . "</li><br/>";
    echo "<li><strong>Hobby:</strong> " . $row['Hobby'] . "</li><br/>";
    echo "<li><strong>Preferred Language:</strong> " . $row['Preferred_language'] . "</li><br/>";
    echo "<li><strong>Job Title:</strong> " . $row['Job_title'] . "</li><br/>";
    echo "<li><strong>Preferred Payment Method:</strong> " . $row['Preferred_payment_method'] . "</li><br/>";
    echo "<li><strong>Customer Type:</strong> " . $row['Customer_type'] . "</li><br/>";

    echo "</ul>";
} else {
    if ($result === false) {
        echo "<p>Error fetching data: " . $conn->error . "</p>";
    } else {
        echo "<p>No data found for your account.</p>";
    }
}
?>

<!-- Add your HTML for any additional features or styling here -->

<p>Back to home:<a href="crm.php">Home</a></p>

</body>
</html>
