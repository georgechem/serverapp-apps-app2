const homeSide = document.getElementsByClassName('menuSide');
const menuIcons = document.getElementsByClassName('menu__icons');

function sideMenu(icon){
    console.log(icon);
}


menuIcons.forEach((icon)=>{
    icon.addEventListener('click',(e)=>{
        if(e.target.id === 'home'){
            sideMenu(e.target.id);

            homeSide.forEach((subMenu)=>{
                if(subMenu.id !== `${e.target.id}Side`){
                    console.log(subMenu.id);
                    subMenu.classList.add('hidden');
                }else{
                    subMenu.classList.remove('hidden');

                }
                if(e.target.id === 'home'){
                    subMenu.style.top = '30px';
                }

            });
        }

    })
});


