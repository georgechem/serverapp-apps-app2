const menu = document.getElementById('aside');
const menuSide = document.getElementsByClassName('menuSide');
const menuIcons = document.getElementsByClassName('menu__icons');
const menuSideUls = document.querySelectorAll('.menuSide > ul');


menuSideUls.forEach((menuSideUl)=>{
    menuSideUl.addEventListener('mouseover',function(){
        console.log(menuSideUl);
    });
})
/**
 * Hide sub Menu if Menu bar clicked
 */
menu.addEventListener('click', ()=>{
    sideMenu('none');
})

/**
 * Handling sub Menu
 * @param icon
 */
function sideMenu(icon){
    //console.log(icon);
    menuSide.forEach((subMenu)=>{
        if(subMenu.id !== `${icon}Side`){
            //console.log(subMenu.id);
            subMenu.classList.add('hidden');
        }else{
            subMenu.classList.toggle('hidden');

        }

    })

}

/**
 * Action on icon Click in Menu
 */
menuIcons.forEach((icon)=>{
    icon.addEventListener('click',(e)=>{
        sideMenu(e.target.id);
        e.stopPropagation();


    })
});


