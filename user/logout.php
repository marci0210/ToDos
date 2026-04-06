<?php
    require_once __DIR__ . '/../db.php';
    session_start();

    pg_close($db);

    if(session_destroy()){
        header("Location: ../index.php");
    }
?>