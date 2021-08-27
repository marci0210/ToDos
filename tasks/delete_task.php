<?php
    include("../config.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $delete_task_id = $_POST['button'];

        $delete_tasks_query = "delete from tasks where task_id = '$delete_task_id'";
        $result = mysqli_query($db, $delete_tasks_query);

        mysqli_close($db);
        header("location: ../todo.php");
    }
?>