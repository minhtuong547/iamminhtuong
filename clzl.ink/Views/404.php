<?php
header("HTTP/1.1 404 Not Found");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>SEX-TOOL</title>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		
		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	<style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }
        body {
            /* display: flex; */
            justify-content: center;
            /* min-height: 10vh; */
            background: black;
            align-items: center;
            margin-top: 100px;
        }
        a {
			margin-top: 5%;
            position: relative;
            display: inline-block;
            padding: 10px 30px;
            text-decoration: none;
            color: #fff;
            background: #262c37;
            font-size: 40px;
            transition: 0.5s;
			
        }
        a:hover {
            color: #2894ff;
        }
        a span {
            display: block;
            position: absolute;
            background: #2894ff;
        }
        a span:nth-child(1){
            left: 0;
            bottom: 0;
            width: 1px;
            height: 100%;
            transform: scaleY(0);
            transform-origin: bottom;
            transition: 0.5s;
            transition-delay: 0.5s;
        }
        a:hover span:nth-child(1){
            transform: scaleY(1);
            transform-origin: bottom;
            transition: 0.5s;
        }
        a span:nth-child(2){
            left: 0;
            bottom: 0;
            width: 100%;
            height: 1px;
            transform: scaleX(0);
            transform-origin: left;
            transition: 0.5s;
            transition-delay: 0.5s;
        }
        a:hover span:nth-child(2){
            transform: scaleX(1);
            transform-origin: left;
            transition: 0.5s;
        }
        a span:nth-child(3){
            right: 0;
            bottom: 0;
            width: 1px;
            height: 100%;
            transform: scaleY(0);
            transform-origin: bottom;
            transition: 0.5s;
            
        }
        a:hover span:nth-child(3){
            transform: scaleY(1);
            transform-origin: bottom;
            transition: 0.5s;
            transition-delay: 0.5s;
        }
        a span:nth-child(4){
            left: 0;
            top: 0;
            width: 100%;
            height: 1px;
            transform: scaleX(0);
            transform-origin: left;
            transition: 0.5s;
        }
        a:hover span:nth-child(4){
            transform: scaleX(1);
            transform-origin: left;
            transition: 0.5s;
            transition-delay: 0.5s;
        }
        h3,p,h6 {
            color: #fff;
			margin-top: 0;
  			margin-bottom: .5rem;
			font-size: 30px;
        }
		h1 {
            color: #fff;
			margin-top: 0;
  			margin-bottom: .5rem;
			font-size: 90px;
        }
		.d-flex {
  			display: -ms-flexbox !important;
  			display: -webkit-box !important;
  			display: flex !important; 
		}
		.align-items-center {
  			-ms-flex-align: center !important;
  			-webkit-box-align: center !important;
  			align-items: center !important; 
		}
		.justify-content-center {
  			-ms-flex-pack: center !important;
  			-webkit-box-pack: center !important;
  			justify-content: center !important; 
		}
		.text-center {
  			text-align: center !important;
			margin-top: 10%;
		}
        .container {
            position:relative;
            width: 100%;
            display:flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }
        .container .ring {
            position:relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid transparent;
            border-top: 4px solid #24ecff;
            animation: animate 4s linear infinite;
        }
        @keyframes animate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        .container .ring::before {
            content: '';
            position:absolute;
            top: 12px;
            right: 12px;
            border-radius: 50%;
            width: 15px;
            height: 15px;
            background: #24ecff;
            box-shadow: 0 0 0 5px #24ecff33,
            0 0 0 10px #24ecff22,
            0 0 0 20px #24ecff11,
            0 0 20px #24ecff33,
            0 0 50px #24ecff33;
        }
        .container .ring:nth-child(2) {
            animation: animate2 4s linear infinite;
            animation-delay: -1s;
            border-top: 4px solid transparent;
            border-left: 4px solid #93ff2d;
        }
        .container .ring:nth-child(2)::before {
            content: '';
            position:absolute;
            top:initial;
            bottom: 12px;
            left: 12px;
            border-radius: 50%;
            width: 15px;
            height: 15px;
            background: #93ff2d;
            box-shadow: 0 0 0 5px #93ff2d33,
            0 0 0 10px #93ff2d22,
            0 0 0 20px #93ff2d11,
            0 0 20px #93ff2d33,
            0 0 50px #93ff2d33;
        }
        @keyframes animate2 {
            0% {
                transform: rotate(360deg);
            }
            100% {
                transform: rotate(0deg);
            }
        }
        .container .ring:nth-child(3){
            animation: animate2 4s linear infinite;
            animation-delay: -3s;
            position:absolute;
            top: -66.66px;
            border-top: 4px solid transparent;
            border-left: 4px solid #e41cf8;
        }
        .container .ring:nth-child(3)::before {
            content: '';
            position:absolute;
            top:initial;
            bottom: 12px;
            left: 12px;
            border-radius: 50%;
            width: 15px;
            height: 15px;
            background: #e41cf8;
            box-shadow: 0 0 0 5px #e41cf833,
            0 0 0 10px #e41cf822,
            0 0 0 20px #e41cf811,
            0 0 20px #e41cf833,
            0 0 50px #e41cf833;
        }
    </style>
<body>
    <div class="container">
        <div class="ring"></div>
        <div class="ring"></div>
        <div class="ring"></div>
    </div>
    <center>
        <p>404 Not Found</p>
        <h6>Sex Coder</h6>
        <a href="/" class="btn">
            Go Back Home
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            
        </a>
    </center>
 
</body>
</html>