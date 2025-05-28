<?php
    require_once __DIR__ . '/../db.php';
    session_start();
    
    $userid = $_SESSION['login_user'][1];

    $q = intval($_GET['q']);

    $query="SELECT users.username, users.user_id, groups.admin_user_id FROM groups 
        inner join users_groups on groups.group_id = users_groups.group_id
        inner join users on users_groups.user_id = users.user_id
        where groups.group_id = '$q' and users.user_id != '$userid'";

    $result = pg_query($db, $query);

    if(pg_num_rows($result) == 0){
        echo "<p>You haven't added anyone yet.</p>";
    }
    else{
        while($row = pg_fetch_array($result)) {
            echo '<div class="added_users">';
            echo '<div class="dv"><p>'. $row['username'] .'</p></div>';
            

            if($userid == $row["admin_user_id"]){
                echo '<button style="background-color: white; color: black" type="submit" class="button" name="button" value="' . $row["user_id"] . '">';
                echo '<span class="material-icons" style="color: black">person_remove</span></button>';
            }

            echo '</div>';
        }
    } 
?>