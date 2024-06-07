
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" href="https://i.imgur.com/vkdfdBq.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title class="head">Đinh Minh Tướng Starlight</title>
</head>
<body onkeydown="keydownHandler(event)">
  <canvas id="bgCanvas"></canvas>
  <div class="main">
    <div class="container">
      <div class="center">
        <div class="avt">
          <img src="https://i.imgur.com/5dzxzeC.jpg" alt="">         
        </div>
        <div class="name">
          <span><a href="/">@minhtuong547</a></span>  
        </div>
      </div>
      <div class="row">
        <div class="icon">
          <a href="https://www.facebook.com/DoMoTo.IT" target="_blank" class="facebook">
            <img src="./icon/icons8-facebook-100.png" alt="">
          </a>
          <a href="https://www.tiktok.com/@minhtuongdeptrai" target="_blank" class="tiktok">
            <img src="./icon/icons8-tiktok-100.png" alt="">
          </a>
          <a href="https://www.instagram.com/domoto.it/" target="_blank" class="instagram">
            <img src="./icon/icons8-instagram-100.png" alt="">
          </a>
          <a href="https://github.com/minhtuong547" target="_blank" class="github">
            <img src="./icon/icons8-github-100.png" alt="">
          </a>
        </div>
      </div>
      
    </div>
    <div class="display">
      <div class="photo-music">
        <img src="" alt="" id="img">
      </div>
      <div class="text">
        <div class="text-box">
          <div class="name-music"></div>
          <div class="name-music"></div>
        </div>
      </div>
      <i class="singer-name"></i>
    </div>
    <div class="player">
      <i id="back-btn" class="fa-solid fa-backward control-btn "></i>
      <i id="play-btn" class=" fa-solid fa-play control-btn big " ></i>
      <i id="pause-btn" class=" fa-solid fa-pause control-btn big " ></i>
      <i id="next-btn" class="fa-solid fa-forward control-btn "></i>
      <audio id="audio" preload="metadata" type="audio/mp3" src=""></audio>
      
    </div>
  </div>
    <script src="./script1.js">    
	     
    </script>
</body>
</html>
