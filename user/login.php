<?php
    require_once __DIR__ . '/../db.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "select * from users 
        left outer join settings on users.user_id = settings.user_id
        where users.username='$username'";
        $result = pg_query($db, $query);

        $row = pg_fetch_assoc($result);
        $count = pg_num_rows($result);

        $password_ver = password_verify($password, $row["password"]);

        if($count == 1 && $password_ver == 1){
            session_start();

            $font_c_cookie = $row['font_color'];
            $bckg_c_cookie = $row['background_color'];

            setcookie("font_color", $font_c_cookie, 0, "/");
            setcookie("background_color", $bckg_c_cookie, 0, "/");

            /* 0 - username, 1 - userid */
            $_SESSION['login_user'] = array();
            array_push($_SESSION['login_user'], $row['username'], $row['user_id']);   

            pg_close($db);
            header("location: ../todo.php");
        }
        else{
            $cookie_name = "log_suc";
            $cookie_value = "0";

            setcookie($cookie_name, $cookie_value, time() + 5, "/");

            pg_close($db);
            header("location: ../todo.php");
        }
    }

    pg_close($db);
?>