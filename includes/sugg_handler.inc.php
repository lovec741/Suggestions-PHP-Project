<?php 
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    
    include_once 'dbh.inc.php';
    
    $suggestion = $_POST["suggestion"];
    $display_name = $_POST["display_name"];
    $email = $_POST["email"];
    if (strlen($suggestion) > 1000) {
        $len = strlen($suggestion);
        $msg = "Suggestion too long! Must be max 1000 characters long. But yours is $len characters long.";
        header("Location: ../index.php?msg=$msg&succ=0");
    }
    elseif (strlen($display_name) > 40) {
        $len = strlen($display_name);
        $msg = "Name too long! Must be max 40 characters long. But yours is $len characters long.";
        header("Location: ../index.php?msg=$msg&succ=0");
    }
    elseif (strlen($email) > 64) {
        $len = strlen($email);
        $msg = "Email too long! Must be max 64 characters long. But yours is $len characters long.";
        header("Location: ../index.php?msg=$msg&succ=0");
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "'$email' is not a valid email adress!";
        header("Location: ../index.php?msg=$msg&succ=0");
    }
    else {
        $suggestion = mysqli_real_escape_string($conn, $suggestion);
        $display_name = mysqli_real_escape_string($conn, $display_name);
        $email = mysqli_real_escape_string($conn, $email);
        
        mysqli_query($conn, "INSERT INTO suggestions (suggestion, display_name, email) VALUES ('$suggestion', '$display_name', '$email')");
        $msg = "Successfully added your suggestion!";
        header("Location: ../index.php?msg=$msg&succ=1");
    }
    
