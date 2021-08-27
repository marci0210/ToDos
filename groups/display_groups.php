<?php  
    $userid = $_SESSION['login_user'][1];

    $sql_groups = "select groups.group_id, groups.group_name, groups.admin_user_id from groups
        inner join users_groups on users_groups.group_id = groups.group_id
        inner join users on users.user_id = users_groups.user_id
        where users.user_id = '$userid';";


    $groups = mysqli_query($db, $sql_groups);

    while($row = $groups->fetch_assoc()) {
        echo '<li style="width: 100%">';

        echo '<a href="#" id="' . $row["group_id"] . '" onclick="group_filter(this.id)">';
        echo '<div class="a" style="margin: 20px; margin-top: 0;">';
        echo '<span class="material-icons">article</span>';

        echo '<div class="dv">';
        echo "<p>" . $row["group_name"]. "</p>";
        echo '</div>';
        if($row["admin_user_id"] == $userid){
            echo '<form method="post" action="groups/delete_group.php" class="input">';
            echo '<button type="submit" class="button" name="button" value="' . $row["group_id"] . '">
            <span class="material-icons">delete_outline</span></button>';
            echo '</form>';
        }
        else{
            echo '<form method="post" action="groups/leave_group.php" class="input">';
            echo '<button type="submit" class="button" name="button" value="' . $row["group_id"] . '">
            <span class="material-icons">exit_to_app</span></button>';
            echo '</form>';
        }
        
        
        echo '</div></a></li>';
    }
?>