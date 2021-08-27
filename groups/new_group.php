<?php
    include("../config.php");
    session_start();
    
    $userid = $_SESSION['login_user'][1];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $new_group_name = $_POST['new_group_name'];

        $add_query = "insert into groups (group_name, admin_user_id) values ('$new_group_name', '$userid');";
        mysqli_query($db, $add_query);

        $new_group_id = mysqli_insert_id($db);

        echo $new_group_id;

        $add_query = "insert into users_groups (group_id, user_id) values ('$new_group_id', '$userid');";
        mysqli_query($db, $add_query);
        mysqli_close($db);
        header("location: ../todo.php");
    }
    mysqli_close($db);
?>