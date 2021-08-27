<?php
    include("../config.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $task_id = $_POST['button'];

        $first_query = "select completed from tasks where task_id = $task_id;";
        $result = mysqli_query($db, $first_query);
        $row = $result->fetch_assoc();

        if($row["completed"] == 0 )
        {
            $update_tasks_query = "update tasks set completed = 1 where task_id = '$task_id';";
            mysqli_query($db, $update_tasks_query);
        }
        else{
            $update_tasks_query = "update tasks set completed = 0 where task_id = '$task_id';";
            mysqli_query($db, $update_tasks_query);
        }
        mysqli_close($db);
        header("location: ../todo.php");
    }
    mysqli_close($db);
?>