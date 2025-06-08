<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $nic = $_POST["nic"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $hobbies = $_POST["hobbies"];
    $language = $_POST["language"];
    $job = $_POST["job"];
    $pmethod = $_POST["pmethod"];
    $ctype = $_POST["ctype"];


include("connection.php");

    // SQL query to insert user data into the database
    $sql = "INSERT INTO customer_relation (First_name,Last_name,Username, Password,Address,Gender,Phone_no,NIC,Email,Date_of_birth,Hobby,Preferred_language,Job_title,Preferred_payment_method,Customer_type,Admin) VALUES ('$firstname','$lastname','$username', '$password','$address','$gender','$phone','$nic','$email','$dob','$hobbies[0],$hobbies[1],$hobbies[2]','$language','$job','$pmethod','$ctype','')";

    if ($conn->query($sql) === TRUE) {
	// Get the last inserted ID
    	$lastInsertedId = $conn->insert_id;
	$_SESSION['customer_id'] = $lastInsertedId;
        // redirect to id page
        header("Location: id.php");
        exit();
    } else {
        // Display an error message if the registration fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
<link rel="stylesheet" type="text/css" href="./files/sample.css">

<script src="./js/validate.js" type="text/javascript"></script>

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

<h1>Sign Up</h1>
     <form name="signup" method="post" action="" onsubmit="return validateForm()">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="username" id="username"  required></td>
                <td><span id="nameError" style="color: red;"></span></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id="password" required></td>
                <td><span id="passwordError" style="color: red;"></span></td>
            </tr>
	    <tr>
		<td>Address:</td>
		<td><textarea name="address" id="address" rows="2" cols="20"></textarea></td>
                <td><span id="addressError" style="color: red;"></span></td>
	    </tr>
	    <tr>
		<td>Gender</td>
		<td><input type="radio" name="gender" value="male" id="male">

		<label for="male">Male</label></td>

		<td><input type="radio" name="gender" value="female" id="female">
		<label for="female">Female</label></td>
                <td><span id="genderError" style="color: red;"></span></td>
	    </tr>
	    <tr>
		<td>Phone Number:</td>
		<td><input type="number" name="phone" id="phone"></td>
                <td><span id="phoneError" style="color: red;"></span></td>
	    </tr>
	    <tr>
		<td>NIC:</td>
		<td><input type="number" name="nic"id="nic"></td>
                <td><span id="nicError" style="color: red;"></span></td>
	    </tr>
	    <tr>
		<td>email:</td>
		<td><input type="text" name="email" id="email"></td>
                 <td><span id="emailError" style="color: red;"></span></td>
	    </tr>
	    <tr>
		<td>Date of birth:</td>
		<td><input type="date" name="dob" id="dob"></td>
                <td><span id="dobError" style="color: red;"></span></td>
	    </tr>
	    <tr>
		<td>Hobby:</td>
		<td>
		<input type="checkbox" name="hobbies[]" value="reading" check>Reading
		<input type="checkbox" name="hobbies[]" value="Watching movies" check>Watching Movies
		<input type="checkbox" name="hobbies[]" value="others" check>Others
		</td>
	    </tr>
	    <tr>
		<td>Preferred Language:</td>
		<td>
		<select name="language">
		<option selected>Sinhala</option>
		<option>Tamil</option>
		<option>English</option>
		<option>Other</option>
		</select>
		</td>
	    </tr>
	    <tr>
		<td>Job title:</td>
		<td><input type="text" name="job"></td>
	    </tr>
	    <tr>
		<td>Preferred payment method:</td>
		<td>
		<select name="pmethod">
		<option selected>Cash</option>
		<option>Debit card</option>
		<option>Credit card</option>
		</select>
		</td>
	    </tr>
	    <tr>
		<td>Customer type:</td>
		<td>
		<select name="ctype">
		<option selected>Individual</option>
		<option>Business</option>
		</select>
		</td>
	    </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Sign Up"></td>
                <td><input type="reset" value="Clear"></td>
            </tr>
	    <tr>
		<td>Return to login: </td>
		<td><a href="login.php">Login</a></td>
	    </tr>
        </table>
    </form>
</body>
</html>
