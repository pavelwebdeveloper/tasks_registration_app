<?php

// a library of custom functions for tasks registration

// the function to build the task table
function buildTaskTable($tasks){
 
 // Build the tasks table using the $tasks array
 if(count($tasks) > 0){   
  
        $tasksTable = "<table><tbody>";
        foreach ($tasks as $task) {
         $tasksTable .= "<tr><td>$task[doerName]</td>";
         $tasksTable .= "<td>$task[taskName]</td>";
         $tasksTable .= "<td>$task[taskStartDate]</td>";
         $tasksTable .= "<td>$task[taskFinishDate]</td>";
         $tasksTable .= "<td>$task[taskDescription]</td>";
         $tasksTable .= "<td><a class='tablelink' onclick='deleteTask($task[taskId])'>Удалить задачу</a></td></tr>";
        }
        $tasksTable .= "</tbody></table>";
        return $tasksTable;

       } else {
        $tasksTable = '<p>Sorry, no tasks were found.</p>';
        return $tasksTable;
       }   
}

// the function to form the output for the frontend
function formingOutput($message, $tasksTable){
 
        $resultArray = array($message, $tasksTable);

        $result = json_encode($resultArray);

        echo $result;

        exit;
}

// the function to check the name
function checkDoerName($doerName) {
 $pattern = '/^[^0-9~!@#$%^&*()_+{}|:"<>?`=\-\[\];,\/№]+$/';
 return preg_match($pattern, $doerName); 
}

