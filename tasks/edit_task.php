<?php
    require_once __DIR__ . '/../db.php';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $task_description = $_POST['task_description'];
        $task_date = $_POST['task_date'];
        $task_group = $_POST['task_group'];
        $task_id = $_POST['sub'];

        if ($task_date == ''){
            $edit_query = "update tasks set 
                task_description = '$task_description' , 
                group_id =  $task_group 
                where task_id = $task_id ;";

            mysqli_query($db, $edit_query);
        }
        else{
            $edit_query = "update tasks set 
                task_description = '$task_description', 
                group_id = $task_group  ,
                due_date =  '$task_date'  
                where task_id =  $task_id  ;";
            mysqli_query($db, $edit_query);
        }
        mysqli_close($db);
        header("location: ../todo.php");
    }
    mysqli_close($db);
    
?>