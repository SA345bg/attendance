<?php 
    class user{
        // Private database object
        private $db;

        // Constructor to initialize private variable to the database connection
        function __construct($conn) {
            $this->db = $conn;
        }
        // NO ; after!!!

        public function insertUser($username, $password) {
            try {
                // Check new username in database to be unique, i. e. isn't exists before
                $result = $this->getUserbyUsername($username);
                // If $result['num'] > 0, i. e. is existing a user, than do nothing, otherwise do the code in {...}, i. e. proceed with user creation
                if($result['num'] > 0) {
                    return false;
                } else {
                    // A SALT = random piece of text = $username; md5() -> encrypt, i. e. hash data
                    $new_password = md5($password.$username); 
                    // Define sql-statement to be executed
                    $sql = "INSERT INTO users(username, password) VALUES (:username, :password)";
                    // stmt = statement
                    // Prepare the sql-statement for execution
                    $stmt = $this->db->prepare($sql);

                    //Bind parameters = replace ':fname' with $fname
                    // Bind all placeholders to the actual values
                    $stmt->bindparam(':username',$username);
                    $stmt->bindparam(':password',$new_password);
                
                    // Execute statement
                    $stmt->execute();
                    return true;
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getUser($username, $password) {
            try {
                $sql = "select * from users where username = :username AND password = :password";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':username', $username);
                $stmt->bindparam(':password', $password);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        // Get unique username for every user
        public function getUserbyUsername($username) {
            try {
                // Select star-count from column num from table users
                $sql = "select count(*) as num from users where username = :username";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':username', $username);
                
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

?>