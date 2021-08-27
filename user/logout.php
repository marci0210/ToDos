<?php
    include("../config.php");
    session_start();

    mysqli_close($db);

    if(session_destroy()){
        header("Location: ../index.php");
    }
?>