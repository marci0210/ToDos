var date_active = 0;
var curr_group = 0; /*0 == all */

function uncompleted_filter(){
    document.getElementById("c_a").style.borderColor = 
        getComputedStyle(document.documentElement).getPropertyValue('--bgc');
    document.getElementById("unc_a").style.borderColor = 
        getComputedStyle(document.documentElement).getPropertyValue('--bgc-darker');

    document.getElementById("comp").style.display = "none";
    document.getElementById("uncomp").style.display = "flex";
}
function completed_filter(){
    document.getElementById("c_a").style.borderColor = 
        getComputedStyle(document.documentElement).getPropertyValue('--bgc-darker');
    document.getElementById("unc_a").style.borderColor = 
        getComputedStyle(document.documentElement).getPropertyValue('--bgc');

    document.getElementById("comp").style.display = "flex";
    document.getElementById("uncomp").style.display = "none";
}
function reset_tasks_border(){
    let li = document.getElementById("ul_groups").getElementsByTagName("li");

    document.getElementById("all").style.borderColor = 
        getComputedStyle(document.documentElement).getPropertyValue('--bgc');

    for (let i = 0; i < li.length; i++) {
        li[i].firstChild.firstChild.style.borderColor = 
            getComputedStyle(document.documentElement).getPropertyValue('--bgc');
    }
}
/* --------------------------------------------------------*/
function set_date_filter(){
    if(date_active == 1){
        document.getElementById("da").style.borderColor = 
            getComputedStyle(document.documentElement).getPropertyValue('--bgc');

        date_active = 0;
    }
    else{
        document.getElementById("da").style.borderColor = 
            getComputedStyle(document.documentElement).getPropertyValue('--bgc-darker');

        date_active = 1;
    }

    group_filter(curr_group);
}
function date_filter(task){
    let curr_date = new Date();
    let a = task.getElementsByTagName("p")[2].innerHTML;

    let year = a[0] + a[1] + a[2] + a[3];
    let month = a[5] + a[6];
    let day = a[8] + a[9];

    if(year == curr_date.getFullYear() && month == (curr_date.getMonth() + 1) && day == curr_date.getDate()) {
        return "flex";
    } 
    else {
        return "none";
    }
}
function group_filter(group){
    curr_group = group;

    let li_notcomp = document.getElementById("ul_notcomp").getElementsByTagName("li");
    let li_comp = document.getElementById("ul_comp").getElementsByTagName("li");

    reset_tasks_border();
    if(curr_group == 0){
        document.getElementById("all").style.borderColor = 
        getComputedStyle(document.documentElement).getPropertyValue('--bgc-darker');
    }
    else{
        document.getElementById(curr_group).firstChild.style.borderColor = 
        getComputedStyle(document.documentElement).getPropertyValue('--bgc-darker');
    }


    for (let i = 0; i < li_notcomp.length; i++) {
        if (li_notcomp[i].firstChild.innerHTML == curr_group || curr_group == 0) {
            if(date_active == 1) {
                li_notcomp[i].style.display = date_filter(li_notcomp[i]);
            }
            else{
                li_notcomp[i].style.display = "flex";
            }
        } 
        else {
            li_notcomp[i].style.display = "none";
        }
    }
    for (let i = 0; i < li_comp.length; i++) {
        if (li_comp[i].firstChild.innerHTML == curr_group || curr_group == 0) {
            if(date_active == 1) {
                li_comp[i].style.display = date_filter(li_comp[i]);
            }
            else{
                li_comp[i].style.display = "flex";
            }
        } 
        else {
            li_comp[i].style.display = "none";
        }
    }
}
function show_groups(){
    if(document.getElementById("menu").style.display == "block"){
        document.getElementById("menu").style.display = "none";
        document.getElementById("content").style.display = "flex";
    }
    else{
        document.getElementById("menu").style.display = "block";
        document.getElementById("content").style.display = "none";
    }
}