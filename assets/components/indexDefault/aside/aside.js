const menu = document.getElementById('aside');
const menuSide = document.getElementsByClassName('menuSide');
const menuIcons = document.getElementsByClassName('menu__icons');
const menuSideUls = document.querySelectorAll('.menuSide > ul > li');

/**
 * Menu Side MouseEnter - MouseLeave
 */
menuSideUls.forEach((menuSideUl)=>{
    menuSideUl.addEventListener('mouseenter',function(){
        const link = menuSideUl.children[0];
        link.style.color = '#111';
    });
    menuSideUl.addEventListener('mouseleave',function(){
        const link = menuSideUl.children[0];
        link.style.color = '#fff';
    });
})
/**
 * Hide sub Menu if clicked somewhere else than link
 */
window.addEventListener('click',()=>{
   sideMenu('none');
});

function runAnimation(subMenu, down = true){
    if(down){
        subMenu.animate([
            {transform: `translate(0px,-100vh)`},
            {transform: `translate(0px, 0px)`}
        ],{
            duration: 400,
            iterations: 1
        })
    }

}

/**
 * Handling sub Menu
 * @param icon
 */
function sideMenu(icon){
    menuSide.forEach((subMenu)=>{
        if(subMenu.id !== `${icon}Side`){
            subMenu.classList.add('hidden');
        }else{
            subMenu.classList.toggle('hidden');
            runAnimation(subMenu);
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


