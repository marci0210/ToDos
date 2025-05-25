<?php
    require_once __DIR__ . '/../db.php';
    session_start();
    
    $userid = $_SESSION['login_user'][1];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $delete_group_id = $_POST['button'];

        $a = "delete from tasks where group_id = '$delete_group_id';";
        $b = "delete from groups where group_id = '$delete_group_id';";
        $c = "delete from users_groups where group_id = '$delete_group_id';";
        mysqli_query($db, $a);
        mysqli_query($db, $c);
        mysqli_query($db, $b);
        mysqli_close($db);
        header("location: ../todo.php");
    }
    mysqli_close($db);
?>