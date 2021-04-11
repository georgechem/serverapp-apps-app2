const panelButton = document.getElementById('panelButton');
const panel = document.getElementById('panel');
const panelOffsetX = 200;
panel.style.transform = `translateX(${panelOffsetX}px)`;

panelButton.addEventListener('click', ()=>{
    const start = panel.style.transform.indexOf('(');
    const end = panel.style.transform.indexOf(')');
    const data = panel.style.transform.slice(start+1, end)
    const transformX = parseInt(data);
    if(transformX > 0){
        // slide right to 0
        panel.animate([
            {transform: `translateX(0px)`}
        ],{
            duration: 500,
            iterations: 1,
        }).finished.then(()=>{
            panel.style.transform = `translateX(0px)`;
        });
    }else{
        // slide left to high +
        panel.animate([
            {transform: `translateX(${panelOffsetX}px)`}
        ],{
            duration: 500,
            iterations: 1,
        }).finished.then(()=>{
            panel.style.transform = `translateX(${panelOffsetX}px)`;
        });
    }
    console.log(transformX);
});
