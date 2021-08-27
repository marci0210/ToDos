<?php
    include("config.php");
    session_start();

    $userid = $_SESSION['login_user'][1];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $bckc = $_POST["bcgc"];
        $c = $_POST["c"];


        $update_query = "update settings 
        set background_color = '$bckc', font_color = '$c' 
        where user_id = '$userid'; ";
        mysqli_query($db, $update_query);

        setcookie("font_color", $c);
        setcookie("background_color", $bckc);

        mysqli_close($db);
        header("location: todo.php");
    }

    mysqli_close($db);
?>