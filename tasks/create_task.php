<?php
    require_once __DIR__ . '/../db.php';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $task_description = $_POST['task_description'];
        $task_date = $_POST['task_date'];
        $task_group = $_POST['task_group'];

        if ($task_date == ''){
            $add_query = "insert into tasks (task_description, group_id, completed) values ('$task_description', $task_group, 0);";
        }
        else{
            $add_query = "insert into tasks (task_description, due_date, group_id, completed) values ('$task_description', '$task_date', $task_group, 0);";
        }
        $result = pg_query($db, $add_query);

        pg_close($db);
        header("location: ../todo.php");
    }

    pg_close($db);
?>