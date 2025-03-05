<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
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
<?php
// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $password = $_POST["password"];

include("connection.php");

    // SQL query to check if user exists
    $sql = "SELECT * FROM customer_relation WHERE Username = '$username' AND Password = '$password'";
    $result = $conn->query($sql);

    // If user exists, check admin status
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
	$customerID = $row['Customer_id'];
        $adminStatus = $row['Admin'];

        // Set the username session variable
        $_SESSION['username'] = $username;
	$_SESSION['customerID'] = $customerID;

        // Check admin status and redirect accordingly
        if ($adminStatus == "yes") {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: crm.php");
            exit();
        }
    } else {
        // Set a session variable for displaying the message
        $_SESSION['login_message'] = "Invalid login credentials";
    }
   
}
// Check if the login message session variable is set
if (isset($_SESSION['login_message'])) {
    // Display the message and then unset the session variable
    echo "<p style='color: red;'>{$_SESSION['login_message']}</p>";
    unset($_SESSION['login_message']);
}
?>

<ul class="ul1" >
    <li><a href="index.php">Login</a></li>
    <li><a href="signup.php">Signup</a></li>
    <li><a href="help.php">Help</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<center>
<h1>User Login</h1>

<img src="./images/user.png" width="20%" height="20%">
<br/><br/><br/><br/>
<form name="login" method="post" >
    <table>
        <tr>
            <td>User Name:</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Login"></td>
            <td><input type="reset" value="Clear"></td>
        </tr>
        <tr>
            <td>For new users:</td>
            <td><a href="signup.php">Register now</a></td>
        </tr>
    </table>
</form>
</center>
</body>
</html>
