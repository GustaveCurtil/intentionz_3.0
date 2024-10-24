let sliderZoom = document.querySelector('#zoom');
let sliderHorizontaal = document.querySelector('#horizontaal');
let sliderVerticaal = document.querySelector('#verticaal');
let fotokader = document.querySelector('#voorvertoning')
let foto = document.querySelector('#voorvertoning img')

let uploadButton = document.querySelector('input[type="file"]');
uploadButton.addEventListener('change', (e)=>{
    const currFiles = e.target.files
    if(currFiles.length > 0){
        let src = URL.createObjectURL(currFiles[0])
        foto.src = src
    }
})

sliderZoom.addEventListener('input', (e) => {
    let scaleValue = (e.target.value / 100);
    foto.style.scale = scaleValue;
    foto.style.transform = "translate(-" + (50/scaleValue) + "%, -" + (50/scaleValue) + "%)"
})

let horizontaal = 50;
let verticaal = 50;

sliderVerticaal.addEventListener('input', (e) => {
    verticaal = e.target.value
    foto.style.top = verticaal + "%";
})

sliderHorizontaal.addEventListener('input', (e) => {
    horizontaal = e.target.value
    foto.style.left = horizontaal + "%";
})
