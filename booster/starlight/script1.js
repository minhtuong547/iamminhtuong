const $$ = document.querySelectorAll.bind(document);
const $ = document.querySelector.bind(document);



(function () {
    var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
            window.setTimeout(callback, 1000 / 60);
        };
    window.requestAnimationFrame = requestAnimationFrame;
})();

// Terrain stuff.
var background = document.getElementById("bgCanvas"),
    bgCtx = background.getContext("2d"),
    width = window.innerWidth,
    height = document.body.offsetHeight;

(height < 400) ? height = 400 : height;

background.width = width;
background.height = height;

function Terrain(options) {
    options = options || {};
    this.terrain = document.createElement("canvas");
    this.terCtx = this.terrain.getContext("2d");
    this.scrollDelay = options.scrollDelay || 90;
    this.lastScroll = new Date().getTime();

    this.terrain.width = width;
    this.terrain.height = height;
    this.fillStyle = options.fillStyle || "#191D4C";
    this.mHeight = options.mHeight || height;

    // generate
    this.points = [];

    var displacement = options.displacement || 140,
        power = Math.pow(2, Math.ceil(Math.log(width) / (Math.log(2))));

    // set the start height and end height for the terrain
    this.points[0] = this.mHeight;//(this.mHeight - (Math.random() * this.mHeight / 2)) - displacement;
    this.points[power] = this.points[0];

    // create the rest of the points
    for (var i = 1; i < power; i *= 2) {
        for (var j = (power / i) / 2; j < power; j += power / i) {
            this.points[j] = ((this.points[j - (power / i) / 2] + this.points[j + (power / i) / 2]) / 2) + Math.floor(Math.random() * -displacement + displacement);
        }
        displacement *= 0.6;
    }

    document.body.appendChild(this.terrain);
}

Terrain.prototype.update = function () {
    // draw the terrain
    this.terCtx.clearRect(0, 0, width, height);
    this.terCtx.fillStyle = this.fillStyle;
    
    if (new Date().getTime() > this.lastScroll + this.scrollDelay) {
        this.lastScroll = new Date().getTime();
        this.points.push(this.points.shift());
    }

    this.terCtx.beginPath();
    for (var i = 0; i <= width; i++) {
        if (i === 0) {
            this.terCtx.moveTo(0, this.points[0]);
        } else if (this.points[i] !== undefined) {
            this.terCtx.lineTo(i, this.points[i]);
        }
    }

    this.terCtx.lineTo(width, this.terrain.height);
    this.terCtx.lineTo(0, this.terrain.height);
    this.terCtx.lineTo(0, this.points[0]);
    this.terCtx.fill();
}


// Second canvas used for the stars
bgCtx.fillStyle = '#05004c';
bgCtx.fillRect(0, 0, width, height);

// stars
function Star(options) {
    this.size = Math.random() * 2;
    this.speed = Math.random() * .05;
    this.x = options.x;
    this.y = options.y;
}

Star.prototype.reset = function () {
    this.size = Math.random() * 2;
    this.speed = Math.random() * .05;
    this.x = width;
    this.y = Math.random() * height;
}

Star.prototype.update = function () {
    this.x -= this.speed;
    if (this.x < 0) {
        this.reset();
    } else {
        bgCtx.fillRect(this.x, this.y, this.size, this.size);
    }
}

function ShootingStar() {
    this.reset();
}

ShootingStar.prototype.reset = function () {
    this.x = Math.random() * width;
    this.y = 0;
    this.len = (Math.random() * 80) + 10;
    this.speed = (Math.random() * 10) + 6;
    this.size = (Math.random() * 1) + 0.1;
    // this is used so the shooting stars arent constant
    this.waitTime = new Date().getTime() + (Math.random() * 3000) + 500;
    this.active = false;
}

