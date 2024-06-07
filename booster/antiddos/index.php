<title>Crow Services</title>

<html style="background-color:#272d47;">

<html>
<head>
        
</head>
<body>

<center>
<div id="container" style="max-width: 1px; height: 1px; margin: 0 auto; margin-top: 15px;"></div>
<br>
<a href='https://t.me/leanhtuan19'><img height=100px width=100px src='https://i.imgur.com/5dzxzeC.jpg'/>
<br>
<br>
<font color="#00FFCC">ANTI DDOS BY:<font color="#FFCCCC"> iamminhtuong.vn </a></font></font><br /><br />


<div id="layer7"></div>
<br/>
<div id="layer4"></div>
<br/>

<script src="https://cdn.staticfile.org/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/1426239465/music/musictc/Music.min.js"></script>
<script>
  var RENDERER={POINT_INTERVAL:5,FISH_COUNT:4,MAX_INTERVAL_COUNT:50,INIT_HEIGHT_RATE:0.5,THRESHOLD:50,init:function(){this.setParameters();this.reconstructMethods();this.setup();this.bindEvent();this.render()},setParameters:function(){this.$window=$(window);this.$container=$("#jsi-flying-fish-container");this.$canvas=$("<canvas />");this.context=this.$canvas.appendTo(this.$container).get(0).getContext("2d");this.points=[];this.fishes=[];this.watchIds=[]},createSurfacePoints:function(){var count=Math.round(this.width/this.POINT_INTERVAL);this.pointInterval=this.width/(count-1);this.points.push(new SURFACE_POINT(this,0));for(var i=1;i<count;i++){var point=new SURFACE_POINT(this,i*this.pointInterval),previous=this.points[i-1];point.setPreviousPoint(previous);previous.setNextPoint(point);this.points.push(point)}},reconstructMethods:function(){this.watchWindowSize=this.watchWindowSize.bind(this);this.jdugeToStopResize=this.jdugeToStopResize.bind(this);this.startEpicenter=this.startEpicenter.bind(this);this.moveEpicenter=this.moveEpicenter.bind(this);this.reverseVertical=this.reverseVertical.bind(this);this.render=this.render.bind(this)},setup:function(){this.points.length=0;this.fishes.length=0;this.watchIds.length=0;this.intervalCount=this.MAX_INTERVAL_COUNT;this.width=this.$container.width();this.height=this.$container.height();this.fishCount=this.FISH_COUNT*this.width/500*this.height/500;this.$canvas.attr({width:this.width,height:this.height});this.reverse=false;this.fishes.push(new FISH(this));this.createSurfacePoints()},watchWindowSize:function(){this.clearTimer();this.tmpWidth=this.$window.width();this.tmpHeight=this.$window.height();this.watchIds.push(setTimeout(this.jdugeToStopResize,this.WATCH_INTERVAL))},clearTimer:function(){while(this.watchIds.length>0){clearTimeout(this.watchIds.pop())}},jdugeToStopResize:function(){var width=this.$window.width(),height=this.$window.height(),stopped=(width==this.tmpWidth&&height==this.tmpHeight);this.tmpWidth=width;this.tmpHeight=height;if(stopped){this.setup()}},bindEvent:function(){this.$window.on("resize",this.watchWindowSize);this.$container.on("mouseenter",this.startEpicenter);this.$container.on("mousemove",this.moveEpicenter);this.$container.on("click",this.reverseVertical)},getAxis:function(event){var offset=this.$container.offset();return{x:event.clientX-offset.left+this.$window.scrollLeft(),y:event.clientY-offset.top+this.$window.scrollTop()}},startEpicenter:function(event){this.axis=this.getAxis(event)},moveEpicenter:function(event){var axis=this.getAxis(event);if(!this.axis){this.axis=axis}this.generateEpicenter(axis.x,axis.y,axis.y-this.axis.y);this.axis=axis},generateEpicenter:function(x,y,velocity){if(y<this.height/2-this.THRESHOLD||y>this.height/2+this.THRESHOLD){return}var index=Math.round(x/this.pointInterval);if(index<0||index>=this.points.length){return}this.points[index].interfere(y,velocity)},reverseVertical:function(){this.reverse=!this.reverse;for(var i=0,count=this.fishes.length;i<count;i++){this.fishes[i].reverseVertical()}},controlStatus:function(){for(var i=0,count=this.points.length;i<count;i++){this.points[i].updateSelf()}for(var i=0,count=this.points.length;i<count;i++){this.points[i].updateNeighbors()}if(this.fishes.length<this.fishCount){if(--this.intervalCount==0){this.intervalCount=this.MAX_INTERVAL_COUNT;this.fishes.push(new FISH(this))}}},render:function(){requestAnimationFrame(this.render);this.controlStatus();this.context.clearRect(0,0,this.width,this.height);this.context.fillStyle="hsl(0, 0%, 95%)";for(var i=0,count=this.fishes.length;i<count;i++){this.fishes[i].render(this.context)}this.context.save();this.context.globalCompositeOperation="xor";this.context.beginPath();this.context.moveTo(0,this.reverse?0:this.height);for(var i=0,count=this.points.length;i<count;i++){this.points[i].render(this.context)}this.context.lineTo(this.width,this.reverse?0:this.height);this.context.closePath();this.context.fill();this.context.restore()}};var SURFACE_POINT=function(renderer,x){this.renderer=renderer;this.x=x;this.init()};SURFACE_POINT.prototype={SPRING_CONSTANT:0.03,SPRING_FRICTION:0.9,WAVE_SPREAD:0.3,ACCELARATION_RATE:0.01,init:function(){this.initHeight=this.renderer.height*this.renderer.INIT_HEIGHT_RATE;this.height=this.initHeight;this.fy=0;this.force={previous:0,next:0}},setPreviousPoint:function(previous){this.previous=previous},setNextPoint:function(next){this.next=next},interfere:function(y,velocity){this.fy=this.renderer.height*this.ACCELARATION_RATE*((this.renderer.height-this.height-y)>=0?-1:1)*Math.abs(velocity)},updateSelf:function(){this.fy+=this.SPRING_CONSTANT*(this.initHeight-this.height);this.fy*=this.SPRING_FRICTION;this.height+=this.fy},updateNeighbors:function(){if(this.previous){this.force.previous=this.WAVE_SPREAD*(this.height-this.previous.height)}if(this.next){this.force.next=this.WAVE_SPREAD*(this.height-this.next.height)}},render:function(context){if(this.previous){this.previous.height+=this.force.previous;this.previous.fy+=this.force.previous
}if(this.next){this.next.height+=this.force.next;this.next.fy+=this.force.next}context.lineTo(this.x,this.renderer.height-this.height)}};var FISH=function(renderer){this.renderer=renderer;this.init()};FISH.prototype={GRAVITY:0.4,init:function(){this.direction=Math.random()<0.5;this.x=this.direction?(this.renderer.width+this.renderer.THRESHOLD):-this.renderer.THRESHOLD;this.previousY=this.y;this.vx=this.getRandomValue(4,10)*(this.direction?-1:1);if(this.renderer.reverse){this.y=this.getRandomValue(this.renderer.height*1/10,this.renderer.height*4/10);this.vy=this.getRandomValue(2,5);this.ay=this.getRandomValue(0.05,0.2)}else{this.y=this.getRandomValue(this.renderer.height*6/10,this.renderer.height*9/10);this.vy=this.getRandomValue(-5,-2);this.ay=this.getRandomValue(-0.2,-0.05)}this.isOut=false;this.theta=0;this.phi=0},getRandomValue:function(min,max){return min+(max-min)*Math.random()},reverseVertical:function(){this.isOut=!this.isOut;this.ay*=-1},controlStatus:function(context){this.previousY=this.y;this.x+=this.vx;this.y+=this.vy;this.vy+=this.ay;if(this.renderer.reverse){if(this.y>this.renderer.height*this.renderer.INIT_HEIGHT_RATE){this.vy-=this.GRAVITY;this.isOut=true}else{if(this.isOut){this.ay=this.getRandomValue(0.05,0.2)}this.isOut=false}}else{if(this.y<this.renderer.height*this.renderer.INIT_HEIGHT_RATE){this.vy+=this.GRAVITY;this.isOut=true}else{if(this.isOut){this.ay=this.getRandomValue(-0.2,-0.05)}this.isOut=false}}if(!this.isOut){this.theta+=Math.PI/20;this.theta%=Math.PI*2;this.phi+=Math.PI/30;this.phi%=Math.PI*2}this.renderer.generateEpicenter(this.x+(this.direction?-1:1)*this.renderer.THRESHOLD,this.y,this.y-this.previousY);if(this.vx>0&&this.x>this.renderer.width+this.renderer.THRESHOLD||this.vx<0&&this.x<-this.renderer.THRESHOLD){this.init()}},render:function(context){context.save();context.translate(this.x,this.y);context.rotate(Math.PI+Math.atan2(this.vy,this.vx));context.scale(1,this.direction?1:-1);context.beginPath();context.moveTo(-30,0);context.bezierCurveTo(-20,15,15,10,40,0);context.bezierCurveTo(15,-10,-20,-15,-30,0);context.fill();context.save();context.translate(40,0);context.scale(0.9+0.2*Math.sin(this.theta),1);context.beginPath();context.moveTo(0,0);context.quadraticCurveTo(5,10,20,8);context.quadraticCurveTo(12,5,10,0);context.quadraticCurveTo(12,-5,20,-8);context.quadraticCurveTo(5,-10,0,0);context.fill();context.restore();context.save();context.translate(-3,0);context.rotate((Math.PI/3+Math.PI/10*Math.sin(this.phi))*(this.renderer.reverse?-1:1));context.beginPath();if(this.renderer.reverse){context.moveTo(5,0);context.bezierCurveTo(10,10,10,30,0,40);context.bezierCurveTo(-12,25,-8,10,0,0)}else{context.moveTo(-5,0);context.bezierCurveTo(-10,-10,-10,-30,0,-40);context.bezierCurveTo(12,-25,8,-10,0,0)}context.closePath();context.fill();context.restore();context.restore();this.controlStatus(context)}};$(function(){RENDERER.init()});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.2/highcharts.js"
        integrity="sha512-PpL09bLaSaj5IzGNx6hsnjiIeLm9bL7Q9BB4pkhEvQSbmI0og5Sr/s7Ns/Ax4/jDrggGLdHfa9IbsvpnmoZYFA=="
        crossorigin="anonymous"></script>
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.2/modules/exporting.min.js"
        integrity="sha512-DuFO4JhOrZK4Zz+4K0nXseP0K/daLNCrbGjSkRzK+Zibkblwqc0BYBQ1sTN7mC4Kg6vNqr8eMZwLgTcnKXF8mg=="
        crossorigin="anonymous"
