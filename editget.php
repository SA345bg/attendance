<?php 
    require_once 'db/connection.php';

    // Get values from GET operation
    if(isset($_GET['submit'])) {
        // Extract values from $_GET-array
        $id = $_GET['id'];
        $fname = $_GET['firstname'];
        $lname = $_GET['lastname'];
        $dob = $_GET['dob'];
        $specialty = $_GET['specialty'];
        $email = $_GET['email'];
        $contact = $_GET['phone'];
    
        // Call crud function
        $result = $crud->editAttendee($id, $fname, $lname, $dob, $specialty, $email, $contact);

        // Redirect to viewrecords.php
        if($result == true) {
            include 'includes/successmessage.php';
            header("Location: viewrecords.php");
        } else {
            // echo 'error';
            include 'includes/errormessage.php';
        }

    } else {
        // echo 'error';
        include 'includes/errormessage.php';
    }
?>