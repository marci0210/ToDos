<?php
    $proto = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'http';
    
    if ($proto !== 'https') {
        $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $location);
        exit;
    }
    /*Session check*/
    session_start();
    if (isset($_SESSION['login_user'])) {
        header('Location: todo.php');
        exit;
    }
?>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="stylesheet" href="style/main_style.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>To Do's</title>
    </head>
    
    <script type="text/javascript" src="register.js"></script>
    <script type="text/javascript">
        var x = <?php echo json_encode($_COOKIE['reg_suc']);?>;
        var y = <?php echo json_encode($_COOKIE['log_suc']);?>;
        
        function reg()
        {
            reg_succ();
            log_unsucc();
        }
        function reg_succ(){
            if(x == 1){
                document.getElementById("succ").style.top = "0";
            }
        }
        function log_unsucc(){
            if(y == 0){
                document.getElementById("log_unsucc").style.top = "0";
            }
        }
        function close_reg() {
            if(x == 1)
            {
                var pos = 0;
                var id = setInterval(frame, 5);
                function frame() {
                    if (pos > -58) {
                        pos--; 
                        document.getElementById("succ").style.top = pos + "px";  
                    }
                    else{
                        clearInterval(id);
                    }
                }
            }
            else if(x == 0){
                var pos = 0;
                var id = setInterval(frame, 5);
                function frame() {
                    if (pos > -58) {
                        pos--; 
                        document.getElementById("unsucc").style.top = pos + "px";  
                    }
                    else{
                        clearInterval(id);
                    }
                }
            }
            if(y == 0){
                var pos = 0;
                var id = setInterval(frame, 5);
                function frame() {
                    if (pos > -58) {
                        pos--; 
                        document.getElementById("log_unsucc").style.top = pos + "px";  
                    }
                    else{
                        clearInterval(id);
                    }
                }
            }
        }
        function valid_username_f() {
            let str = document.getElementById("new_username").value;

            if (str == "") {
                document.getElementById("txt_new_username").innerHTML = "Username cannot be empty.";
                document.getElementById("new_username").style.borderColor = "crimson";
                document.getElementById("popup_button_withsave").disabled = true;
            } 
            else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let a = this.responseText;
                    
                    if(a == 0){
                        document.getElementById("txt_new_username").innerHTML = "";
                        document.getElementById("new_username").style.borderColor = "white";
                        document.getElementById("popup_button_withsave").disabled = false;
                    }
                    else if(a == 1){
                        document.getElementById("txt_new_username").innerHTML = "Username is already in use.";
                        document.getElementById("new_username").style.borderColor = "crimson";
                        document.getElementById("popup_button_withsave").disabled = true;
                    }
                    
                }
                };
                xmlhttp.open("GET","user/valid_username.php?q="+str,true);
                xmlhttp.send();
            }
        }
        function valid_email_f(){
            let str = document.getElementById("new_email").value;

            if (str == "") {
                document.getElementById("txt_new_email").innerHTML = "Email address cannot be empty.";
                document.getElementById("new_email").style.borderColor = "crimson";
                document.getElementById("popup_button_withsave").disabled = true;
            } 
            else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let a = this.responseText;
                    
                    if(a == 1){
                        document.getElementById("txt_new_email").innerHTML = "Email address is already in use.";
                        document.getElementById("new_email").style.borderColor = "crimson";
                        document.getElementById("popup_button_withsave").disabled = true;
                    }
                    else if(new_email_f()){
                        document.getElementById("txt_new_email").innerHTML = "Email address format invalid.";
                        document.getElementById("new_email").style.borderColor = "crimson";
                        document.getElementById("popup_button_withsave").disabled = true;
                    }
                    else{
                        document.getElementById("txt_new_email").innerHTML = "";
                        document.getElementById("new_email").style.borderColor = "white";
                        document.getElementById("popup_button_withsave").disabled = false;
                    }
                    
                }
                };
                xmlhttp.open("GET","user/valid_email.php?q="+str,true);
                xmlhttp.send();
            }
        }
        function new_email_f(){
            let a = document.getElementById("new_email").value;
            var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            if(!a.match(mailformat)){
                return 1;
            }
            else{
                return 0;
            }
        }
        function new_psw_f(){
            let a = document.getElementById("new_psw").value.length;

            if(a < 8){
                document.getElementById("txt_new_psw").innerHTML = "Use 8 or more characters.";
                document.getElementById("new_psw").style.borderColor = "crimson";
                document.getElementById("popup_button_withsave").disabled = true;
            }
            else{
                document.getElementById("txt_new_psw").innerHTML = "";
                document.getElementById("new_psw").style.borderColor = "white";
                document.getElementById("popup_button_withsave").disabled = false;
            }
        }
        function new_rpsw_f(){
            let a = document.getElementById("new_psw").value;
            let b = document.getElementById("new_rpsw").value;

            if(a != b){
                document.getElementById("txt_new_rpsw").innerHTML = "Passwords don't match.";
                document.getElementById("new_rpsw").style.borderColor = "crimson";
                document.getElementById("popup_button_withsave").disabled = true;
            }
            else{
                document.getElementById("txt_new_rpsw").innerHTML = "";
                document.getElementById("new_rpsw").style.borderColor = "white";
                document.getElementById("popup_button_withsave").disabled = false;
            }
        }

        function show_login(params) {
            document.getElementById("login").style.display = "flex";
            document.getElementById("lgnin").style.borderBottom = "2px solid black";
            document.getElementById("register").style.display = "none";
            document.getElementById("rst").style.borderBottom = "0px";
        }
        function show_register(params) {
            document.getElementById("login").style.display = "none";
            document.getElementById("lgnin").style.borderBottom = "0px";
            document.getElementById("register").style.display = "flex";
            document.getElementById("rst").style.borderBottom = "2px solid black";
        }
    </script>
    
    <body onload="reg(); setTimeout(close_reg, 3000)">
        <div class="succ" id="succ">
            <p>Registration was successfull.</p>
        </div>
        <div class="succ" id="log_unsucc" style="background: firebrick; color:white">
            <p>Login failed.</p>
        </div>
        <div class="main">
            <div class="bckg_img"></div>
            <div class="a">
                <div class="title"><h1>To Do's</h1></div>
                <div class="int">
                    <div class="type">
                        <button type="button" class="btn_type" id="lgnin" style="width:50%" onclick="show_login()">Login</button>
                        <button type="button" class="btn_type" id="rst" style="width:50%" onclick="show_register()">Register</button>
                    </div>
                    <div id="login">
                        <form method="post" action="user/login.php">
                            <div style="display: flex">
                                <span class="material-icons">person</span>
                                <input name="username" class="input" id="username" type="text" placeholder="Username"><br>
                            </div>
                            <div style="display: flex">
                                <span class="material-icons">lock</span>
                                <input name="password" class="input" type="password" placeholder="Password"><br>
                            </div>
    
                            <button id="lib" class="z" type="submit">Login</button>
                        </form>
                    </div>
                    <div id="register">
                        <form method="post" action="user/create_user.php">
                            <div style="display:flex">
                                <span class="material-icons">person</span>
                                <input oninput="valid_username_f()" name="username" class="input" type="text" placeholder="Username" id="new_username"> 
                            </div>
                            <p id="txt_new_username" class="warning"></p> 
                            <div style="display:flex">
                                <span class="material-icons">alternate_email</span>
                                <input oninput="valid_email_f()" name="email" class="input" type="email" placeholder="Email" id="new_email">
                            </div>    
                            <p id="txt_new_email" class="warning"></p>  
                            <div style="display:flex">
                                <span class="material-icons">password</span>
                                <input oninput="new_psw_f()" name="password" class="input" type="password" placeholder="Password" id="new_psw" >   
                            </div>
                            <p id="txt_new_psw" class="warning"></p>
                            <div style="display:flex">
                                <span class="material-icons">password</span>
                                <input oninput="new_rpsw_f()" name="retype" class="input" type="password" placeholder="Password again" id="new_rpsw">
                            </div>       
                            <p id="txt_new_rpsw" class="warning"></p>  
                            <button type="submit" class="popup_tab" id="popup_button_withsave" 
                                onclick="close_register()" disabled>Register</button>
                        </form>
                    </div>
                </div>
                <div class="copyright" id="cpyr">
                    <p style="margin: 0">To Do's © 2021</p></div>
            </div>
        </div> 
    </body>
</html>
