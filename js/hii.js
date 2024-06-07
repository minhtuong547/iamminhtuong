! function() {
    function f() {
        var a = document.createElement("div");
        a.id = "levelmaxblock";
        a.innerHTML = '<div class="inner"><div class="header"><h2 style="color:#fff;">Đã phát hiện Ad Blocker</h2></div>   <img src="https://thangdangblog.com/wp-content/plugins/chp-ads-block-detector/assets/img/icon.png" alt="Block ads" width="300" height="300"> <p>Vui lòng tắt trình chặn quảng cáo của bạn để tiếp tục!</p><div class="tombol"><button type="button" onclick="tai_lai_trang()">Reset</button></div><div class="caranya"><div class="1 active"><ol><li>Xin lỗi vì sự bất tiện này. Blog của mình hoạt động dựa trên những quảng cáo được đặt trên trang. Bạn đọc vui lòng ủng hộ mình bằng cách tắt tiện ích chặn quảng cáo của trình duyệt nhé!</li></ol></div></div></div>';
        document.body.append(a);
        document.body.style.overflow = "hidden";
        var b = a.querySelectorAll("button");
        a.querySelector(".close");
        var d = a.querySelectorAll(".caranya > div");
        for (a = 0; a < b.length; a++) b[a].addEventListener("click", function(a) {
            a.preventDefault();
            a = this.getAttribute("class").split(" ")[0];
            for (var c = 0; c < d.length; c++) d[c].classList.remove("active"), b[c].classList.remove("active");
            b[a - 1].classList.add("active");
            d[a - 1].classList.add("active")
        })
    }
       
        function tai_lai_trang(){
            location.reload();
        }

    var b = document.createElement("script");
    b.type = "text/javascript";
    b.async = !0;
    b.src = "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js";
    b.onerror = function() {
        f();
        window.adblock = !0
    };
    var e = document.getElementsByTagName("script")[0];
    e.parentNode.insertBefore(b, e)
    
      