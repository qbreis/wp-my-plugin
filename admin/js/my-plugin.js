document.addEventListener('DOMContentLoaded', function(){
    console.log('My Plugin settings page!!!');
});

document.onreadystatechange = function(){
    showHide('#my_plugin_is_active', '.my-plugin-active-settings');
}
function showHide (checkIdName, elementToHideIdName){
    if(document.querySelector(checkIdName).checked){
        document.querySelector(elementToHideIdName).classList.remove('hidden');
    }else{
        document.querySelector(elementToHideIdName).classList.add('hidden');
    }
}