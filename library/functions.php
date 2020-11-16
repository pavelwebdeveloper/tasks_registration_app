<?php

// a library of custom functions for tasks registration



// the function to build the task table

function buildTaskTable($tasks){
 // Build the tasks table using the $tasks array
 if(count($tasks) > 0){
   
  /*
    $tasksTable = '<input type="hidden" id="sort" value="asc"><table class="table table-hover">';
    $tasksTable .= '<thead>';
    $tasksTable .= "<tr><th>ФИО исполнителя</th><th>название задачи</th><th id='sortTaskStartDate'>дата создания задачи</th><th  id='sortTaskFinishDate'>дата завершения задачи</th><th>описание задачи</th><th></th></tr>";
    $tasksTable .= '</thead>';
   * 
   */
    $tasksTable = "<table><tbody>";
    foreach ($tasks as $task) {
     $tasksTable .= "<tr><td>$task[doerName]</td>";
     $tasksTable .= "<td>$task[taskName]</td>";
     $tasksTable .= "<td>$task[taskStartDate]</td>";
     $tasksTable .= "<td>$task[taskFinishDate]</td>";
     $tasksTable .= "<td>$task[taskDescription]</td>";
     $tasksTable .= "<td><a class='tablelink' onclick='deleteTask($task[taskId])'>Delete</a></td></tr>";
    }
    $tasksTable .= "</tbody></table>";
    return $tasksTable;
     
   } else {
    $tasksTable = '<p>Sorry, no tasks were found.</p>';
    return $tasksTable;
   }   
}

function sortTable($g){
 
}

