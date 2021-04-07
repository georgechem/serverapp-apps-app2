const menuBtn = document.getElementById('aside');

function moveMenu(menu){
    menu.style.transform = 'translate(1px, 1px)';
    console.log(menu);


}


menuBtn.addEventListener('click', function(){
    const menu = this;
    moveMenu(menu);
});