ShootingStar.prototype.update = function () {
    if (this.active) {
        this.x -= this.speed;
        this.y += this.speed;
        if (this.x < 0 || this.y >= height) {
            this.reset();
        } else {
            bgCtx.lineWidth = this.size;
            bgCtx.beginPath();
            bgCtx.moveTo(this.x, this.y);
            bgCtx.lineTo(this.x + this.len, this.y - this.len);
            bgCtx.stroke();
        }
    } else {
        if (this.waitTime < new Date().getTime()) {
            this.active = true;
        }
    }
}

var entities = [];

// init the stars
for (var i = 0; i < height; i++) {
    entities.push(new Star({
        x: Math.random() * width,
        y: Math.random() * height
    }));
}

// Add 2 shooting stars that just cycle.
entities.push(new ShootingStar());
entities.push(new ShootingStar());
entities.push(new Terrain({mHeight : (height/2)-120}));
entities.push(new Terrain({displacement : 120, scrollDelay : 50, fillStyle : "rgb(17,20,40)", mHeight : (height/2)-60}));
entities.push(new Terrain({displacement : 100, scrollDelay : 20, fillStyle : "rgb(10,10,5)", mHeight : height/2}));

//animate background
function animate() {
    bgCtx.fillStyle = '#110E19';
    bgCtx.fillRect(0, 0, width, height);
    bgCtx.fillStyle = '#ffffff';
    bgCtx.strokeStyle = '#ffffff';

    var entLen = entities.length;

    while (entLen--) {
        entities[entLen].update();
    }
    requestAnimationFrame(animate);
}
animate();



//MUSIC

// khai bÄ‚Â¡o hĂ¡ÂºÂ±ng, mĂ¡ÂºÂ£ng mp3
const audio = $('#audio')
const back = $("#back-btn")
const play = $('#play-btn')
const pause = $('#pause-btn')
const next = $("#next-btn")
const nameSong = $$(".name-music")
const nameHead = $(".head")
const nameSinger = $(".singer-name")
const photo = $("#img")
const playList = [
  {
    src: "https://docs.google.com/uc?id=1UNB7dNqhFsLx75VhTdopXHY8_DfxkqCj",
    nameSong: " Anh Sẽ Quên Em Mặc ",
    singer: "NIT ft Sing",
    img: "https://i.ytimg.com/vi/tYNX2E6v6jU/maxresdefault.jpg"
  },
  {
    src: "https://docs.google.com/uc?id=1rTbe4CAtdZtNJW45YYVmM4iRGgyWknek",
    nameSong: "Như Anh Đã Thấy Em",
    singer: "Phúc XP x Freak D",
    img: "https://i.ytimg.com/vi/cPbp2iFaZRo/maxresdefault.jpg"
  },
  {
    src: "https://docs.google.com/uc?id=19cgPNeBHCE0Y2IHFUzeMXZeUqHztcjfa",
    nameSong: " Anh Mất Rồi",
    singer: "Anh Quân Idol x Freak D",
    img: "https://i.ytimg.com/vi/wAQnEYVcOq4/maxresdefault.jpg"
  },
  {
    src: "https://docs.google.com/uc?id=1vfPfZEPp1a1ET0o5hlwWveDQqg1sBgBD",
    nameSong: " Chúng Ta Của Sau Này",
    singer: "T.R.I",
    img: "https://avatar-ex-swe.nixcdn.com/song/share/2021/01/27/f/1/e/c/1611738359456.jpg"
  },
  {
    src: "https://docs.google.com/uc?id=1ZzasujV0Tx_AgChk3keAuhYbQtqxYzwJ",
    nameSong: " Hết Thương Cần Nhơ",
    singer: "Đức Phúc",
    img: "https://i.ytimg.com/vi/DZDYZ9nRHfU/maxresdefault.jpg"
  },
  {
    src: "https://docs.google.com/uc?id=1buTVuRLw1ueBVOPpAEfoqDSnNofk1ujT",
    nameSong: " Đừng Lo Anh Đợi Mặc",
    singer: "Mr.Siro",
    img: "https://i.ytimg.com/vi/BnWiFq0AxQc/maxresdefault.jpg"
  },
  {
    src: "https://docs.google.com/uc?id=1rTaKks2apWEtTNc3j3yjsFKcvrIzfOuj",
    nameSong: " Hoa Nở Không Màu",
    singer: "Hoài Lâm x Freak D",
    img: "https://i.ytimg.com/vi/y_6aSG2yfe8/mqdefault.jpg"
  },
  {
    src: "https://docs.google.com/uc?id=11sVPdPuYiu3qj4nAJ-fVC4Kb1Ghfk542",
    nameSong: " Mùa Hạ Năm Ấy",
    singer: "Linh",
    img: "https://i.ytimg.com/vi/bbiXiY_Ec_c/sddefault.jpg"
  },
  {
    src: "https://docs.google.com/uc?id=1DhBBfSQAfkMBZWVD9c1E0CgAJkqSdKga",
    nameSong: " Sinh Ra Đã Là Thứ Đối Lập Nhau",
    singer: "Emcee L (Da LAB) ft. Badbies",
    img: "https://i.ytimg.com/vi/redFrGBZoJY/maxresdefault.jpg"
  },
  {
    src: "https://docs.google.com/uc?id=13TRTZeVK2XilUrkVYuNW--xegnlqe6IB",
    nameSong: "Yêu Một Người Có Lẽ",
    singer: " Lou Hoàng - Miu Lê",
    img: "https://i.ytimg.com/vi/w2DBMrXJDIo/sddefault.jpg"
  }
]


