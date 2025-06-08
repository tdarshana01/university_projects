<html>
<head>
	<title>Your Complaint</title>
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

<h2>Your Complaints</h2>

<form method="post" action="">
    <table>
        <tr>
            <td>Customer ID:</td>
            <td><input type="number" name="id"></td>
            <td><input type="submit" value="OK"></td>
        </tr>
    </table>
</form>

<?php
session_start();

include("connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve customer ID from the form
    $customerID = $_POST["id"];

    // SQL query to fetch data for the given customer ID
    $complaintQuery = "SELECT Complaint_status, Admin_msg FROM complaint WHERE Customer_id = $customerID";

    $complaintResult = $conn->query($complaintQuery);

    if ($complaintResult !== false && $complaintResult->num_rows > 0) {
        // Display complaint data in a table
        echo "<h3>Complaint Details for Customer ID: $customerID</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Complaint Status</th><th>Admin Message</th></tr>";

        while ($row = $complaintResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Complaint_status'] . "</td>";
            echo "<td>" . $row['Admin_msg'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        if ($complaintResult === false) {
            echo "<p style='color: red;'>Error fetching data: " . $conn->error . "</p>";
        } else {
            echo "<p>No complaints found for Customer ID: $customerID</p>";
        }
    }
}
?>

<p>Back to home:<a href="crm.php">Back</a></p>

</body>
</html>
