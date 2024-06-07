console.log('%c* Chúc mừng bạn đã mở khóa thành công!', 'color: red; font-size: 50px; font-family: sans-serif; text-shadow: 1px 1px 5px #000;');
console.log('%c- Có vẻ như bạn đang cố tính ăn cắp mã nguồn khanhdev.ddns.net của tôi.', 'color: #444; font-size: 25px; font-family: sans-serif;');
console.log('%c- Đó là hành vi không tốt, liên hệ Facebook để xin mã nguồn.\n', 'color: #444; font-size: 25px; font-family: sans-serif;');

function star() {
    setTimeout(function () {
    }, 3000);
}

function show_date_time() {
    window.setTimeout("show_date_time()", 1000);
    BirthDay = new Date("2023/05/09");
    today = new Date();
    timeold = (today.getTime() - BirthDay.getTime());
    sectimeold = timeold / 1000
    secondsold = Math.floor(sectimeold);
    msPerDay = 24 * 60 * 60 * 1000
    e_daysold = timeold / msPerDay
    daysold = Math.floor(e_daysold);
    e_hrsold = (daysold - e_daysold) * -24;
    hrsold = Math.floor(e_hrsold);
    e_minsold = (hrsold - e_hrsold) * -60;
    minsold = Math.floor((hrsold - e_hrsold) * -60);
    seconds = Math.floor((minsold - e_minsold) * -60);
    momk.innerHTML = daysold + " ngày " + hrsold + " giờ " + minsold + " phút " + seconds + " giây";
}

show_date_time();
