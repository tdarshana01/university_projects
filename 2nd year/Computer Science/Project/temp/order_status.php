<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>

<link rel="stylesheet" type="text/css" href="./files/sample.css">

<style>
table{
	font-size:26px;
}

td{
	font-size:20px;
	padding:5px;
}

  input[type="submit"] {
    background-color: #4CAF50; 
    color: white;             
    border: none;             
    padding: 10px 20px;       
    cursor: pointer;          
    border-radius:5px;
  }

  // Style on hover 
  input[type="submit"]:hover {
    background-color: #45a049; 
  }

  input[type="reset"] {
    background-color:white ; 
    color: #4CAF50;             
    border: 1px solid #4CAF50;             
    padding: 10px 20px;       
    cursor: pointer;          
    border-radius:5px;
  }

  /* Style on hover */
  input[type="reset"]:hover {
    color: #45a049;
    border-color:#45a049; 
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

<form method="post" action="">
    <table>
        <tr>
            <td>Order ID:</td>
            <td><input type="number" name="oid"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="OK"></td>
        </tr>
    </table>
</form>

<?php
// Assuming you have a database connection
include("connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve Order ID from the form
    $orderID = $_POST['oid'];

    // SQL query to fetch Order status for the given Order ID
    $orderQuery = "SELECT Order_status FROM orders WHERE Order_id = $orderID";

    $orderResult = $conn->query($orderQuery);

    if ($orderResult !== false && $orderResult->num_rows > 0) {
        // Fetch the Order status
        $row = $orderResult->fetch_assoc();
        $orderStatus = $row['Order_status'];

        // Display the Order status in a table
        echo "<h3>Order Details for Order ID: $orderID</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Order ID</th><th>Order Status</th></tr>";
        echo "<tr><td>$orderID</td><td>$orderStatus</td></tr>";
        echo "</table>";
    } else {
        if ($orderResult === false) {
            echo "<p>Error fetching data: " . $conn->error . "</p>";
        } else {
            echo "<p>No orders found for Order ID: $orderID</p>";
        }
    }
}
?>

<p>Back to home:<a href="crm.php">Home</a></p>

</body>
</html>
