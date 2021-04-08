const menuSide = document.getElementsByClassName('menuSide');
const menuIcons = document.getElementsByClassName('menu__icons');
const menuSideUls = document.querySelectorAll('.menuSide > ul');


menuSideUls.forEach((menuSideUl)=>{
    menuSideUl.addEventListener('mouseover',function(){
        console.log(menuSideUl);
    });
})


function sideMenu(icon){
    console.log(icon);
    menuSide.forEach((subMenu)=>{
        if(subMenu.id !== `${icon}Side`){
            console.log(subMenu.id);
            subMenu.classList.add('hidden');
        }else{
            subMenu.classList.toggle('hidden');

        }
        if(icon === 'home'){
            subMenu.style.top = '30px';
        }
        if(icon === 'users'){
            subMenu.style.top = '97px';
        }
    })

}


menuIcons.forEach((icon)=>{
    icon.addEventListener('click',(e)=>{

        sideMenu(e.target.id);



    })
});


