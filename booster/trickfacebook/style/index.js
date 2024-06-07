//[VIEWS COUNTER]
function updateCounter() {
fetch('https://api.countapi.xyz/update/uimonk/youtubechannel/?amount=1')
.then(res => res.json())
.then(data => counterElement.innerHTML = data.value)
}
updateCounter()
counterElement = document.getElementsByClassName('count')[0];

//[TYPING TEXTS]
let typed = new Typed(".auto-input", {
strings: ["SUBSCRIBE TO", "VUONG THANH DIEU"],
typeSpeed: 100,
backSpeed: 100,
loop: true
})

//[LOADER]
$(window).load(function() {
$(".loader").delay(1000).fadeOut("slow");
})

function dialogue() {
    window.setTimeout(function() {
        alert('\n© Vuong Thanh Dieu 2021-2022')
    }, 500);
}