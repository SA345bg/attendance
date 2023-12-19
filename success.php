<?php 
    $title = "Success";
    require_once 'includes/header.php'; 
    require_once 'db/connection.php';

    // Check if the variable $_GET['submit'] is existing; if submit-variable is existing, than all other variables are existing with big chance, i. e. they have values which are sent
    if(isset($_GET['submit'])) {
        // Extract values from $_GET-array
        $fname = $_GET['firstname'];
        $lname = $_GET['lastname'];
        $dob = $_GET['dob'];
        $specialty = $_GET['specialty'];
        $email = $_GET['email'];
        $contact = $_GET['phone'];

        // Call function to insert and track all variables - if there is success of existing variables, it is true; otherwise is false
        $isSuccess = $crud->insertAttendees($fname, $lname, $dob, $specialty, $email, $contact);

        if($isSuccess) {
            // echo '<h1 class="text-center text-success">You have been registered!</h1>';
            include 'includes/successmessage.php';
            header("Location: viewrecords.php");
        } else {
            // echo '<h1 class="text-center text-danger">There was an error in processing!</h1>';
            include 'includes/errormessage.php';
        }
    };
?>

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $_GET['firstname'] . ' ' . $_GET['lastname']; ?>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    <?php echo $_GET['specialty']; ?>
                </h6>
                <p class="card-text">
                    Date Of Birth: <?php echo $_GET['dob']; ?>
                </p>
                <p class="card-text">
                    Email Address: <?php echo $_GET['email']; ?>
                </p>
                <p class="card-text">
                    Contact Number: <?php echo $_GET['phone']; ?>
                </p>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
<?php require_once 'includes/footer.php'; ?>