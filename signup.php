<?php
require('functions.php');

if ($_POST && $_REQUEST['firstName']) {
    // Get each field and insert to the database
    $user['firstName'] = $_REQUEST['firstName'];
    $user['lastName'] = $_REQUEST['lastName'];
    $user['email'] = $_REQUEST['email'];
    $user['province_id'] = $_REQUEST['province'];
    $user['password'] = $_REQUEST['password'];
    
    if (saveUser($user)) {
        // Redirect to the users page after successful insertion
        header("Location: users.php");
        exit; // Always use exit after a redirect
    }
    
    // If there is an error, redirect back with an error parameter
    header("Location: /?error=true");
    exit; // Ensure the script stops after redirecting
}