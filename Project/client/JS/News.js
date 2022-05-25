/*Carousels code*/
// IMAGES HERE v
let imgObject = [
    // 1st vertical carousel
    [
        "Resources/Images/sus1.png",
        "Resources/Images/sus2.png",
        "Resources/Images/sus3.png",
        "Resources/Images/sus4.png",
        "Resources/Images/sus5.png",
        "Resources/Images/sus6.png",
        "Resources/Images/sus7.png",
        "Resources/Images/sus8.png",
        "Resources/Images/sus9.png",
    ],

    // 2nd vertical carousel
    [
        "Resources/Images/jos1.png",
        "Resources/Images/jos2.png",
        "Resources/Images/jos3.png",
        "Resources/Images/jos4.png",
        "Resources/Images/jos5.png",
        "Resources/Images/jos6.png",
        "Resources/Images/jos7.png",
        "Resources/Images/jos8.png",
        "Resources/Images/jos9.png",
        "Resources/Images/jos10.png",
        "Resources/Images/jos11.png",
        "Resources/Images/jos12.png",
    ],


    // 1st zig-zag carousel
    [
        "Resources/Images/primulswiper1.png",
        "Resources/Images/primulswiper10.png",
        "Resources/Images/primulswiper2.png",
        "Resources/Images/primulswiper3.png",
        "Resources/Images/primulswiper4.png",
        "Resources/Images/primulswiper5.png",
        "Resources/Images/primulswiper6.png",
        "Resources/Images/primulswiper7.png",
        "Resources/Images/primulswiper8.png",
        "Resources/Images/primulswiper9.png",
        "Resources/Images/primulswiper11.png",
        "Resources/Images/primulswiper12.png",
        "Resources/Images/primulswiper13.png",
        "Resources/Images/primulswiper14.png",
    ],

    // 2nd zig-zag carousel
    [
        "Resources/Images/middleswiper5.png",
        "Resources/Images/middleswiper15.png",
        "Resources/Images/middleswiper1.png",
        "Resources/Images/middleswiper2.png",
        "Resources/Images/middleswiper3.png",
        "Resources/Images/middleswiper4.png",
        "Resources/Images/middleswiper6.png",
        "Resources/Images/middleswiper7.png",
        "Resources/Images/middleswiper8.png",
        "Resources/Images/middleswiper9.png",
        "Resources/Images/middleswiper10.png",
        "Resources/Images/middleswiper11.png",
        "Resources/Images/middleswiper12.png",
        "Resources/Images/middleswiper13.png",
        "Resources/Images/middleswiper14.png",
        "Resources/Images/middleswiper16.png",
        "Resources/Images/middleswiper17.png",
    ],

    // 3rd zig-zag carousel
    [
     "Resources/Images/ultimulswiper1.png",
        "Resources/Images/ultimulswiper2.png",
        "Resources/Images/ultimulswiper3.png",
        "Resources/Images/ultimulswiper4.png",
        "Resources/Images/ultimulswiper5.png",
        "Resources/Images/ultimulswiper6.png",
        "Resources/Images/ultimulswiper7.png",
        "Resources/Images/ultimulswiper8.png",
        "Resources/Images/ultimulswiper9.png",
        "Resources/Images/ultimulswiper10.png",
        "Resources/Images/ultimulswiper11.png",
        "Resources/Images/ultimulswiper12.png",
        "Resources/Images/ultimulswiper13.png",
        "Resources/Images/ultimulswiper14.png",
    ],

    // 6th zig-zag carousel
    [
        "Resources/Images/middleswiper5.png",
        "Resources/Images/middleswiper15.png",
        "Resources/Images/middleswiper1.png",
        "Resources/Images/middleswiper2.png",
        "Resources/Images/middleswiper3.png",
        "Resources/Images/middleswiper4.png",
        "Resources/Images/middleswiper6.png",
        "Resources/Images/middleswiper7.png",
        "Resources/Images/middleswiper8.png",
        "Resources/Images/middleswiper9.png",
        "Resources/Images/middleswiper10.png",
        "Resources/Images/middleswiper11.png",
        "Resources/Images/middleswiper12.png",
        "Resources/Images/middleswiper13.png",
        "Resources/Images/middleswiper14.png",
        "Resources/Images/middleswiper16.png",
        "Resources/Images/middleswiper17.png"
    ]
];

