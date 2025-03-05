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
  // Retrieve user input
  $id = $_POST["id"];

  // Check if the entered customer ID matches the session customer ID
  if ($id != $sessionCustomerId) {
      echo "<p style='color: red;'>Wrong customer ID. Please enter your own customer ID.</p>";
  } else {
      // Continue with form processing
      $product = $_POST["product"];
      $date = $_POST["date"];
      $quantity = $_POST["quantity"];
      $amount = $_POST["amount"];
      $pmethod = $_POST["pmethod"];
      $status = $_POST["status"];
      $rating = $_POST["rating"];
      $feedback = $_POST["feedback"];

      // SQL query to insert user data into the database
      $sql = "INSERT INTO feedback (Customer_id,Product_name,Purchase_date,Quantity,Total_amount,Payment_method,Purchase_status,Purchase_rating,Feedback) VALUES ('$id','$product','$date','$quantity','$amount','$pmethod','$status','$rating','$feedback')";

      if ($conn->query($sql) === TRUE) {
          // if Submit successful, 
          echo "<p style='color:blue;'>Submit Successful</p>";
      } else {
          // Display an error message if the Submition fails
          echo "<p style='color:red;'>Please fill the entire form</p>";
      }
  }
}
?>
<html>
<head>
	<title>Home</title>
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


<h1>Welcome, <?php echo $username; ?> </h1>
<h3>Dear customer, Let us know about your experience</h3>

<form name="crm" method="post" action="">
<table>
<tr>
<td>Customer ID:</td>
<td><input type="number" name="id"></td>
</tr>
<tr>
<td>Product Category:</td>
<td>
<select name="product">
<option selected></option>
<option>Home and Furniture</option>
<option>Toys</option>
<option>Sports and Outdoors</option>
<option>Automative</option>
<option>Food and Beverages</option>
</select>
</td>
</tr>
<tr>
<td>Purchase date:</td>
<td><input type="date" name="date"></td>
</tr>
<tr>
<td>Quantity:</td>
<td><input type="number" name="quantity"></td>
</tr>
<tr>
<td>Total amount:</td>
<td><input type="number" name="amount"></td>
</tr>
<tr>
<td>Payment method</td>
<td>
<select name="pmethod">
<option selected>Cash</option>
<option>Debit card</option>
<option>Credit card</option>
</select>
</td>
</tr>
<tr>
<td>Purchase status:</td>
<td>
<select name="status">
<option selected>Completed</option>
<option>Pending</option>
<option>Canceled</option>
</select>
</td>
</tr>
<tr>
<td>Purchase Rating:</td>
<td><input type="number" name="rating" min="1" max="5"></td>
</tr>
<tr>
<td>Feedback:</td>
<td><textarea name="feedback" rows="5" cols="20"></textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Submit"></td>
<td><input type="reset" value="Clear"></td>
</tr>
</table>
</form>

<p>Having trouble with something?<a href="complaint.php">Complaint</a></p>
<p>Your details:<a href="details.php">Details</a></p>
<p>Track Your Order:<a href="order_status.php">Track</a></p>
</body>
</html>
