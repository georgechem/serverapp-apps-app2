const homeSide = document.getElementsByClassName('menuSide');
const menuIcons = document.getElementsByClassName('menu__icons');

menuIcons.forEach((icon)=>{
    icon.addEventListener('click',(e)=>{
        if(e.target.id === 'home'){
            homeSide.forEach((subMenu)=>{
                if(subMenu.id !== `${e.target.id}Side`){
                    console.log(subMenu.id);
                    subMenu.classList.add('hidden');
                }else{
                    subMenu.classList.remove('hidden');
                }

            });
        }

    })
});


