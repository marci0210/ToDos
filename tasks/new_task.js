function show_new_task() {
    document.getElementById('newtask').style.display = 'flex';
}
function close_new_task_with_save() {
    document.getElementById('newtask').style.display = 'none';
}
function close_new_task_without_save() {
    document.getElementById('newtask').style.display = 'none';
}
function close_edit_task_without_save()
{
    document.getElementById('change_task').style.display = 'none';
}
function close_edit_task_with_save()
{
    document.getElementById('change_task').style.display = 'none';
}

function modify_task(a){
    document.getElementById("change_task").style.display = "flex";

    var tde = "tde_" + a;
    var td = "td_" + a;
    var tg = "gi_" + a;


    document.getElementById("mtta").value = document.getElementById(tde).innerHTML;
    document.getElementById("mtd").value = document.getElementById(td).innerHTML;
    document.getElementById("mtg").value = document.getElementById(tg).innerHTML;
    document.getElementById("edit_button_withsave").value = a;
}