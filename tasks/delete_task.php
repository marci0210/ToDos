<?php
    require_once __DIR__ . '/../db.php';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $delete_task_id = $_POST['button'];

        $delete_tasks_query = "delete from tasks where task_id = '$delete_task_id'";
        $result = pg_query($db, $delete_tasks_query);

        pg_close($db);
        header("location: ../todo.php");
    }
?>