></script>

<script id="source" language="javascript" type="text/javascript">
    $(document).ready(function () {
        Highcharts.createElement(
            "link",
            {
                href: "https://fonts.googleapis.com/css?family=Unica+One",
                rel: "stylesheet",
                type: "text/css",
            },
            null,
            document.getElementsByTagName("head")[0]
        );

        let layer7 = new Highcharts.Chart({
            chart: {
                renderTo: "layer7",
                defaultSeriesType: "area",
                width:930,
                marginLeft:90,
                marginRight:50,
                spacing: [30, 0, 25, 0],
                events: {
                    load: requestData(0),
                },
                backgroundColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 0 },
                            stops: [
                                [0, '#111538'],
                                [1, '#111538']
                            ]
                },
                 style: {
                            fontFamily: "'Unica One', sans-serif"
                        },
                        plotBorderColor: '#111538',                                                                                        
            },
            title: {
                text: "HIT ==> https://crowstore.online/ PORT 443 <==",
                style: {
            color: 'white',
            textTransform: 'uppercase',
            fontWeight: 'bold',
            fontSize: '27px'
                     
        }
            },
            xAxis: {
                type: "datetime",
                tickPixelInterval: 150,
                maxZoom: 20 * 1000,
                
            },
           
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: "Requests per second ",
                    margin: 80,
                },
            },
            colors: ['#7267e6'],
            credits: {
        enabled: false
        },
           
            series: [
                {
                    name: "Requests/s",
                    data: [],
                },
            ],
        });
           
               
        function requestData(type) {
            $.ajax({
                url: "data/" + (!type ? "layer7" : "layer4") + ".php",
                success: function (point) {
                    var series = (!type ? layer7 : layer4).series[0],
                        shift = series.data.length > 20;
                    var total = 0;
                    var maxData = 0;
                    series.addPoint(point, true, shift);
                    // Tính tổng và lưu giữ giá tr này vào Local Storage
                    total = series.data.reduce(function(total, dataPoint) {
                        return total + dataPoint.y;
            }, 0);
            var maxDataPoint = series.data.reduce(function(maxDataPoint, dataPoint) {
                return dataPoint.y > maxDataPoint.y ? dataPoint : maxDataPoint;
            }, { y: -Infinity });
            maxData = maxDataPoint.y;
            
                   

            // Hiển thị tng trên biểu đồ
            layer7.setTitle({
                text: 'HIT ==> http://iamminhtuong.vn/ PORT 443 <=='
          
            });
               document.getElementById('total-value').innerHTML = total;
               document.getElementById('max-value').innerHTML = maxData;

            
            
                    setTimeout(() => requestData(type), 600);
                },
                cache: false,
            });
        }
    });

