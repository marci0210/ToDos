<?php
    include("../config.php");

    $q = $_GET['q'];

    $query="SELECT users.user_id FROM users 
        where users.email = '$q'";

    $result = mysqli_query($db, $query);

    if(mysqli_num_rows($result) == 0){
        echo  "0";
    }
    else if(mysqli_num_rows($result) == 1){
        echo  "1";
    }

    mysqli_close($db);
?>