const textclip = $(".text-box")

function audioPlay(){
    audio.play();
    play.style.display = 'none'
    pause.style.display = 'block'
    textclip.classList.add("move")
    nameHead.textContent = playList[i].nameSong
}


function audioPause(){
    audio.pause();
    pause.style.display = 'none'
    play.style.display = 'block'
    textclip.classList.remove("move")
}

function audioNext(){
    i++;
    if( i >= playList.length ){
        i = 0;
    } 
    audio.src = playList[i].src
    nameSinger.textContent = playList[i].singer
    for( let j = 0 ; j < nameSong.length; j++){
        nameSong[j].textContent = playList[i].nameSong
    }
    photo.src = playList[i].img
    nameHead.textContent = playList[i].nameSong
    textclip.classList.add("move")
    audioPlay();
}

function audioBack(){
    i--;
    if( i < 0 ){
        i = playList.length -1 ;
    }
    audio.src = playList[i].src
    nameSinger.textContent = playList[i].singer
    for( let j = 0 ; j < nameSong.length; j++){
        nameSong[j].textContent = playList[i].nameSong
    }
    photo.src = playList[i].img
    nameHead.textContent = playList[i].nameSong
    textclip.classList.add("move")
    audioPlay();
}



play.addEventListener("click", audioPlay);// click play
pause.addEventListener("click", audioPause); //click pause

// xĂ¡Â»Â­ lÄ‚Â­ next / back mp3
var i = 0;
    audio.src = playList[i].src
    nameSinger.textContent = playList[i].singer
    for( let j = 0 ; j < nameSong.length; j++){
        nameSong[j].textContent = playList[i].nameSong
    }
    photo.src = playList[i].img


    // xĂ¡Â»Â­ lÄ‚Â­ Ă¡ÂºÂ¥n phÄ‚Â­m Space, Left, Right ( Play/Pause, Back, Next)
    function keydownHandler(evt) {
        if( audio.paused && evt.keyCode == 32){
            audioPlay();
        }
        else if(audio.play && evt.keyCode == 32){
            audioPause();
        };
        if (evt.keyCode == 39){
            audioNext();
        }
        else if (evt.keyCode == 37){
            audioBack();
        }
    }


    next.addEventListener("click", audioNext);// click next
    back.addEventListener("click", audioBack); // click back

    // next khi kĂ¡ÂºÂ¿t thÄ‚Âºc  mp3
    audio.onended = function(){
        next.click();
    }


 
    // random link mp3
//    function random() {
    
//     var ran = Math.floor(Math.random() * 3);
//     var src = playList[ran]
//     console.log(src)
//     audio.src= src;
//    }