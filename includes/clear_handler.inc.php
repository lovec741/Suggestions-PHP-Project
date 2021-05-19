<?php 
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    
    include_once 'dbh.inc.php';
    
    $password = $_POST["pass"];
    $result = "$2y$10\$b.s4Do5b2wQ09iiWA6LotOwtlKxB2uHeOITidEZOPztsP4aRLTIje";//password_hash("TEST", PASSWORD_DEFAULT);
    if (password_verify($password, $result)) {
        mysqli_query($conn, "TRUNCATE suggestions");
        $msg = "Succesfully cleared all suggestions!";
        header("Location: ../index.php?msg=$msg&succ=1");
    } else {
        $msg = "Invalid Admin Key.";
        header("Location: ../index.php?msg=$msg&succ=0");
    }