</script>

<style type="text/css" media="screen">
a:link { color:#ffffff; text-decoration: none; }
a:visited { color:#ffffff; text-decoration: none; }
a:hover { color:#ffffff; text-decoration: none; }
a:active { color:#ffffff; text-decoration: underline; }
.circle-container {
	position: fixed;
	bottom: 76px;
	right: 14px;
	height: 48px;
	width: 48px;
	border-radius: 48px;
	box-shadow: 0 4px 32px 0 rgba(0, 0, 0, .175);
	transition: transform .15s ease-in-out, box-shadow .15s ease-in-out;
	cursor: pointer;
	z-index: 999
}

.circle-container:hover {
	transform: scale(1.05);
	box-shadow: 0 4px 42px 0 rgba(0, 0, 0, .25)
}

.circle-icon-discord {
	background-image: url(https://i.imgur.com/zbaKre7.png);
	background-color: #7186cc;
	display: block;
	width: 100%;
	height: 100%;
	border-radius: 60px;
	background-size: cover;
	background-repeat: no-repeat
}

.header-logo-image-footer {
	position: absolute;
top: -5px;
left: -45px;
height: 140px;
}

.label {
    color: white; /* màu chữ*/
    font-weight: bold;
    font-size: 35px;
}

.total-value {
    color: white; /* màu total */
    font-weight: bold;
    font-size: 35px;
}

.max-value {
    color: white; /* màu peak req */
    font-weight: bold;
    font-size: 35px;
}

@media screen and (min-width:560px) {
	.circle-container {
		height: 60px;
		width: 60px;
		border-radius: 60px;
		bottom: 104px;
		right: 24px
	}
}

</style>
    </head>
<body>

<div style="font-size: 35px">
<script type="text/javascript">
farbbibliothek = new Array();
farbbibliothek[0] = new Array("#FF0000","#FF1100","#FF2200","#FF3300","#FF4400","#FF5500","#FF6600","#FF7700","#FF8800","#FF9900","#FFaa00","#FFbb00","#FFcc00","#FFdd00","#FFee00","#FFff00","#FFee00","#FFdd00","#FFcc00","#FFbb00","#FFaa00","#FF9900","#FF8800","#FF7700","#FF6600","#FF5500","#FF4400","#FF3300","#FF2200","#FF1100");
farbbibliothek[1] = new Array("#00FF00","#000000","#00FF00","#00FF00");
farbbibliothek[2] = new Array("#00FF00","#FF0000","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00");
farbbibliothek[3] = new Array("#FF0000","#FF4000","#FF8000","#FFC000","#FFFF00","#C0FF00","#80FF00","#40FF00","#00FF00","#00FF40","#00FF80","#00FFC0","#00FFFF","#00C0FF","#0080FF","#0040FF","#0000FF","#4000FF","#8000FF","#C000FF","#FF00FF","#FF00C0","#FF0080","#FF0040");
farbbibliothek[4] = new Array("#FF0000","#EE0000","#DD0000","#CC0000","#BB0000","#AA0000","#990000","#880000","#770000","#660000","#550000","#440000","#330000","#220000","#110000","#000000","#110000","#220000","#330000","#440000","#550000","#660000","#770000","#880000","#990000","#AA0000","#BB0000","#CC0000","#DD0000","#EE0000");
farbbibliothek[5] = new Array("#000000","#000000","#000000","#FFFFFF","#FFFFFF","#FFFFFF");
farbbibliothek[6] = new Array("#0000FF","#FFFF00");
farben = farbbibliothek[4];
function farbschrift(){for(var b=0;b<Buchstabe.length;b++){document.all["a"+b].style.color=farben[b]}farbverlauf()}function string2array(b){Buchstabe=new Array();while(farben.length<b.length){farben=farben.concat(farben)}k=0;while(k<=b.length){Buchstabe[k]=b.charAt(k);k++}}function divserzeugen(){for(var b=0;b<Buchstabe.length;b++){document.write("<span id='a"+b+"' class='a"+b+"'>"+Buchstabe[b]+"</span>")}farbschrift()}var a=1;function farbverlauf(){for(var b=0;b<farben.length;b++){farben[b-1]=farben[b]}farben[farben.length-1]=farben[-1];setTimeout("farbschrift()",30)}var farbsatz=1;function farbtauscher(){farben=farbbibliothek[farbsatz];while(farben.length<text.length){farben=farben.concat(farben)}farbsatz=Math.floor(Math.random()*(farbbibliothek.length-0.0001))}setInterval("farbtauscher()",5000);

text= "HIGH PROTECTION"; //h
string2array(text);
divserzeugen();
//document.write(text);
</script></div>

<p><span class="label">Total Requests:</span> <span id="total-value" class="total-value"></span>, <span class="label"> |  Peak Requests:</span> <span id="max-value" class="max-value"></span></p> 


<p style="margin-bottom: 45px;"></p>


</html>

<div id="jsi-flying-fish-container"></div><br><br>
<footer style="text-align: center; font-size: 40px; background-color: #272d47; color: white;">All rights reserved by <a href="https://www.facebook.com/latvnnb">Đinh Minh Tướng</a> - © 2023<br></footer>

</body>

</body>
</html>