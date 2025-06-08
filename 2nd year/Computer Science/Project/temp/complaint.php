<html>
<head>
	<title>Complaint</title>

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



<?php
session_start();

include("connection.php");

// Check if the username session variable is set
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $sessionCustomerId = $_SESSION['customerID']; // Assuming you have a session variable for customer ID
} else {
  // If not logged in, display a message and prevent form submission
  echo "<p style='color: red;'>You must log in first.<a href='index.php'>Login</a></p>";
  exit(); // Stop further execution
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form, ensuring they are set
    $customerID = isset($_POST["cid"]) ? $_POST["cid"] : null;
    $productID = isset($_POST["pid"]) ? $_POST["pid"] : null;
    $orderID = isset($_POST["oid"]) ? $_POST["oid"] : null;
    $complaintText = isset($_POST["complaint"]) ? $_POST["complaint"] : null;

    // Check if required fields are not empty
    if ($customerID !== null && $productID !== null && $orderID !== null && $complaintText !== null) {
        // SQL query to insert data into the "complaint" table
        $insertSQL = "INSERT INTO complaint (Customer_id, Product_id, Order_id, Complaint_status,Complaint) 
                      VALUES ($customerID, $productID, $orderID,'Open' ,'$complaintText')";

        if ($conn->query($insertSQL) === TRUE) {
            echo "<p style='color: blue;'>Complaint submitted successfully.</p>";
        } else {
            echo "<p style='color: red;'>Please fill the entire form</p> ";
        }
    } 
}

?>





<h2>Customer Complaints</h2>

<form method="post" action="">
<table>
<tr>
<td>Customer ID:</td>
<td><input type="number" name="cid"></td>
</tr>
<tr>
<td>Product ID:</td>
<td><input type="number" name="pid"></td>
</tr>
<tr>
<td>Order ID:</td>
<td><input type="number" name="oid"></td>
</tr>
<tr>
<td>Complaint:</td>
<td><textarea name="complaint" rows="3" cols="20">let us know the trouble</textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Submit"></td>
<td><input type="reset" value="Clear"></td>
</tr>
</table>
</form>


<p>Your Complaints:<a href="complaints_new.php">Complaints</a></p>
<p>Back to Home:<a href="crm.php">Home</a></p>

</body>
</html>