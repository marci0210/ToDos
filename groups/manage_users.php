<?php
    require_once __DIR__ . '/../db.php';
    session_start();
    
    $userid = $_SESSION['login_user'][1];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $add_user_name = $_POST["new_user"];
        $kick_user_id = $_POST["button"];
        $group_id = $_POST["task_group"];

        if($kick_user_id == '0'){
            $help_query = "select user_id from users where username = '$add_user_name'";
            $res = pg_query($db, $help_query);

            //1.: Does the username is valid?
            $num = pg_num_rows($res);
            if($num == 0){
                //No, its not valid
                header("location: ../todo.php");
            }

            $row = pg_fetch_array($res);
            $user_id = $row["user_id"];

            //Does the username is in the group yet?
            $check_query = "select * from users_groups where user_id = '$user_id' and group_id = '$group_id'";
            $res = pg_query($db, $check_query);
            $num = pg_num_rows($res);
            if($num == 0){
                //No, its not.
                $query = "insert into users_groups (user_id, group_id) values ('$user_id', '$group_id')";
                pg_query($db, $query);
            }           
        }
        else{
            $query = "delete from users_groups where user_id = '$kick_user_id' and group_id = '$group_id'";
            pg_query($db, $query);
        }
        pg_close($db);
        header("location: ../todo.php");
    }
    pg_close($db);
?>