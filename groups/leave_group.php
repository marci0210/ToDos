<?php
    require_once __DIR__ . '/../db.php';
    session_start();
    
    $userid = $_SESSION['login_user'][1];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $leave_group_id = $_POST['button'];

        $a = "delete from users_groups where group_id = '$leave_group_id' and user_id = '$userid';";
        mysqli_query($db, $a);
        mysqli_close($db);
        header("location: ../todo.php");
    }
    mysqli_close($db);
?>