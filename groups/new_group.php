<?php
    require_once __DIR__ . '/../db.php';
    session_start();
    
    $userid = $_SESSION['login_user'][1];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $new_group_name = $_POST['new_group_name'];

        $add_query = "insert into groups (group_name, admin_user_id) values ('$new_group_name', '$userid');";
        pg_query($db, $add_query);

        $new_group_id = pg_last_oid($db);

        echo $new_group_id;

        $add_query = "insert into users_groups (group_id, user_id) values ('$new_group_id', '$userid');";
        pg_query($db, $add_query);
        pg_close($db);
        header("location: ../todo.php");
    }
    pg_close($db);
?>