const menuBtn = document.getElementById('aside');
const menuIcons = document.getElementById('menu--icons');
const mainContent = document.getElementById('main');

function moveMenu(menu){
    let menuTransform = menu.style.transform;
    const indexStart = menuTransform.indexOf('(');
    const indexEnd = menuTransform.indexOf(')');
    const textBetweenStartEnd = menuTransform.slice(indexStart+1,indexEnd);
    const splitResult = textBetweenStartEnd.split(',');
    const [a, b] = splitResult;
    let x = parseInt(a);
    let y = parseInt(b);
    if(x === 0 ){
        menu.animate([
            {transform: 'translate(-200px,0px)'}
        ],{
            duration: 300,
            iterations: 1,
        }).finished.then(()=>{
            menu.style.transform = `translate(-200px, 0px)`;
            menuIcons.classList.remove('hidden');
            mainContent.style.transform = `translate(-200px, 0px)`;
        });

        mainContent.animate([
            {transform: 'translate(-200px,0px)'}
        ],{
            duration: 300,
            iterations: 1,
        }).finished.then(()=>{
            mainContent.style.transform = `translate(-200px, 0px)`;

        });


    }else{
        menuIcons.classList.add('hidden');
        menu.animate([
            {transform: 'translate(0px,0px)'}
        ],{
            duration: 300,
            iterations: 1,
        }).finished.then(()=>{
            menu.style.transform = `translate(0px, 0px)`;

        });

        mainContent.animate([
            {transform: 'translate(0px,0px)'}
        ],{
            duration: 300,
            iterations: 1,
        }).finished.then(()=>{
            mainContent.style.transform = `translate(0px, 0px)`;

        });
    }


}


menuBtn.addEventListener('click', function(){
    const menu = this;
    moveMenu(menu);
});
