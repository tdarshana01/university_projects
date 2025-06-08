<html>
<head>
    <title>Orders-Admin page</title>
    <link rel="stylesheet" type="text/css" href="./files/sample.css">

</head>
<body>

<ul class="ul1" >
    <li><a href="index.php">Login</a></li>
    <li><a href="signup.php">Signup</a></li>
    <li><a href="help.php">Help</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<br/><br/><br/>

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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $orderid = isset($_POST["oid"]) ? $_POST["oid"] : "";
    $orderStatus = $_POST["status"];

    // Check if the entered order ID exists in the orders table
    $checkOrderID = "SELECT * FROM orders WHERE Order_id = $orderid";
    $result = $conn->query($checkOrderID);

    if ($result->num_rows > 0) {
        // Build the SET clause of the SQL query
        $setClause = "SET";

        // Add columns to the SET clause only if the corresponding form fields are not empty
        if (!empty($orderStatus)) {
            $setClause .= " Order_status = '$orderStatus',";
        }

        // Remove the trailing comma
        $setClause = rtrim($setClause, ',');

        // Check if there's anything to update
        if (!empty($setClause)) {
            // Update the database
            $updateSQL = "UPDATE orders $setClause WHERE Order_id = $orderid";

            if ($conn->query($updateSQL) === TRUE) {
                echo "<p style='color: blue;'>Order status updated successfully.</p>";
            } else {
                echo "<p style='color: red;'>Error updating order status:</p> " . $conn->error;
            }
        } else {
            echo "No fields provided for update.";
        }
    } else {
        echo "<p style='color: red;'>Wrong order ID. Please enter a valid order ID.</p>";
    }
}

// SQL query to fetch complaint data
$complaintSQL = "SELECT Customer_id, Product_id, Order_id, Order_status,Product_name
                 FROM orders";

$complaintResult = $conn->query($complaintSQL);

if ($complaintResult->num_rows > 0) {
    // Display complaint data in a table
    echo "<table border='1'>";
    echo "<tr><th>Customer ID</th><th>Product ID</th><th>Order ID</th><th>Order Status</th><th>Product Category</th>";

    while ($row = $complaintResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Customer_id'] . "</td>";
        echo "<td>" . $row['Product_id'] . "</td>";
        echo "<td>" . $row['Order_id'] . "</td>";
        echo "<td>" . $row['Order_status'] . "</td>";
        echo "<td>" . $row['Product_name'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No complaints found.";
}

?>

<br/><br/><br/>
<form method="post" action="">
    <table>
        <tr>
            <td>Order ID:</td>
            <td><input type="number" name="oid" required></td>
        </tr>
        <tr>
            <td>Order Status:</td>
            <td>
                <select name="status">
                    <option selected></option>
                    <option>Processing</option>
                    <option>Shipped</option>
                    <option>Delivered</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Update"></td>
        </tr>
    </table>
</form>

<p>Back to Home:<a href="admin.php">Back</a></p>
</body>
</html>
