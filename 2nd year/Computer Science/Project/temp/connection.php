<?php


    // Connect to MySQL database
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "abc";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }