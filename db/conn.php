<?php 
    // PDO - secyrity type of driver as MySQL but more secure
    // PDO = PHP Data Objects

    // Development connection
    // $host = 'localhost';
    $host = '127.0.0.1';
    $db = 'attendance_db';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    /*
    // Remote Database connection
    $host = 'pdb51.zettahost.bg';
    $db = '3927471_attendance';
    $user = '3927471_attendance';
    $pass = 'attendee345';
    $charset = 'utf8mb4';
    */

    // dsn = data source name
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset;";

    //Try catch statement = with "try" attempt connection and if there is no problem - connect to database; if there is an error -> with "catch" show the error
    try{
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Hello, Database!';
    } catch(PDOException $e) {
        // throw = stop all execution and show the error stored in object $e
        throw new PDOException($e->getMessage());
        // echo "<h1 class='text-danger'>No Database Found.</h1>";
    };

    require_once 'crud.php';
    require_once 'user.php';
    // Define a new class with name crud which is stored in object $crud
    $crud = new crud($pdo);
    $user = new user($pdo);

    $user->insertUser("admin", "password");
?>