<?php 
    $title = "Success";
    require_once 'includes/header.php'; 
    require_once 'db/conn.php';
    require_once 'sendmail.php';


    // Check if the variable $_POST['submit'] is existing; if submit-variable is existing, than all other variables are existing with big chance, i. e. they have values which are sent
    if(isset($_POST['submit'])) {
        // Extract values from $_POST-array
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $specialty = $_POST['specialty'];
        $email = $_POST['email'];
        $contact = $_POST['phone'];

        $orig_name = $_FILES["avatar"]["tmp_name"]; 
        $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION); 
        $target_dir = 'uploads/'; 
        // $destination = $target_dir . basename($_FILES["avatar"]["name"]); 
        $destination = "$target_dir$contact.$ext"; 
        move_uploaded_file($orig_name, $destination); 

        // Call function to insert and track all variables - if there is success of existing variables, it is true; otherwise is false
        $isSuccess = $crud->insertAttendees($fname, $lname, $dob, $specialty, $email, $contact,$destination);
        $specialtyName = $crud->getSpecialtyById($specialty); 

        if($isSuccess) {
            $response = sendMail($email, "Welcome", "You have been registered successfully!");
            // echo '<h1 class="text-center text-success">You have been registered!</h1>';
            include 'includes/successmessage.php';
        }else {
            // echo '<h1 class="text-center text-danger">There was an error in processing!</h1>';
            include 'includes/errormessage.php';
        }
    };
?>
        <img src="<?php echo $destination; ?>" class="rounded" style="width: 20%; height: 20%" />
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $_POST['firstname'] . ' ' . $_POST['lastname']; ?>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    <?php echo $specialtyName['name']; ?>
                </h6>
                <p class="card-text">
                    Date Of Birth: <?php echo $_POST['dob']; ?>
                </p>
                <p class="card-text">
                    Email Address: <?php echo $_POST['email']; ?>
                </p>
                <p class="card-text">
                    Contact Number: <?php echo $_POST['phone']; ?>
                </p>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
<?php require_once 'includes/footer.php'; ?>