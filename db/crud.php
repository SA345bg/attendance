<?php 
    // CRUD = Create, Read, Update, Delete

    class crud{
        // Private database object
        private $db;

        // Constructor to initialize private variable to the database connection
        function __construct($conn) {
            $this->db = $conn;
        }
        // NO ; after!!!

        // Function which is waiting for to insert a new record from $_POST['...'] in success-page into attendee database
        // public = admin cam interact with users; private - only for admin CRUD-actions; parameters can be with different names from db-parameters, i. e. $fname, $lname, $dob, ...
        public function insertAttendees($fname, $lname, $dob, $specialty, $email, $contact) {
            try {
                // Define sql-statement to be executed; each data row /needed to be the SAME names as in db/ must be EXACTLY one after other as in table attendee /begin after PRIMARY row, i. e. firstname, lastname, dateofbirth, specialty_id, emailaddress, contactnumber/; :placeholder, i. e. :fname, :lname, :dob, ... - also must be ordered as above
                $sql = "INSERT INTO attendee(firstname, lastname, dateofbirth, specialty_id, emailaddress, contactnumber) VALUES (:fname, :lname, :dob, :specialty, :email, :contact)";
                // stmt = statement
                // Prepare the sql-statement for execution
                $stmt = $this->db->prepare($sql);

                //Bind parameters = replace ':fname' with $fname
                // Bind all placeholders to the actual values
                $stmt->bindparam(':fname',$fname);
                $stmt->bindparam(':lname',$lname);
                $stmt->bindparam(':dob',$dob);
                $stmt->bindparam(':specialty',$specialty);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':contact',$contact);

                // Execute statement
                $stmt->execute();
                return true;

            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function editAttendee($id, $fname, $lname, $dob, $specialty, $email, $contact) {
            try {
                // Skip `attendee_id`='[value-1]', i. e. don't need to change `attendee_id`] `` - not single quotes '' but ``, i. e. apostrophies!!! 
                $sql = "UPDATE `attendee` SET `firstname`=:fname,`lastname`=:lname,`dateofbirth`=:dob,`specialty_id`=:specialty,`emailaddress`=:email,`contactnumber`=:contact WHERE `attendee_id`=:id ";
                
                // Prepare the sql-statement for execution
                $stmt = $this->db->prepare($sql);

                //Bind parameters = replace ':fname' with $fname
                // Bind all placeholders to the actual values
                $stmt->bindparam(':id',$id);
                $stmt->bindparam(':fname',$fname);
                $stmt->bindparam(':lname',$lname);
                $stmt->bindparam(':dob',$dob);
                $stmt->bindparam(':specialty',$specialty);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':contact',$contact);

                // Execute statement
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }

        }

        // View records; a = attendee; s = specialties
        public function getAttendees() {
            try {
                $sql = "SELECT * FROM `attendee` a inner join specialties s on a.specialty_id = s.specialty_id";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            
        }

        public function getAttendeeDetails($id) {
            try {
                $sql = "select * from attendee a inner join specialties s on a.specialty_id = s.specialty_id where attendee_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }

        }

        public function deleteAttendee($id) {
            try {
                $sql = "delete from attendee where attendee_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id', $id);
                $stmt->execute();
                return true;

            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }

        }

        public function getSpecialties() {
            try {
                $sql = "SELECT * FROM `specialties`";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            
        }

    }

?>