<html>
<head>
    <title>Edit</title>
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
    // If not logged in, display a message and prevent form submission
    echo "<p style='color: red;'>You must log in first.<a href='index.php'>Login</a></p>";
    exit(); // Stop further execution
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve customer ID from the form
    $customerIDToEdit = $_POST["cid1"];

    // Check if the customer ID exists in the database
    $checkExistenceSQL = "SELECT Customer_id FROM customer_relation WHERE Customer_id = $customerIDToEdit";
    $existenceResult = $conn->query($checkExistenceSQL);

    if ($existenceResult->num_rows > 0) {
        // Customer ID exists, proceed with updating
        // Retrieve user input for editing
        $newUsername = $_POST["username"];
        $newAddress = $_POST["address"];
        $newGender = isset($_POST["gender"]) ? $_POST["gender"] : "";
        $newPhone = $_POST["phone"];
        $newNIC = $_POST["nic"];
        $newEmail = $_POST["email"];
        $newDOB = $_POST["dob"];
        $newHobbies = isset($_POST["hobbies"]) ? implode(",", $_POST["hobbies"]) : "";
        $newLanguage = $_POST["language"];
        $newJob = $_POST["job"];
        $newPMethod = $_POST["pmethod"];
        $newCType = $_POST["ctype"];

        // Build the SET clause of the SQL query
        $setClause = "SET";
        $setClause .= empty($newUsername) ? "" : " Username = '$newUsername',";
        $setClause .= empty($newAddress) ? "" : " Address = '$newAddress',";
        $setClause .= empty($newGender) ? "" : " Gender = '$newGender',";
        $setClause .= empty($newPhone) ? "" : " Phone_no = '$newPhone',";
        $setClause .= empty($newNIC) ? "" : " NIC = '$newNIC',";
        $setClause .= empty($newEmail) ? "" : " Email = '$newEmail',";
        $setClause .= empty($newDOB) ? "" : " Date_of_birth = '$newDOB',";
        $setClause .= empty($newHobbies) ? "" : " Hobby = '$newHobbies',";
        $setClause .= empty($newLanguage) ? "" : " Preferred_language = '$newLanguage',";
        $setClause .= empty($newJob) ? "" : " Job_title = '$newJob',";
        $setClause .= empty($newPMethod) ? "" : " Preferred_payment_method = '$newPMethod',";
        $setClause .= empty($newCType) ? "" : " Customer_type = '$newCType',";

        // Remove the trailing comma
        $setClause = rtrim($setClause, ',');

        // SQL query to update user data
        $updateSQL = "UPDATE customer_relation $setClause WHERE Customer_id = $customerIDToEdit";

        if ($conn->query($updateSQL) === TRUE) {
            echo "Customer with ID $customerIDToEdit updated successfully.";
        } else {
            echo "Error updating customer: " . $conn->error;
        }
    } else {
        // Customer ID does not exist
        echo "<p style='color: red;'>Customer with ID $customerIDToEdit not found.</p>";
    }
}

// SQL query to fetch user data excluding password and filtering out Admins
$sql = "SELECT Customer_id, Username, Address, Gender, Phone_no, NIC, Email, Date_of_birth, Hobby, Preferred_language, Job_title, Preferred_payment_method, Customer_type
        FROM customer_relation
        WHERE Admin != 'yes'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display user data in a table
    echo "<table border='1'>";
    echo "<tr><th>Customer ID</th><th>Name</th><th>Address</th><th>Gender</th><th>Phone Number</th><th>NIC</th><th>Email</th><th>Date of Birth</th><th>Hobby</th><th>Preferred Language</th><th>Job Title</th><th>Preferred Payment Method</th><th>Customer Type</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Customer_id'] . "</td>";
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
    echo "No customers found.";
}

?>

<br/><br/><br/>
<h3><u>Edit form</u></h3><br/>
<form name="edit" method="post" action="">
    <table>
        <tr>
            <td>Customer ID:</td>
            <td><input type="number" name="cid1" required></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><textarea name="address" rows="2" cols="20"></textarea></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td><input type="radio" name="gender" value="male" id="male">
                <label for="male">Male</label></td>

            <td><input type="radio" name="gender" value="female" id="female">
                <label for="female">Female</label></td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><input type="number" name="phone"></td>
        </tr>
        <tr>
            <td>NIC:</td>
            <td><input type="number" name="nic"></td>
        </tr>
        <tr>
            <td>email:</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Date of birth:</td>
            <td><input type="date" name="dob"></td>
        </tr>
        <tr>
            <td>Hobby:</td>
            <td>
                <input type="checkbox" name="hobbies[]" value="Reading" check>Reading
                <input type="checkbox" name="hobbies[]" value="Watching movies" check>Watching Movies
                <input type="checkbox" name="hobbies[]" value="Others" check>Others
            </td>
        </tr>
        <tr>
            <td>Preferred Language:</td>
            <td>
                <select name="language">
                    <option selected></option> 
                    <option>Sinhala</option>
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
                    <option selected></option>
                    <option>Cash</option>
                    <option>Debit card</option>
                    <option>Credit card</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Customer type:</td>
            <td>
                <select name="ctype">
                    <option selected></option>
                    <option>Individual</option>
                    <option>Business</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Edit"></td>
            <td><input type="reset" value="Clear"></td>
        </tr>
    </table>
</form>

<p>Back to previous page: <a href="admin.php">Back</a></p>

</body>
</html>
