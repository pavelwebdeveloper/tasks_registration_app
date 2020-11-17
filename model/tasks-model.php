<?php

function addTask($doerName, $taskName, $taskDescription, $taskStartDate, $taskFinishDate, $eMail) {
       // Create a connection object using the tasks_registration connection function
       $db = tasks_registrationConnect();
       // The SQL statement
       $sql = 'INSERT INTO tasks (doerName, taskName, taskDescription, taskStartDate, taskFinishDate, eMail) VALUES (:doerName, :taskName, :taskDescription, :taskStartDate, :taskFinishDate, :eMail)';
       // The next line creates the prepared statement using the acme connection
       $stmt = $db->prepare($sql);
       // The next four lines replace the placeholders in the SQL
       // statement with the actual values in the variables
       // and tell the database the type of data it is
       $stmt->bindValue(':doerName', $doerName, PDO::PARAM_STR);
       $stmt->bindValue(':taskName', $taskName, PDO::PARAM_STR);
       $stmt->bindValue(':taskDescription', $taskDescription, PDO::PARAM_STR);
       $stmt->bindValue(':taskStartDate', $taskStartDate, PDO::PARAM_STR);
       $stmt->bindValue(':taskFinishDate', $taskFinishDate, PDO::PARAM_STR);
       $stmt->bindValue(':eMail', $eMail, PDO::PARAM_STR);
       // Insert the data
       $stmt->execute();
       // Ask how many rows changed as a result of our insert
       $rowsChanged = $stmt->rowCount();
       // Ask how many rows changed as a result of our insert
       $stmt->closeCursor();
       // Return the indication of success (rows changed)
       return $rowsChanged;
}

function getAllTasks(){
      // Create a connection object using the tasks_registration connection function
      $db = tasks_registrationConnect();
      // The SQL statement
      $sql = 'SELECT * FROM tasks';
      // The next line creates the prepared statement using the acme connection
      $stmt = $db->prepare($sql);
       $stmt->execute();
       $tasks = $stmt->fetchall(PDO::FETCH_ASSOC);
       $stmt->closeCursor();
       return $tasks;
}

function deleteTask($taskId) {
       // Create a connection object using the tasks_registration connection function
       $db = tasks_registrationConnect();
       // The SQL statement
       $sql = 'DELETE FROM tasks WHERE taskId = :taskId';
       // The next line creates the prepared statement using the acme connection
       $stmt = $db->prepare($sql);
       // The next line replaces the placeholder in the SQL
       // statement with the actual value in the variable
       // and tells the database the type of data it is
      $stmt->bindValue(':taskId', $taskId, PDO::PARAM_INT);
       // Delete the data
       $stmt->execute();
       // Ask how many rows changed as a result of our delete
       $rowsChanged = $stmt->rowCount();
       // Ask how many rows changed as a result of our delete
       $stmt->closeCursor();
       // Return the indication of success (rows changed)
       return $rowsChanged;
}

function sortColumn($sortColumn, $sortOrder) {
         // Create a connection object using the tasks_registration connection function
         $db = tasks_registrationConnect();
         // The SQL statement
         if($sortColumn == "taskStartDate" && $sortOrder == "asc"){
         $sql = 'SELECT * FROM tasks ORDER BY taskStartDate ASC';
         } elseif ($sortColumn == "taskStartDate" && $sortOrder == "desc"){
          $sql = 'SELECT * FROM tasks ORDER BY taskStartDate DESC';
         } elseif ($sortColumn == "taskFinishDate" && $sortOrder == "asc"){
         $sql = 'SELECT * FROM tasks ORDER BY taskFinishDate ASC';
         } elseif ($sortColumn == "taskFinishDate" && $sortOrder == "desc"){
          $sql = 'SELECT * FROM tasks ORDER BY taskFinishDate DESC';
         }
         // The next line creates the prepared statement using the acme connection
         $stmt = $db->prepare($sql);
           $stmt->execute();
          $tasks = $stmt->fetchall(PDO::FETCH_ASSOC);
          $stmt->closeCursor();
          return $tasks;
}

function searchTasks($searchValue){
         // Create a connection object using the tasks_registration connection function
         $db = tasks_registrationConnect();
         // The SQL statement
         $sql = "SELECT * FROM tasks WHERE doerName LIKE :searchValue OR taskName LIKE :searchValue";
         // The next line creates the prepared statement using the acme connection
         $stmt = $db->prepare($sql);
         $searchValue = "%{$searchValue}%";
         $stmt->bindValue(':searchValue', $searchValue, PDO::PARAM_STR);
         $stmt->execute();
         $tasks = $stmt->fetchall(PDO::FETCH_ASSOC);
         $stmt->closeCursor();
         return $tasks;
}