<?php
    require_once __DIR__ . '/../db.php';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $task_id = $_POST['button'];

        $first_query = "select completed from tasks where task_id = $task_id;";
        $result = pg_query($db, $first_query);
        $row = pg_fetch_assoc($result);

        if($row["completed"] == 0 )
        {
            $update_tasks_query = "update tasks set completed = 1 where task_id = '$task_id';";
            pg_query($db, $update_tasks_query);
        }
        else{
            $update_tasks_query = "update tasks set completed = 0 where task_id = '$task_id';";
            pg_query($db, $update_tasks_query);
        }
        pg_close($db);
        header("location: ../todo.php");
    }
    pg_close($db);
?>