const menuBtn = document.getElementById('aside');

function moveMenu(menu){
    const menuTransform = menu.style.transform = 'translate(0px, 0px)';
    const indexStart = menuTransform.indexOf('(');
    const indexEnd = menuTransform.indexOf(')');
    const textBetweenStartEnd = menuTransform.slice(indexStart+1,indexEnd);
    const splitResult = textBetweenStartEnd.split(',');
    const [a, b] = splitResult;
    let x = parseInt(a);
    let y = parseInt(b);



}


menuBtn.addEventListener('click', function(){
    const menu = this;
    moveMenu(menu);
});