// TEXT HERE v
let txtObject = [
    // Placeholder
    [
        "",
        "",
        ""
    ],

    // Placeholder
    [
        "",
        "",
        ""
    ],

    // 1st zigzag carousel text
    [
        "",
        "",
        ""
    ],

    // 2nd zigzag carousel text
    [
        "",
        "",
        ""
    ],

    // 3rd zigzag carousel text
    [
        "",
        "",
        ""
    ],

    // 6th zigzag carousel text
    [
        "",
        "",
        ""
    ]
];

var indexImg = [
    [imgObject[0].length - 1, 0, 1],
    [imgObject[1].length - 1, 0, 1],
    [imgObject[2].length - 1, 0, 1],
    [imgObject[3].length - 1, 0, 1],
    [imgObject[4].length - 1, 0, 1],
    [imgObject[5].length - 1, 0, 1]
];

var indexTxt = [
    [txtObject[0].length - 1, 0, 1],
    [txtObject[1].length - 1, 0, 1],
    [txtObject[2].length - 1, 0, 1],
    [txtObject[3].length - 1, 0, 1],
    [txtObject[4].length - 1, 0, 1],
    [txtObject[5].length - 1, 0, 1]
];

let slideView = [
    "mainView1",
    "mainView2",
    "mainView3",
    "mainView4",
    "mainView5",
    "mainView6"
];

let textView = [
    "",
    "",
    "mainText1",
    "mainText2",
    "mainText3",
    "mainText6"
];

let myTimer = [0, 0, 0, 0, 0, 0];

function loadGallery(no) {
    let mainView = document.getElementById(slideView[no]);
    mainView.style.background = "url(" + imgObject[no][indexImg[no][1]] + ")";
    mainView.style.backgroundSize = "cover";
    mainView.style.backgroundPositionX = "50%";

    if(no > 1) {
        let mainText = document.getElementById(textView[no]);
        mainText.textContent = txtObject[no][indexTxt[no][1]];
    }
}

function scrollRight(no) {
    indexImg[no][0] = indexImg[no][1];
    indexImg[no][1] = indexImg[no][2];
    if (indexImg[no][2] >= (imgObject[no].length - 1)) {
        indexImg[no][2] = 0;
    } else {
        indexImg[no][2]++;
    }

    indexTxt[no][0] = indexTxt[no][1];
    indexTxt[no][1] = indexTxt[no][2];
    if (indexTxt[no][2] >= (indexTxt[no].length - 1)) {
        indexTxt[no][2] = 0;
    } else {
        indexTxt[no][2]++;
    }

    clearInterval(myTimer[no]);
    myTimer[no] = setInterval(function(){scrollRight(no)}, 4000);
    loadGallery(no);
}
function abcd(no) {
    indexImg[no][2] = indexImg[no][1];
    indexImg[no][1] = indexImg[no][0];
    if (indexImg[no][0] <= 0) {
        indexImg[no][0] = imgObject[no].length - 1;
    } else {
        indexImg[no][0]--;
    }

    indexTxt[no][2] = indexTxt[no][1];
    indexTxt[no][1] = indexTxt[no][0];
    if (indexTxt[no][0] <= 0) {
        indexTxt[no][0] = txtObject[no].length - 1;
    } else {
        indexTxt[no][0]--;
    }

    clearInterval(myTimer[no]);
    myTimer[no] = setInterval(function(){scrollRight(no)}, 4000);
    loadGallery(no);
}

window.addEventListener("load",function() {
    for(let i = 0; i < 6; i++){
        loadGallery(i);
        myTimer[i] = setInterval(function(){scrollRight(i)}, 4000);
    }
})

/*document.getElementById("right1").addEventListener("click", scrollRight(2));
document.getElementById("left1").addEventListener("click", scrollLeft(2));
document.getElementById("right2").addEventListener("click", scrollRight(3));
document.getElementById("left2").addEventListener("click", scrollLeft(3));
document.getElementById("right3").addEventListener("click", scrollRight(4));
document.getElementById("left3").addEventListener("click", scrollLeft(4));*/

function scrollDown(no) {
    if(no === 0) {
        document.getElementById("mainView3").scrollIntoView(true);
    }
    else if(no === 1) {
        document.getElementById("mainView4").scrollIntoView(true);
    }
    else if(no === 2) {
        document.getElementById("mainView5").scrollIntoView(true);
    }
}

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