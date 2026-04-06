<?php
    require_once __DIR__ . '/../db.php';

    $q = $_GET['q'];

    $query="SELECT users.user_id FROM users 
        where users.email = '$q'";

    $result = pg_query($db, $query);

    if(pg_num_rows($result) == 0){
        echo  "0";
    }
    else if(pg_num_rows($result) == 1){
        echo  "1";
    }

    pg_close($db);
?>