<?php 
    $conn=mysqli_connect("localhost","root","","airku");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }