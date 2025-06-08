<?php
session_start();

include("connection.php");

// Check if the username session variable is set
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
else {
    // If not logged in, display a message and prevent form submission
    echo "<p style='color: red;'>You must log in first.<a href='index.php'>Login</a></p>";
    exit(); // Stop further execution
}  
?>

<html>
<head>
    <title>Administration Home</title>
    <link rel="stylesheet" type="text/css" href="./files/sample.css">
</head>
<body>

<ul class="ul1" >
    <li><a href="index.php">Login</a></li>
    <li><a href="signup.php">Signup</a></li>
    <li><a href="help.php">Help</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<h1>Welcome, <?php echo $username; ?></h1>
<h3><u>Current customer database</u></h3>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve customer ID from the form
    $customerIDToDelete = $_POST["cid"];

    // Check if the customer ID exists in the database
    $checkExistenceSQL = "SELECT Customer_id FROM customer_relation WHERE Customer_id = $customerIDToDelete";
    $existenceResult = $conn->query($checkExistenceSQL);

    if ($existenceResult->num_rows > 0) {
        // Customer ID exists, proceed with deletion
        // SQL query to delete the customer
        $deleteSQL = "DELETE FROM customer_relation WHERE Customer_id = $customerIDToDelete";

        if ($conn->query($deleteSQL) === TRUE) {
            echo "<p style='color: blue;'>Customer with ID $customerIDToDelete deleted successfully.</p>";
        } else {
            echo "<p style='color: red;'>Error deleting customer:</p> " . $conn->error;
        }
    } else {
        // Customer ID does not exist
        echo "<p style='color: red;'>Customer with ID $customerIDToDelete not found.</p>";
    }
}


// SQL query to fetch user data excluding password and filtering out Admins
$sql = "SELECT Customer_id, First_name, Last_name, Username, Address, Gender, Phone_no, NIC, Email, Date_of_birth, Hobby, Preferred_language, Job_title, Preferred_payment_method, Customer_type
        FROM customer_relation
        WHERE Admin != 'yes'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display user data in a table
    echo "<table border='1'>";
    echo "<tr><th>Customer ID</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Address</th><th>Gender</th><th>Phone Number</th><th>NIC</th><th>Email</th><th>Date of Birth</th><th>Hobby</th><th>Preferred Language</th><th>Job Title</th><th>Preferred Payment Method</th><th>Customer Type</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Customer_id'] . "</td>";
        echo "<td>" . $row['First_name'] . "</td>";
        echo "<td>" . $row['Last_name'] . "</td>";
        echo "<td>" . $row['Username'] . "</td>";
        echo "<td>" . $row['Address'] . "</td>";
        echo "<td>" . $row['Gender'] . "</td>";
        echo "<td>" . $row['Phone_no'] . "</td>";
        echo "<td>" . $row['NIC'] . "</td>";
        echo "<td>" . $row['Email'] . "</td>";
        echo "<td>" . $row['Date_of_birth'] . "</td>";
        echo "<td>" . $row['Hobby'] . "</td>";
        echo "<td>" . $row['Preferred_language'] . "</td>";
        echo "<td>" . $row['Job_title'] . "</td>";
        echo "<td>" . $row['Preferred_payment_method'] . "</td>";
        echo "<td>" . $row['Customer_type'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No user data found.";
}
?>

<br/><br/><br/><br/>
<h3>Delete a customer</h3><br/>
<form method="post" action="">
    <table>
        <tr>
            <td>Customer ID:</td>
            <td><input type="number" name="cid"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Delete"></td>
        </tr>
    </table>
</form>
<h3>Edit a customer: <a href="edit.php">Edit</a></h3>
<h3>Stats: <a href="noc.php">Stats</a></h3>
<h3>Complaints:<a href="admin_complaint.php">Complaints</a></h3>
<h3>Orders:<a href="admin_order.php">Orders</a></h3>
</body>
</html>
