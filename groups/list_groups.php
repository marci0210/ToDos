<?php   
    $userid = $_SESSION['login_user'][1];

    $sql_groups = "select groups.group_id, groups.group_name from groups
    inner join users_groups on users_groups.group_id = groups.group_id
    inner join users on users.user_id = users_groups.user_id
    where users.user_id = '$userid';";
    
    $groups = pg_query($db, $sql_groups);

    while($row = $groups->fetch_assoc()) {
        echo '<option class="dropdown" value="'.$row["group_id"].'">'.$row["group_name"]. '</option>';
    }
?>