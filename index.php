<?php

/* This is the Tasks Registration Controller*/

 // Get the database connection file
require_once 'library/connections.php';
// Get the custom functions file
 require_once 'library/functions.php'; 
//Get the database query functions file
 require_once 'model/tasks-model.php';
  
     
 $action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
   
 switch ($action){
  
   case 'sortColumn':
    
          // Get the input values
          $column =$_GET['column'];
          $sortOrder =$_GET['sortOrder'];


          $tasks = sortColumn($column, $sortOrder);
          $tasksTable = buildTaskTable($tasks);

          $message = "";

          // forming the output for the front end
          formingOutput($message, $tasksTable);
      
   case 'search':
     
          $searchValue =$_GET['searchValue'];


          $tasks = searchTasks($searchValue);
          $tasksTable = buildTaskTable($tasks);

          $message = "";
          
          // forming the output for the front end
          formingOutput($message, $tasksTable);
    
   case 'register':
      
          // Get the input values and check the input
          $doerName =$_GET['doerName'];
          $doerNameCheckResult = checkDoerName($_GET['doerName']);
          if($doerNameCheckResult == 1){
           $doerName =$_GET['doerName'];  
          } else {
           $message = '<p>Неправильный формат имени.</p>';
           $tasks = getAllTasks();  

           $tasksTable = buildTaskTable($tasks);

           formingOutput($message, $tasksTable);
          }
          $taskName = $_GET['taskName'];
          $taskDescription = $_GET['taskDescription'];
          if(strlen($taskDescription)>1000){
           $message = '<p>Описание задачи не должно содержать более 1000 символов.</p>';
           $tasks = getAllTasks();  

           $tasksTable = buildTaskTable($tasks);

           formingOutput($message, $tasksTable);
          }
          $taskStartDate = date("d.m.Y");
          $taskFinishDate = $_GET['taskFinishDate'];
          $taskFinishDate = str_replace("/", ".", $taskFinishDate);
          $emailCheckResult = filter_var($_GET['eMail'], FILTER_VALIDATE_EMAIL);
          if(!$emailCheckResult){
           $message = '<p>Неправильный формат электронного адреса.</p>';
           $tasks = getAllTasks();  

           $tasksTable = buildTaskTable($tasks);

           formingOutput($message, $tasksTable);
          } else {
           $eMail = $_GET['eMail'];
          }

           // Sending the email message
           //$subject = 'task registered';
           //$message = "You have successfully added a task for ".$doerName;
           //$headers = 'From: noreply @ company . com';
           //$messageSent = mail('pavel.v.shvets@gmail.com',$subject,$message);


         // Check for missing data
         if(empty($doerName) || empty($taskName) || empty($taskDescription) || empty($taskFinishDate) || empty($eMail)){
                $message = '<p>Пожалуйста, заполните все поля ввода.</p>';
                $tasks = getAllTasks();

                $tasksTable = buildTaskTable($tasks);
                
                // forming the output for the front end
                formingOutput($message, $tasksTable);
          }

          // Send the data to the model and get the outcome
          $regOutcome = addTask($doerName, $taskName, $taskDescription, $taskStartDate, $taskFinishDate, $eMail);



          $message = "Поздравляем !! Вы успешно добавили задачу для ".$doerName;
          
          $tasks = getAllTasks();


           $tasksTable = buildTaskTable($tasks);
           
           // forming the output for the front end
           formingOutput($message, $tasksTable);
       
    case 'delete':
     
          $taskId =$_GET['taskId'];

          $deleteOutcome = deleteTask($taskId);

          $message = "Поздравляем !! Вы успешно удалили задачу";
          $tasks = getAllTasks();

          $tasksTable = buildTaskTable($tasks);
          
          // forming the output for the front end
          formingOutput($message, $tasksTable);
   
   default:
       

          $message = "";
          $tasks = getAllTasks();
          $tasksTable = buildTaskTable($tasks);
          include 'views/tasks-list.php';
   
   
 }

