<!DOCTYPE html>
<html >
<head>
    
    <title>Help and support</title>
<link rel="stylesheet" type="text/css" href="./files/sample.css">

<script type="text/javascript" src="script.js"></script>   
<style type="text/css">

h2{ font-size:35px;


}
.set{font-size:20px;}
</style>
	
</head>

<body >
<div>
<ul class="ul1" >
    <li><a href="index.php">Login</a></li>
    <li><a href="signup.php">Signup</a></li>
    <li><a href="help.php">Help</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
</div>

<h1> Do You Need a HELP?<img width="40px" height="40px" src="images/pic1.jpg"></h1>

<ol class="ul1">
<li><a href="#a">How do I Login?</a></li>
<li><a href="#b">How do I signup?</a></li>
<li><a href="#c">How do I contact Admin?</a></li>
<li><a href="#d">Immediate Technical support</a></li>
<li><a href="#e">FAQ</a></li>
<li><a href="#f">Updates and Notes</a></li></ol>
<!--.....................................................LOGIN.........................................................................-->

<div style="background-color: #EEEED0">
<center><h2><a name ="a"</a><b><u>How to Login</u></b></h2>
<span><a align="right" href="index.php">Login</a></span> 
<h3>Follow steps here...</h3>
<table border="1">
<tr>
<td>
<h4 class="set">1. First click on the <q>Login</q>
		tab in the navigation bar and<br/> you will log into  webpage</h4>
<img src="images/Capture.PNG" width="480px" height="480px">
</td>

<td>

<h4 class="set" >2. Enter your user data as follows</h4>
<img src="images/Capture1.PNG" width="480px" height="480px">
</td>
</tr>
<tr>

<td>
<h4 class="set">3. If you are new user,Please click to register.</h4>
<img src="images/Capture2.PNG" width="480px" height="480px">
</td>
<td>
<h4 class="set">4. You will get your user Id.Your need to keep it for future use. </h4>
<img src="images/capture3.jpeg" width="400px" height="400px">
</td>
</tr>

</table>
</center>
<p class="set" align="right"><a href="#top" >Go to Top</a></p>
</div>

<!--.......................................................SIGNUP....................................................................-->

<div style="background-color: #DAEED0">
<center><h2><a name ="b"</a><b><u>How to SignUp/Create an Account</u></b></h2>
<span><a align="right" href="signup.php">SignUp</a></span> 
<h3>Follow steps here...</h3>
<table border="1">
<tr>
<td>
<h4 class="set">1. First click on the <q>SignUp</q>
		tab in the navigation bar</h4>
<img src="images/capture5.PNG" width="480px" height="300px">
</td>

<td>

<h4 class="set">2. You will log into signup webpage</h4>
<img src="images/Capture6.PNG" width="400px" height="480px">
</td>
</tr>
<tr>

<td>
<h4 class="set">3. If you want to login your registered account,Click Login.</h4>
<img src="images/Capture7.PNG" width="480px" height="480px">
</td>
<td>
<h4 class="set">4. You will get your user Id.Your need to keep it for future use. </h4>
<img src="images/capture3.jpeg" width="400px" height="400px">
</td>
</tr>

</table>
</center>
<p class="set" align="right"><a href="#top" >Go to Top</a></p>
</div>





<!--.............................................CONTACT ADMIN..............................................................................-->



<div style="background-color: #C1F5EB">


    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the form fields are set
        $username = isset($_POST["username"]) ? $_POST["username"] : '';
        $phone = isset($_POST["phone"]) ? intval($_POST["phone"]) : 0;
        $email = isset($_POST["email"]) ? $_POST["email"] : '';
        $subject = isset($_POST["msg"]) ? $_POST["msg"] : '';

        // Save data to the 'contact_admin' table
        include("connection.php");

        $sql = "INSERT INTO contact_admin (Username, Phone_number, Email, Subject)
                VALUES ('$username', '$phone', '$email', '$subject')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Your message has been submitted successfully.</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }


    }
    ?>

            <center><h2><a name ="c"</a><b><u>Contact Admin</u></b></h2></center>
            <div  style="width:100%;">
                <form name="myform" onsubmit="return submitForm()" method="post" action="">
                    <p>
                        <label for="fname"><b>User Name:</b></label>
                        <input type="text" id="firstname" name="username" >
                    </p>

         
                    <p>
                        <label for="lname"><b>Phone Number:</b></label>
                        <input type="number" id="depid" name="phone">
                    </p>

                    <p>
                        <label for="email"><b>Email:</b></label>
                        <input type="email" id="email" name="email" placeholder="Enter your email address..">
                    </p>

                    <p>
                        <label for="subject"><b>Subject:</b></label>
                    </p>
                    <textarea placeholder="Type your subject here..." rows="6" cols="100" name="msg"></textarea>

                    <input type="submit" value="Submit" >
                </form>
            
        </div>
       <br/><br/>
            <div >
                <table style="width:100%">

                    
                    <tr><td>
                        
