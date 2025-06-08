<html>
<head>
    <title>Payment Method and Total Amount Statistics</title>
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

// Check if the username session variable is set
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // If not logged in, display a message and prevent further execution
    echo "<p style='color: red;'>You must log in first.<a href='index.php'>Login</a></p>";
    exit();
}

echo "<h3><u>Customer payment method</u></h3>";

// SQL query to fetch payment method statistics
$paymentMethodStatsSQL = "SELECT Payment_method, COUNT(DISTINCT Customer_id) AS NumberOfCustomers
                         FROM feedback
                         GROUP BY Payment_method";

$paymentMethodStatsResult = $conn->query($paymentMethodStatsSQL);

if ($paymentMethodStatsResult->num_rows > 0) {
    // Display payment method statistics in a table
    echo "<table border='1'>";
    echo "<tr><th>Payment Method</th><th>Number of Customers</th></tr>";

    while ($row = $paymentMethodStatsResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Payment_method'] . "</td>";
        echo "<td>" . $row['NumberOfCustomers'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No payment method statistics found.";
}

echo "<h3><u>Grand total</u></h3>";

// SQL query to fetch grand total of total amount
$grandTotalSQL = "SELECT SUM(Total_amount) AS GrandTotal FROM feedback";

$grandTotalResult = $conn->query($grandTotalSQL);

if ($grandTotalResult->num_rows > 0) {
    $grandTotalRow = $grandTotalResult->fetch_assoc();
    $grandTotal = $grandTotalRow['GrandTotal'];

    echo "<p>Grand Total of Total Amount: $grandTotal</p>";
} else {
    echo "No data found for Grand Total.";
}

echo "<h3><u>Total prices for products</u></h3>";

// SQL query to fetch total amount for each product
$productTotalSQL = "SELECT Product_name, SUM(Total_amount) AS ProductTotal
                    FROM feedback
                    GROUP BY Product_name";

$productTotalResult = $conn->query($productTotalSQL);

if ($productTotalResult->num_rows > 0) {
    // Display total amount for each product in a table
    echo "<table border='1'>";
    echo "<tr><th>Product Name</th><th>Total Amount</th></tr>";

    while ($row = $productTotalResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Product_name'] . "</td>";
        echo "<td>" . $row['ProductTotal'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No product total statistics found.";
}

echo "<h3><u>Customer Feedback</u></h3>";

//SQL query to fetch rating and feedback from feedback table
$feedback = "SELECT Customer_id,Product_name,Purchase_rating, Feedback FROM feedback";

$feedbackResult = $conn->query($feedback);

if($feedbackResult->num_rows > 0){
    //Display rating and feedback
    echo "<table border='1'>";
    echo "<tr><th>Customer ID</th><th>Product Catogery</th><th>Purchase Rating</th><th>Feedback</th></tr>";

    while ($row = $feedbackResult->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row['Customer_id']."</td>";
        echo "<td>".$row['Product_name']."</td>";
        echo "<td>".$row['Purchase_rating']."</td>";
        echo "<td>".$row['Feedback']."</td>";
        echo "</tr>";
    }

    echo "</table>";
}
else {
    echo "No results found";
}

echo "<h3><u>Customer Messages</u></h3>";

//SQL query to fetch all from contact admin
$contact = "SELECT * FROM Contact_admin";

$contactResult = $conn->query($contact);

if ($contactResult->num_rows > 0){
    //Display all from contact admin
    echo "<table border='1'>";
    echo "<tr><th>Message No.</th><th>Username</th><th>Phone number</th><th>Email</th><th>Subject</th></tr>";

    while ($row = $contactResult->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row['Message_no']."</td>";
        echo "<td>".$row['Username']."</td>";
        echo "<td>".$row['Phone_number']."</td>";
        echo "<td>".$row['Email']."</td>";
        echo "<td>".$row['Subject']."</td>";
    }
    echo "</table>";
}
else{
    echo "No results found";
}


?>

<p>Back to home:<a href="admin.php">Back</a></p>
</body>
</html>
