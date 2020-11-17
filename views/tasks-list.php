<!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Tasks</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <style>
        table {
          border-collapse: collapse;
          border-spacing: 0;
          width: 100%;
          border: 1px solid #ddd;
        }

        th, td {
          text-align: center;
          width: 150px;
          padding: 16px;
        }

        tr:nth-child(even) {
          background-color: #f2f2f2;
        }

        input#searchInput{
         width: 300px;
        }
  </style>
  <script>
         $(function() {
           $( "#datepicker" ).datepicker();
         }); 


          $(function() { 
                $("#sortTaskFinishDate").click(function(){
                 var column = "taskFinishDate";
                 sortColumn(column);
              });
           });

           $(function() { 
                $("#sortTaskStartDate").click(function(){
                var column = "taskStartDate";
                sortColumn(column);
              });
           });
    
    
           function sortColumn(column){

              var sortOrder = $("#sort").val();
              var xmlhttp = new XMLHttpRequest();

              xmlhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
                try {

                  var obj = JSON.parse(xmlhttp.responseText);
                  document.getElementById("message").innerHTML = obj[0];
                  document.getElementById("tasks").innerHTML = obj[1];

              } catch (error) {
                  throw Error;
              }

              if(sortOrder == "asc"){
                 $("#sort").val("desc");
             }else{
                 $("#sort").val("asc");
                  }
                }
              };
                xmlhttp.open("GET", "/phpprojects/tasks_registration_app/index.php?action=sortColumn&column="+column +"&sortOrder="+sortOrder, true);
                xmlhttp.send();
                 }
   
  </script>
 </head>
 <body>
  
  <main id="main">
    <div class="container">
    <div class="jumbotron">
      
   
         <p id="rp">Все поля обязательны.</p>
         <label for="doerName">ФИО исполнителя</label>
         <input type="text" name="doerName" id="doerName" pattern="[A-Za-z]{2,}" <?php if(isset($doerName)){echo "value='$doerName'";} ?>  required>
         <label for="eMail">E-mail</label>
         <input type="eMail" name="eMail" id="eMail" placeholder="someone@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.]+\.[a-z]{2,}$" <?php if(isset($eMail)){echo "value='$eMail'";} ?> required>
         <p><label for="datepicker">дата завершения задачи:</label> <input type="text" name="datepicker" id="datepicker"></p>
         <label for="taskName">название задачи</label>
         <input type="text" name="taskName" id="taskName" pattern="[A-Za-z]{2,}" <?php if(isset($taskName)){echo "value='$taskName'";} ?>  required>
         <label>описание задачи</label>
         <textarea name="taskDescription" id="taskDescription" rows="10" cols="43" placeholder="Пожалуйста, опишите новую задачу" required><?php if(isset($taskDescription)) {echo "$taskDescription";} ?></textarea>
         <button class="submitBtn" name="submit" type="submit" value="Register" onclick="getTasks()">Register</button>
         <p id="message"></p>
        
     </div>
     </div>
   
   </main>
  
     <div id="dataArea">
     <input type="text" id="searchInput" onkeyup="searchTasks()" placeholder="Search for person or task names.." title="Type in a name">
      <input type="hidden" id="sort" value="asc"><table>
      <thead>
      <tr><th>ФИО исполнителя</th><th>название задачи</th><th id='sortTaskStartDate'>дата создания задачи</th><th  id='sortTaskFinishDate'>дата завершения задачи</th><th>описание задачи</th><th></th></tr>
      </thead></table><div id="tasks"><?php   echo $tasksTable;  ?></div>
      </div>
  
  <script>
   

  function getTasks() {
   
       var action = "register";
       var doerName = document.getElementById("doerName").value;
       var eMail = document.getElementById("eMail").value;
       var taskFinishDate = document.getElementById("datepicker").value;
       var taskName = document.getElementById("taskName").value;
       var taskDescription = document.getElementById("taskDescription").value;  
 
       var xmlhttp = new XMLHttpRequest();
        formOutput(xmlhttp);
        
        xmlhttp.open("GET", "/phpprojects/tasks_registration_app/index.php?action="+action +"&doerName="+doerName+"&eMail="+eMail+"&taskFinishDate="+taskFinishDate+"&taskName="+taskName+"&taskDescription="+taskDescription, true);
        xmlhttp.send();
   
    }
    
    function deleteTask(taskId) {
   
          var action = "delete";
 
 
         var xmlhttp = new XMLHttpRequest();
          formOutput(xmlhttp);
         
         xmlhttp.open("GET", "/phpprojects/tasks_registration_app/index.php?action="+action +"&taskId="+taskId, true);
         xmlhttp.send();
         }   
   
   function searchTasks() {
   
       var action = "search";
       var searchValue = document.getElementById("searchInput").value;
 
       var xmlhttp = new XMLHttpRequest();
       formOutput(xmlhttp);
       
         xmlhttp.open("GET", "/phpprojects/tasks_registration_app/index.php?action="+action +"&searchValue="+searchValue, true);
         xmlhttp.send();
         }  
         
         function formOutput(xmlhttp){
          xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
              try {
                var obj = JSON.parse(xmlhttp.responseText);
               document.getElementById("message").innerHTML = obj[0];
               document.getElementById("tasks").innerHTML = obj[1];

            } catch (error) {
                throw Error;
            } 
           }
         };
         }
</script>
  
 </body>
</html>