<a href="#" target="_blank"><img src="./images/fb.png" width="40px" height="40px"></a>

<a href="https://www.linkedin.com" target="_blank"><img src="./images/linkdin.png" width="40px" height="40px"></a>

<a href="https://web.whatsapp.com/" target="_blank"><img src="./images/whtsapp.png" width="40px" height="40px"></a>

</td>
                    </tr>
                </table>
              
            </div>
<p class="set" align="right"><a href="#top" >Go to Top</a></p>        
 </div>


<!--........................................TECHNICAL SUPPORT...................................................................................-->

<div style="background-color: #F9D6F2">
 <center><h2><a name ="d"</a><b><u>Do you need Technical Support?</u></b></h2></center>

<table  width="75%">
<tr>
<td>
<img width="50px" height="50px" src="images/call.png"><br/>
<h3>Contact Technical Manager <br/><h3><mark> +9412356778, +9412345678</mark> </h3></h3>
</td>
<td>
<img width="50px" height="50px" src="images/branch.png"><br/>
<h3>Location <br/>
<h3><a href=""</a>Map</h3>
</h3>



</td></tr>
</table>
<p class="set" align="right"><a href="#top" >Go to Top</a></p>
</div>




<!--........................................FAQ...................................................................................-->


<div style="background-color: #F6F9D6">
 <center><h2><a name ="e"</a><b><u>FAQ</u></b></h2>

<table width="80%" cellspacing="20">
<tr ><td style="border-style:groove" >


<h3>1. How Do I Access the CRM System?</h3>
<ul><li >You can use<q>User login or Signup</q>options in Home page.</li>
</ul>
</td></tr>

<tr><td style="border-style:groove">
<h3>2. How Do I Search for and Retrieve Customer Data?</h3>
</td>
</tr>

<tr><td style="border-style:groove">
<h3>3. How Do I Manage Permissions and User Access?</h3>
</td>
</tr>
<tr><td style="border-style:groove">
<h3>4. How Do I Export Data from the CRM System?</h3>
</td>
</tr>

<tr><td style="border-style:groove"><h3>5. How Is Data Security and Privacy Maintained?</h3>
<ul>
<li>We take data security seriously.</li>
<li>Our CRM employs encryption, access controls, and regular data backups.</li>
</ul>



</td>
</tr>


<tr><td style="border-style:groove"><h3>6. How Can I Contact Customer Support for Assistance?</h3>
<ul><li >Contact through the support and go for contact admin.</li>
<li>Reach out to our customer support team.</li>
<li>We are here to assist you with any issues and inquiries.</li>
</ul>

</td>
</tr>
<tr><td style="border-style:groove"><h3>7. What Mobile Access Options Are Available?</h3>
<ul><li >You can simply open your mobile browser, enter the CRM's web address, and log in</li></ul></td>
</tr>
</table>
<p class="set" align="right"><a href="#top" >Go to Top</a></p>
</div>

</center>


<!--.....................................................Updated and Notes.............................................................-->

<div style="background-color: #D6E2F9">
 <center><h2><a name ="f"</a><b><u>Updates</u></b></h2></center>

<h3 style="font-size:25px">Hello CRM Users,</h3>
<p class="set">We are excited to introduce some new features and improvements to our CRM application.<br/><br/>

<a href="#">Click here</a> to download latest update(2023/Oct) and experience fast data loading with new features.<br/></p>

<center><p class="set"><b><q>Faster loading times mean you can access your data more efficiently.</q></b></p></center>

<p class="set">Write your feedback about new update <img width="40px" height="40px" src="images/ja.gif">
 <form>
                    <p>
                        <label for="fname"><b>User Name:</b></label>
                        <input type="text" id="firstname" name="username" >
                    </p>
<textarea placeholder="Type your feedback here..." rows="6" cols="100" name="msg"></textarea>

<input type="submit" value="Submit" >
</form></p>

<p class="set">If you have any issue please contact our Technical Manager<a href="#d">Try</a><br/>
We have more exciting updates planned, including integration with third-party apps and advanced reporting features. <b>Keep in Touch!</b>


</p>


<p class="set" align="right"><a href="#top" >Go to Top</a></p>
</div>
</body>
</html>