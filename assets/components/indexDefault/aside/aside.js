const menuSide = document.getElementsByClassName('menuSide');
const menuIcons = document.getElementsByClassName('menu__icons');

function sideMenu(icon){
    console.log(icon);
    menuSide.forEach((subMenu)=>{
        if(subMenu.id !== `${icon}Side`){
            console.log(subMenu.id);
            subMenu.classList.add('hidden');
        }else{
            subMenu.classList.remove('hidden');

        }
        if(icon === 'home'){
            subMenu.style.top = '30px';
        }
    })

}


menuIcons.forEach((icon)=>{
    icon.addEventListener('click',(e)=>{

        sideMenu(e.target.id);



    })
});


