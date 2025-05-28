<?php
    require_once __DIR__ . '/../db.php';
    session_start();
    
    $userid = $_SESSION['login_user'][1];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $delete_group_id = $_POST['button'];

        $a = "delete from tasks where group_id = '$delete_group_id';";
        $b = "delete from groups where group_id = '$delete_group_id';";
        $c = "delete from users_groups where group_id = '$delete_group_id';";
        pg_query($db, $a);
        pg_query($db, $c);
        pg_query($db, $b);
        pg_close($db);
        header("location: ../todo.php");
    }
    pg_close($db);
?>