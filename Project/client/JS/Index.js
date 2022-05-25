/*Carousel code*/

let imgObject = [
    "Resources/Images/sw1.jpg",
    "https://pbs.twimg.com/media/FMo5DaTVQAEsNGW?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMpVHQ_VUAMjHc5?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMpNKreVcAQc5PY?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMtdOJ-UcAAS5RQ?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMuVTc2UYAgCPbj?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMtdPLCVUAQslG5?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMqADeEVkAIlLLF?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMpy0urVQAIKd3p?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMuVRpDUYAU89tD?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMuVSNLUcAMqo92?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMuVS0UVcAEkEQM?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMtdOo-VUAEogCV?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMp4A8lUcAQ3BHY?format=jpg&name=large",
    "https://pbs.twimg.com/media/FMpzibDVEAUfT0j?format=jpg&name=large",
];

let txtObject = [
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    "",
];

let mainImg = 0;
let prevImg = imgObject.length - 1;
let nextImg = 1;

let mainTxt = 0;
let prevTxt = txtObject.length - 1;
let nextTxt = 1;

function loadGallery() {

    let mainView = document.getElementById("mainView");
    mainView.style.background = "url(" + imgObject[mainImg] + ")";
    mainView.style.backgroundSize = "cover";
    mainView.style.backgroundPositionX = "50%";

    let leftView = document.getElementById("leftView");
    leftView.style.background = "url(" + imgObject[prevImg] + ")";
    leftView.style.backgroundSize = "cover";
    leftView.style.backgroundPositionX = "50%";

    let rightView = document.getElementById("rightView");
    rightView.style.background = "url(" + imgObject[nextImg] + ")";
    rightView.style.backgroundSize = "cover";
    rightView.style.backgroundPositionX = "50%";


    let linkTag = document.getElementById("linkTag")
    linkTag.href = imgObject[mainImg];

}

function scrollRight() {

    prevImg = mainImg;
    mainImg = nextImg;
    if (nextImg >= (imgObject.length -1)) {
        nextImg = 0;
    } else {
        nextImg++;
    }

    prevTxt = mainTxt;
    mainTxt = nextTxt;
    if (nextTxt >= (txtObject.length -1)) {
        nextTxt = 0;
    } else {
        nextTxt++;
    }

    clearInterval(myTimer);
    myTimer = setInterval(function(){scrollRight()}, 4000);
    loadGallery();
}

function scrollLeft() {
    nextImg = mainImg;
    mainImg = prevImg;

    if (prevImg === 0) {
        prevImg = imgObject.length - 1;
    } else {
        prevImg--;
    }

    nextTxt = mainTxt
    mainTxt = prevTxt;

    if (prevTxt === 0) {
        prevTxt = txtObject.length - 1;
    } else {
        prevTxt--;
    }

    clearInterval(myTimer);
    myTimer = setInterval(function(){scrollRight()}, 4000);
    loadGallery();
}

document.getElementById("navRight").addEventListener("click", scrollRight);
document.getElementById("navLeft").addEventListener("click", scrollLeft);
document.getElementById("rightView").addEventListener("click", scrollRight);
document.getElementById("leftView").addEventListener("click", scrollLeft);
document.addEventListener('keyup',function(e){
    if (e.keyCode === 37) {
        scrollLeft();
    } else if(e.keyCode === 39) {
        scrollRight();
    }
});

window.addEventListener("load",function() {
    loadGallery();
    myTimer = setInterval(function(){scrollRight()}, 4000);
})

/*Menu code*/

const icon=document.querySelector('.magnifier-icon');
const search=document.querySelector('.search');
const nav=document.querySelector('.elements');
const clear=document.querySelector('.clear');
const menu=document.querySelector('.menu__btn');
function openImg(){
    document.getElementsByClassName('logo');
    var source = 'FirstPage.html';
    window.open(source);
}
icon.onclick=function() {
    search.classList.toggle('active');
    nav.classList.toggle('active');
    clear.classList.toggle('active');
}
menu.onclick=function ()
{
    search.classList.toggle('active1');
    nav.classList.toggle('active1');
}
