<?php
    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
        $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $location);
        exit;
    }

    require_once 'db.php';

    /*Session check*/
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header('Location: index.php');
        exit;
    }
?>
<html>
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="style/todo_style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>To Do's</title>

    <script type="text/javascript" src="tasks/new_task.js"></script>
    <script type="text/javascript" src="groups/group_manager.js"></script>
    <script type="text/javascript" src="settings.js"></script>
    <script type="text/javascript" src="filters.js"></script>
    <script type="text/javascript" src="sql_injection.js"></script>
    <script type="text/javascript" src="config.js"></script>
    <script type="text/javascript">
        function start(){
            set_wallpaper();
            set_background();
            uncompleted_filter();
            group_filter(0);
            var a = document.getElementById("mtg").options[0].value;
            listUsers(a);
        }
        function set_wallpaper(){
            var x = window.innerWidth;
            var y = window.innerHeight;

            if(x > 1080){
                const unsplashUrl = `https://api.unsplash.com/photos/random?client_id=${accessKey}&query=nature&orientation=landscape`;

                fetch(unsplashUrl)
                    .then(response => response.json())
                    .then(data => {
                        var imageUrl = data.urls.full;
                        document.body.style.backgroundImage = `url('${imageUrl}')`;
                        document.body.style.backgroundSize = "cover";
                        document.body.style.backgroundPosition = "center";
                    })
                    .catch(error => console.error('Error:', error));
            }
            else{
                const unsplashUrl = `https://api.unsplash.com/photos/random?client_id=${accessKey}&query=nature&orientation=portrait`;

                fetch(unsplashUrl)
                    .then(response => response.json())
                    .then(data => {
                        var imageUrl = data.urls.full;
                        document.body.style.backgroundImage = `url('${imageUrl}')`;
                        document.body.style.backgroundSize = "cover";
                        document.body.style.backgroundPosition = "center";
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
        function set_background(){
            var bgc = <?php echo json_encode($_COOKIE['background_color']);?>;
            var fc = <?php echo json_encode($_COOKIE['font_color']);?>;
            var dbgc = adjust(bgc, -50);

            document.documentElement.style.setProperty('--bgc', bgc);
            document.documentElement.style.setProperty('--bgc-darker', dbgc);
            document.documentElement.style.setProperty('--fc', fc);

            document.getElementById("background_color").value = bgc;
            document.getElementById("text_color").value = fc;
        }

        function listUsers(str) {
            if (str == "") {
                document.getElementById("au").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("au").innerHTML = this.responseText;
                }
                };
                xmlhttp.open("GET","groups/shared_group.php?q="+str,true);
                xmlhttp.send();
            }
        }
        
    </script>
    
</head>
<body onload="start()">
    <div class="main">
        <div id="head">
            <div class="filter">
                <button type="button" class="button"id="setting_button" onclick="show_groups()">
                    <span class="material-icons-outlined">filter_alt</span>
                </button>
                
            </div>
            <h1>To Do's</h1>
            <div class="another_side">
                <button type="button" class="button" id="setting_button" onclick="show_group_manager()">
                    <span class="material-icons">group</span>
                </button>
                <button type="button" class="button" id="setting_button" onclick="show_settings()">
                    <span class="material-icons">settings</span>
                </button>
                <button type="button" class="button" id="head_mat_end">
                    <span class="material-icons"><a href="user/logout.php">logout</a></span>
                </button>
            </div>
        </div>
        <div id="body">
            <div id="menu">
                <!--Statikus menütagok-->
                <a href="#">
                    <div class="a" id="unc_a" onclick="uncompleted_filter()">
                        <span class="material-icons">task_alt</span>
                        <p>Tasks</p>
                    </div>
                </a>
                <a href="#">
                    <div class="a" id="c_a" onclick="completed_filter()">
                        <!--<span class="material-icons">task</span>-->
                        <span class="material-icons">done</span>
                        <p>Completed</p>
                    </div>
                </a>
                <hr>
                <a href="#">
                    <div class="a" id="da" onclick="set_date_filter()">
                        <span class="material-icons">today</span>
                        <p>Today</p>
                    </div>
                </a>
                <hr>
                <!--Dinamikus menütagok-->
                <a href="#">
                    <div class="a" id="all" onclick="group_filter(0)">
                        <span class="material-icons">task</span>
                        <p>All</p>
                    </div>
                </a>
                <ul id="ul_groups">
                    <?php include("groups/display_groups.php")?>
                </ul>

                <div class="a" style="margin-top:0">
                    <span class="material-icons">post_add</span>
                    <form method="post" action="groups/new_group.php" class="input" style="width:100%">
                        <input oninput="new_group_f(this.value.length)" id="new_group_txt" type="text" name="new_group_name"><br><br>
                        <button id="new_group_btn" type="submit" class="button" disabled>
                            <span class="material-icons">add</span></button>
                    </form>
                </div>
            </div>
            <div id="content">
                <!--Uncompleted-->
                <div class="tasks" id="uncomp">
                    <ul id="ul_notcomp">
                        <?php include("tasks/list_tasks_uncompleted.php");?>
                    </ul>
                </div>
                <!--Completed-->
                <div class="tasks" id="comp">
                    <!-- Include list tasks -->
                    <ul id="ul_comp">
                        <?php include("tasks/list_tasks_completed.php");?>
                    </ul>
                </div>

            </div>
        </div>

        <button type="button" class="create_task" onclick="show_new_task()">
            <span class="material-icons" id="create_task">add</span></button>
    </div>
    
    <!--New task popup-->
    <div class="popup" id="newtask">
        <div class="popup_content">
            <h1 id="task_">New task</h1>
            <form method="post" action="tasks/create_task.php">
                <div class="popup_tab" id="txtarea_n">
                    <textarea oninput="txt_area_new_f(this.value.length)" id="ntta" rows=4  placeholder="Description" name="task_description"></textarea>
                </div>
                <div class="popup_tab" id="popup_tab_nt">
                    <p><nobr>Due date</nobr></p>
                    <input type="date" name="task_date">
                </div>
                <div class="popup_tab" id="popup_tab_nt">
                    <p>Group</p>
                    <select class="dropdown" name="task_group">
                        <?php include("groups/list_groups.php"); ?>
                    </select>
                </div>
                <button type="submit" class="popup_tab" id="popup_button_withsave" 
                    onclick="close_new_task_with_save()" disabled>Save & Exit</button>
            </form>
            
            <button class="popup_tab" id="popup_button_withoutsave"
                onclick="close_new_task_without_save()">Cancel</button>
        </div>
    </div>
    <!-- Modify task -->
    <div class="popup" id="change_task">
        <div class="popup_content">
            <h1 id="task_">Edit task</h1>
            <form method="post" action="tasks/edit_task.php">
                <div class="popup_tab" id="txtarea_m">
                    <textarea oninput="txt_area_mod_f(this.value.length)" id="mtta" rows=4  placeholder="Description" name="task_description"></textarea>
                </div>
                <div class="popup_tab" id="popup_tab_nt">
                    <p><nobr>Due date</nobr></p>
                    <input id="mtd" type="date" name="task_date">
                </div>
                <div class="popup_tab" id="popup_tab_nt">
                    <p>Group</p>
                    <select id="mtg" class="dropdown" name="task_group">
                        <?php include("groups/list_groups.php"); ?>
                    </select>
                    
                </div>
                <button name="sub" type="submit" class="popup_tab" id="edit_button_withsave" 
                    onclick="close_edit_task_with_save()">Save & Exit</button>
            </form>
            
            <button class="popup_tab" id="popup_button_withoutsave"
                onclick="close_edit_task_without_save()">Cancel</button>
        </div>
    </div>
    <!--Settings popup-->
    <div class="popup" id="settings">
        <div class="popup_content">
            <h1>Settings</h1>
            <form method="post" action="change_settings.php">
                <div class="popup_tab">
                    <p>Background color: </p>
                    <div class="z"><input type="color" name="bcgc" class="color_input" id="background_color"></div>
                </div>
                <div class="popup_tab">
                    <p>Font color: </p>
                    <div class="z"><input type="color" name="c" class="color_input" id="text_color"></div>
                </div>
                <button type="submit" class="popup_tab" id="popup_button_withsave_settings" 
                    onclick="close_settings_with_save()">Save & Exit</button>
            </form>

            <button class="popup_tab" id="popup_button_withoutsave"
                onclick="close_settings_without_save()">Cancel</button>
        </div>
    </div>
    <!--Shared group manager-->
    <div class="popup" id="shared_group">
        <div class="popup_content">
            <h1>Group Share</h1>
            <form method="post" action="groups/manage_users.php">
                <div class="popup_tab" id="popup_tab_nt">
                    <p>Group</p>
                    <select id="mtg" class="dropdown" name="task_group" onclick="listUsers(this.value)">
                        <?php include("groups/list_groups.php"); ?>
                    </select>
                </div>
                <div class="popup_tab">
                    <p style="width: auto; display: inline; white-space: nowrap; margin-right: 10px">Add user</p>
                    <input oninput="valid_username_f()" id="new_users_in_gs" name="new_user" type="text" placeholder="Username">
                    
                    <button id="new_users_in_gs_btn" type="submit" class="button" name="button" value="0" style="margin-top: 0; margin-bottom: 0; background-color: white" disabled>
                        <span class="material-icons" style="color: black">person_add</span></button> 
                </div>
                
                <div class="popup_tab" style="flex-direction: column; ">
                    <p style="width: auto; display: inline; white-space: nowrap; margin-right: 10px">Users</p>
                    <div class="au" id="au"></div>
                </div>

            </form>
            <button class="popup_tab" id="popup_button_withoutsave"
                onclick="close_group_manager()">Close</button>
        </div>
    </div>
</body>

</html>