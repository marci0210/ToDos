<?php
    $userid = $_SESSION['login_user'][1];

    $sql_tasks = "select tasks.task_id, tasks.task_description, tasks.due_date, groups.group_id, groups.group_name, tasks.completed from tasks
	                inner join groups on groups.group_id = tasks.group_id
                    inner join users_groups on users_groups.group_id = groups.group_id
                    inner join users on users_groups.user_id = users.user_id
                    where users.user_id = '$userid' and tasks.completed=1
                    order by tasks.due_date is null, tasks.due_date asc, groups.group_name, tasks.task_description;";

    $tasks = pg_query($db, $sql_tasks);

    while($row = pg_fetch_assoc($tasks)) {
        $task_id = $row["task_id"];
        echo '<li class="e">';

        echo '<p id="gi_' . $task_id . '" style="display: none">' . $row["group_id"] . '</p>';
        echo '<p class="task_top">' . $row["group_name"] . '</p>';
        echo '<p id="td_' . $task_id . '" class="task_date">' . $row["due_date"] . '</p>';

        /*echo '<p class="task_top" style="margin-top: 10px">' . $row["group_name"] . '</p>';
        echo '<p id="td_' . $task_id . '" class="task_top" style="margin-bottom: 10px">' . $row["due_date"] . '</p>';*/

        echo '<div class="c">';
        echo '<p id="tde_' .$task_id . '">'. $row["task_description"] . '</p>';
        echo '</div>';

        echo '<div class="d">';

        echo '<form method="post" action="tasks/complete_task.php" class="input" id="mp_input">';
        if($row["completed"] == 0){
            echo '<button  type="submit" class="button" id="button" name="button" value="' . $task_id . '""><span
            class="material-icons-outlined" id="mp">circle</span></button></form>';
        }
        else{
            echo '<button type="submit" class="button" id="button" name="button" value="' . $task_id . '""><span
            class="material-icons-outlined" id="mp">check_circle</span></button></form>';
        }

        echo '<div class="input" id="mp_input">';
        echo '<button onclick="modify_task(this.value)" class="button" id="button" name="button" value="' . $task_id . '""><span
            class="material-icons" id="mp">mode_edit</span></button></div>';

        echo '<form method="post" action="tasks/delete_task.php" class="input" id="mp_input">';
        echo '<button type="submit" class="button" id="button" name="button" value="' . $task_id . '"><span
            class="material-icons" id="mp">delete_outline</span></button></form></div></li>';
    }

?>