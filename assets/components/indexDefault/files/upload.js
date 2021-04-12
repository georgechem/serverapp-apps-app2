/**
 * Idea - do on server endpoint where session variable will be accesible
 * do regular request to that end point request
 */

const uploadFilename = document.getElementById('upload_filename');
const progressBar = document.getElementById('progress');
const uploadForm = document.querySelector('.Upload__container > form');

if(uploadFilename){
    progressBar.style.backgroundColor = `#000000`;
    progressBar.style.opacity = 0.7;
    progressBar.style.height = '20px';
    progressBar.style.width = '15px';
    //uploadForm.addEventListener('submit', uploadFile);
    uploadForm.addEventListener('submit', testFetch);

    function uploadFile(e){
        e.preventDefault();
        console.log(e.target.action);
        const xhr = new XMLHttpRequest();
        xhr.open('POST',e.target.action);
        xhr.upload.addEventListener('progress', e=>{
            console.log(e);
        });

    }

    function testFetch(e){
        e.preventDefault();
        fetch(e.target.action,{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            body: JSON.stringify('')
        })
            .then((res)=>{
                return res;
            })
            .then((result)=>{
               console.log(result);
            });
    }


}


