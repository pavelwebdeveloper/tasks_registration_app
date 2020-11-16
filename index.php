<?php

/* This is the Tasks Registration Controller*/



    

 // Get the database connection file
require_once 'library/connections.php';
require_once 'library/functions.php'; 
  require_once 'model/tasks-model.php';
  
  
  


 
  
  
 

  
   
 $action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
  $message = "";
 switch ($action){
  
  case 'sortColumn':
     
   $column =$_GET['column'];
   $sortOrder =$_GET['sortOrder'];
   
   $tasks = sortColumn($column, $sortOrder);
   $tasksTable = buildTaskTable($tasks);
         
   echo $tasksTable;
         
    exit;
    
    case 'search':
     
     $searchValue =$_GET['searchValue'];
   
     
     $tasks = searchTasks($searchValue);
   $tasksTable = buildTaskTable($tasks);
         
   echo $tasksTable;
         
    exit;
    
 case 'register':
   
   //echo var_dump($_GET);
   
   
   // Filter and store the data
   /*
   $doerName = filter_input(INPUT_POST, 'doerName', FILTER_SANITIZE_STRING);
   $taskName = filter_input(INPUT_POST, 'taskName', FILTER_SANITIZE_STRING);
   $taskDescription = filter_input(INPUT_POST, 'taskDescription', FILTER_SANITIZE_STRING);
   $taskStartDate = date("d.m.Y");
   $taskFinishDate = filter_input(INPUT_POST, 'datepicker', FILTER_SANITIZE_STRING);
   $eMail = filter_input(INPUT_POST, 'eMail', FILTER_SANITIZE_EMAIL);
   */
   /*
   echo var_dump($doerName);
   echo var_dump($taskName);
   echo var_dump($taskDescription);
   echo var_dump($taskStartDate);
   echo var_dump($taskFinishDate);
   echo var_dump($eMail);
   
   echo var_dump($_POST['taskFinishDate']);
   echo var_dump($_POST['eMail']);
    * *
    */
   /*
  
    * /
    */
   // Filter and store the data
   $doerName =$_GET['doerName'];
   $taskName = $_GET['taskName'];
   $taskDescription = $_GET['taskDescription'];
   if(strlen($taskDescription)>1000){
    $message = '<p>Описание задачи не должно содержать более 1000 символов.</p>';
    $tasks = getAllTasks();
   
   
    $tasksTable = $message . "<br>" . "<br>" . buildTaskTable($tasks);
   
   echo $tasksTable;
    exit;
   }
   $taskStartDate = date("d.m.Y");
   $taskFinishDate = $_GET['taskFinishDate'];
   $taskFinishDate = str_replace("/", ".", $taskFinishDate);
   $eMail = $_GET['eMail'];
    
   
  // Check for missing data
   if(empty($doerName) || empty($taskName) || empty($taskDescription) || empty($taskFinishDate) || empty($eMail)){
    $message = '<p>Please, provide information correctly for all form fields.</p>';
    $tasks = getAllTasks();
   
   
    $tasksTable = $message . "<br>" . "<br>" . buildTaskTable($tasks);
   
   echo $tasksTable;
    exit;
   }
   
   // Send the data to the model
   $regOutcome = addTask($doerName, $taskName, $taskDescription, $taskStartDate, $taskFinishDate, $eMail);
   
   $message = "";
   $tasks = getAllTasks();
   
   
    $tasksTable = buildTaskTable($tasks);
   
   echo $tasksTable;
      
    exit;
   
    // Check and report the result and create the cookie when the individual registers with the site
   /*
   if($regOutcome === 1){
    $message = "<p>Thanks for registering the task $taskName. The task is registered. A message has been sent to $eMail</p>";
    //header('Location: /phpprojects/tasks_registration_app/views/tasks-list.php');
    include 'views/tasks-list.php';
   exit;
   } else {
    $message = "<p>Sorry, but the registration of the task $taskName failed. Please, try again.</p>";
            include 'views/tasks-list.php';
    exit;
   }
    * *
    */
   
   
   /*
   $valuteID = $_GET['valuteID'];
   $dateFrom = $_GET['dateFrom'];
   
   $dateTo = $_GET['dateTo'];
   
    
   
   $dateFrom = strtotime($dateFrom);
    $dateFrom = (string)$dateFrom;
    $dateFrom = (int)$dateFrom;
    $dateTo = strtotime($dateTo);
     $dateTo = (string)$dateTo;
     $dateTo = (int)$dateTo;
    
    
   
   $tasksTable = buildTaskTable(getAllTasks());
  
    include 'views/tasks-list.php';
    *
    */
   
   
  /*case 'tasksTable':
   
   $message = "";
   $tasks = getAllTasks();
   
   
    $tasksTable = buildTaskTable($tasks);
   
   include __DIR__ . '/views/tasks_table.php';
  // ob_start();
  //include 'views/tasks-list.php';
   //$output = ob_get_clean();
   //include 'views/tasks-list.php';
   
   //include __DIR__ . '/views/tasks_table.php';
    
   break;*/
    
    case 'delete':
     
     $taskId =$_GET['taskId'];
     
     $deleteOutcome = deleteTask($taskId);
     
     $message = "";
   $tasks = getAllTasks();
   
   
    $tasksTable = buildTaskTable($tasks);
   
   echo $tasksTable;
      
    exit;
   
  default:
      //echo var_dump($date);
   //$tasksTable = buildTaskTable(getAllTasks());
  
   $message = "";
   $tasks = getAllTasks();
   $tasksTable = buildTaskTable($tasks);
  include 'views/tasks-list.php';
   
   
 }

