<?php
    include("../config.php");

    $cookie_name = "reg_suc";
    $cookie_value = "0";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $new_username = $_POST['username'];
        $new_email = $_POST['email'];
       
        $hashed_pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $add_user_query = "insert into users (username, password, email) values ('$new_username', '$hashed_pwd', '$new_email');";
        mysqli_query($db, $add_user_query);

        $user_id_query = "select user_id from users where username = '$new_username'";
        $userid = mysqli_insert_id($db);

        $add_g_query = "insert into groups (group_name, admin_user_id) values ('Default', '$userid');";
        mysqli_query($db, $add_g_query);
        $new_group_id = mysqli_insert_id($db);

        $add_ug_query = "insert into users_groups (user_id, group_id) values ('$userid', '$new_group_id');";
        mysqli_query($db, $add_ug_query);

        $add_s_query = "insert into settings (user_id, background_color, font_color)
        values ('$userid', '#e9cca7', 'black')";
        mysqli_query($db, $add_s_query);

        $cookie_value = "1";
        setcookie($cookie_name, $cookie_value, time() + 5, "/");

        mysqli_close($db);
        header("location: ../index.php");
        
    }  

    mysqli_close($db);
?>