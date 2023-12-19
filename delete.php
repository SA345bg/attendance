<?php 
    require_once 'db/connection.php';
    if(!$_GET['id']) {
        // echo 'error';
        include 'includes/errormessage.php';
    } else {
        // Get ID values
        $id = $_GET['id'];

        // Call Delete function
        $result = $crud->deleteAttendee($id);

        // Redirect to list 
        if($result == true) {
            include 'includes/successmessage.php';
            header("Location: viewrecords.php");
        } else {
            // echo 'error';
            include 'includes/errormessage.php';
        }
        
    }
?>