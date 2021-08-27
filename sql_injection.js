function valid_username_f() {
    let str = document.getElementById("new_users_in_gs").value;

    if (str == "") {
        document.getElementById("new_users_in_gs").style.borderColor = "black";
        document.getElementById("new_users_in_gs_btn").disabled = true;
        return;
    } 
    else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let a = this.responseText;
            
            if(a == 0){
                document.getElementById("new_users_in_gs").style.borderColor = "crimson";
                document.getElementById("new_users_in_gs_btn").disabled = true;
            }
            else if(a == 1){
                document.getElementById("new_users_in_gs").style.borderColor = "black";
                document.getElementById("new_users_in_gs_btn").disabled = false;
            }
        }
        };
        xmlhttp.open("GET","user/valid_username.php?q="+str,true);
        xmlhttp.send();
    }
}
function txt_area_new_f(l) {
    if(l == 0 || l > 255){
        document.getElementById("txtarea_n").style.borderColor = "crimson";
        document.getElementById("popup_button_withsave").disabled = true;
        
    }    
    else{
        document.getElementById("txtarea_n").style.borderColor = "var(--bgc-darker)";
        document.getElementById("popup_button_withsave").disabled = false;
    }
}
function txt_area_mod_f(l) {
    if(l == 0 || l > 255){
        document.getElementById("txtarea_m").style.borderColor = "crimson";
        document.getElementById("edit_button_withsave").disabled = true;

    }
    else{
        document.getElementById("txtarea_m").style.borderColor = "var(--bgc-darker)";
        document.getElementById("edit_button_withsave").disabled = false;
    }
}
function new_group_f(l){
    if(l == 0 || l > 63){
        document.getElementById("new_group_txt").style.borderColor = "crimson";
        document.getElementById("new_group_btn").disabled = true;
    }
    else{
        document.getElementById("new_group_txt").style.borderColor = "var(--bgc-darker)";
        document.getElementById("new_group_btn").disabled = false;
    }
}