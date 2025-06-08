<html>
<head>
    <title>Admin Page - Complaints</title>
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
    $customerid = isset($_POST["cid"]) ? $_POST["cid"] : "";

    // Check if the customer ID exists in the database
    $checkExistenceSQL = "SELECT Customer_id FROM complaint WHERE Customer_id = $customerid";
    $existenceResult = $conn->query($checkExistenceSQL);

    if ($existenceResult->num_rows > 0) {
        // Customer ID exists, proceed with updating
        $complaintStatus = $_POST["status"];
        $adminMessage = $_POST["msg"];

        // Build the SET clause of the SQL query
        $setClause = "SET";

        // Add columns to the SET clause only if the corresponding form fields are not empty
        if (!empty($complaintStatus)) {
            $setClause .= " Complaint_status = '$complaintStatus',";
        }

        if (!empty($adminMessage)) {
            $setClause .= " Admin_msg = '$adminMessage',";
        }

        // Remove the trailing comma
        $setClause = rtrim($setClause, ',');

        // Check if there's anything to update
        if (!empty($setClause)) {
            // Update the database
            $updateSQL = "UPDATE complaint $setClause WHERE Customer_id = $customerid";

            if ($conn->query($updateSQL) === TRUE) {
                echo "<p style='color: blue;'>Complaint status and message updated successfully.</p>";
            } else {
                echo "<p style='color: red;'>Error updating complaint:</p> " . $conn->error;
            }
        } else {
            echo "No fields provided for update.";
        }
    } else {
        // Customer ID does not exist
        echo "<p style='color: red;'>Customer with ID $customerid not found.</p>";
    }
}

// SQL query to fetch complaint data
$complaintSQL = "SELECT Customer_id, Product_id, Order_id, Complaint_status, Complaint, Admin_msg
                 FROM complaint";

$complaintResult = $conn->query($complaintSQL);

if ($complaintResult->num_rows > 0) {
    // Display complaint data in a table
    echo "<table border='1'>";
    echo "<tr><th>Customer ID</th><th>Product ID</th><th>Order ID</th><th>Complaint Status</th><th>Complaint</th><th>Admin Message</th></tr>";

    while ($row = $complaintResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Customer_id'] . "</td>";
        echo "<td>" . $row['Product_id'] . "</td>";
        echo "<td>" . $row['Order_id'] . "</td>";
        echo "<td>" . $row['Complaint_status'] . "</td>";
        echo "<td>" . $row['Complaint'] . "</td>";
        echo "<td>" . $row['Admin_msg'] . "</td>";
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
            <td>Customer ID:</td>
            <td><input type="number" name="cid" required></td>
        </tr>
        <tr>
            <td>Complaint Status:</td>
            <td>
                <select name="status">
                    <option selected></option>
                    <option>In progress</option>
                    <option>Resolved</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Message to customer:</td>
            <td><textarea name="msg">type here</textarea></td>
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
