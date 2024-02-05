
<?php 
    require_once 'db/conn.php';

    // Get values from POST operation
    if(isset($_POST['submit'])) {
        // Extract values from $_POST-array
        $id = $_POST['id'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $specialty = $_POST['specialty'];
        $email = $_POST['email'];
        $contact = $_POST['phone'];
    
        // Call crud function
        $result = $crud->editAttendee($id, $fname, $lname, $dob, $specialty, $email, $contact);

        // Redirect to viewrecords.php
        if($result == true) {
            // include 'includes/successmessage.php';
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

<?php require_once 'includes/footer.php'; ?>
