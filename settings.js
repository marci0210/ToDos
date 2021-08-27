var bgc;
var bgc_darker;
var tc;

function show_settings() {
    document.getElementById('settings').style.display = 'flex';
    bgc = document.getElementById('background_color').value;
    tc = document.getElementById('text_color').value;
}
function close_settings_with_save() {
    document.getElementById('settings').style.display = 'none';

    bgc = document.getElementById('background_color').value;
    bgc_darker = adjust(bgc, -50);
    tc = document.getElementById('text_color').value;

    document.documentElement.style.setProperty('--bgc', bgc);
    document.documentElement.style.setProperty('--bgc-darker', bgc_darker);
    document.documentElement.style.setProperty('--fc', tc);
}
function close_settings_without_save() {
    document.getElementById('settings').style.display = 'none';

    document.getElementById('background_color').value = bgc;
    document.getElementById('text_color').value = tc;
}
function adjust(color, amount) {
    return '#' + color.replace(/^#/, '').replace(/../g, color => ('0' + Math.min(255, Math.max(0, parseInt(color, 16) + amount)).toString(16)).substr(-2));
}