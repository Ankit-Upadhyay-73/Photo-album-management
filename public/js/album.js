
function triggerFileChooser(event,element){

    document.getElementById(element).click();
}

function uploadPhoto(event){
    event.preventDefault();
    clearContainer('photos');
    let files = event.srcElement.files;
    convertBlobTo64(Array.from(files) );
}

function convertBlobTo64(blobArr){
    let reader = new FileReader();
    if(blobArr.length > 0){
        reader.readAsDataURL(blobArr.shift());
        reader.onload = ()=>{
            insertImage (reader.result,'photos');
        };
        convertBlobTo64(blobArr);
    }
}

function insertImage(base64,container_id){

    let photosDIV =  document.querySelector(`#${container_id}`);
    let image = document.createElement("img");
    image.src = base64;
    photosDIV.appendChild(image);
}

function clearContainer(container_id){
    document.querySelector(`#${container_id}`).innerHTML = '';
}

document.querySelector("#name").addEventListener("input", (event)=>{
    document.querySelector('#create_album_button').innerHTML = 
    `Create ${event.target.value.trim()} Album`;
});

