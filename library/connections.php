<?php

/* 
 * Database connections
 */
function tasks_registrationConnect() {
$server = "localhost";
$database = "tasks_registration";
$user = "proxyClient";
$password = "iMi20GYnzHXRrJ9B";
$dsn = 'mysql:host=' . $server . ';dbname=' . $database;
$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
// Create the actual connection object and assign it to a variable
try {
 $tasks_registrationLink = new PDO($dsn, $user, $password, $options);
 /* echo '$acmeLink worked successfully<br>';*/
 return $tasks_registrationLink;
} catch (PDOException $exc) {
 header('location: /tasks_registration_app/views/500.php');
 exit;
}
}

tasks_registrationConnect();