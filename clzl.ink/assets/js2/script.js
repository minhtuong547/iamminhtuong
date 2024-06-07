let settings, contact = new Array,
    next_reset = (new Date).getTime(),
    ends = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
    noti_win = [],
    noti_wined = [];
var hash = $("input[name=main_session]").val();

function getRndInteger(t, e) {
    return Math.floor(Math.random() * (e - t)) + t
}
Number.prototype.format = function (t, e) {
        var a = "(\\d)(?=(\\d{" + (e || 3) + "})+" + (t > 0 ? "\\." : "$") + ")";
        return this.toFixed(Math.max(0, ~~t)).replace(new RegExp(a, "g"), "$1,")
    },
    function () {
        function t(t) {
            return null === t ? "" : encodeURIComponent(String(t).trim())
        }

        function e(e, a) {
            var n, i, s, r, o = [],
                l = !(!a || !a.lowerCase || !a.lowerCase);
            if (null === e ? i = "" : "object" == typeof e ? (i = "", a = e) : i = e, a) {
                if (a.path && (i && "/" === i[i.length - 1] && (i = i.slice(0, -1)), s = String(a.path).trim(), l && (s = s.toLowerCase()), 0 === s.indexOf("/") ? i += s : i += "/" + s), a.queryParams) {
                    for (n in a.queryParams)
                        if (a.queryParams.hasOwnProperty(n) && void 0 !== a.queryParams[n])
                            if (a.disableCSV && Array.isArray(a.queryParams[n]) && a.queryParams[n].length)
                                for (var d = 0; d < a.queryParams[n].length; d++) r = a.queryParams[n][d], o.push(n + "=" + t(r));
                            else r = l ? a.queryParams[n].toLowerCase() : a.queryParams[n], o.push(n + "=" + t(r));
                    i += "?" + o.join("&")
                }
                a.hash && (i += l ? "#" + String(a.hash).trim().toLowerCase() : "#" + String(a.hash).trim())
            }
            return i
        }
        var a = this,
            n = a.buildUrl;
        e.noConflict = function () {
            return a.buildUrl = n, e
        }, "undefined" != typeof exports ? ("undefined" != typeof module && module.exports && (exports = module.exports = e), exports.buildUrl = e) : a.buildUrl = e
    }.call(this);
let DUNGA = (initUrl = t => {
    let e = t.type;
    return delete t.type, buildUrl("", {
        path: "api/" + e
    })
}, copyStringToClipboard = t => {
    var e = document.createElement("textarea");
    e.value = t, e.setAttribute("readonly", ""), e.style = {
        position: "absolute",
        left: "-9999px"
    }, document.body.appendChild(e), e.select(), document.execCommand("copy"), document.body.removeChild(e)
}, number_format = t => parseInt(t).toLocaleString("it-IT", {
    style: "currency",
    currency: "VND"
}), initAjax = t => {
    $.ajax(t)
}, getNum = t => {
    let e = [];
    for ($i = 0; $i < 10; $i++) - 1 === t.indexOf($i) && e.push($i);
    return e
}, loadMomo = t => {
    initAjax({
        url: initUrl({
            type: "momo"
        }),
        method: "POST",
        success: function (e) {
            if (1 == e.status) {
                let n = "";
                if (e.data_momo) {
                    let t = {
                        0: '<span class="label label-info text-uppercase">Bảo trì</span>',
                        1: '<span class="label label-success text-uppercase">Hoạt động</span>'
                    };
                    e.data_momo;
                    for (let i of e.data_momo) {
                        var a = i.settings;
                        null == a.transfers_today && (a.transfers_today = {
                            times: 0,
                            amount: 0
                        }), n += "<tr>", n += `<td>${i.username} <span class="label label-success text-uppercase" onclick="DUNGA.coppy('${i.username}', '${i.settings.min}', '${i.settings.max}')"><i class="fa fa-clipboard" aria-hidden="true"></i></span> <span class="label label-success text-uppercase" onclick="DUNGA.play('${i.username}')"><i class="fa fa-play" aria-hidden="true"></i></span></td>`, n += `<td>${t[i.status]}</td>`, n += `<td><strong><span class="text-danger">${a.transfers_today.times}</span> lần</strong></td>`, n += `<td><strong><span class="text-danger cash-format">${number_format(a.transfers_today.amount)}</span> / 50.000.000 VND</strong></td>`, n += "</tr>"
                    }
                }
                if (e.game.active) {
                    for (let t of e.game.active) $(`button[data-game="${t}"]`).removeClass("hidden");
                    $("div.play-rules").html(e.game.html), "" == t || null == t ? e.game.active.includes("chanle") ? $('button[data-game="chanle"]').click() : $(`button[data-game="${e.game.active[0]}"]`).click() : $(`button[data-game="${t}"]`).click()
                }
                $("#momo-status").html(n)
            }
        }
    })
}, loadSettings = () => {
    initAjax({
        url: initUrl({
            type: "settings"
        }),
        method: "POST",
        success: function (t) {
            if (1 == t.status && (settings = t, 1 == t.active)) {
                $("#author").html(`<a href="${t.href}" target="_blank">${t.author}</a>`);
                let e = "";
                for (let a of t.contacts) e += `<p><a class="text-white" href="${a.href}" target="_blank"><span class="btn btn-success text-uppercase">${a.name}</span></a></p>`;
                $("#note").html(t.note), $("#note_modal").html(t.note), $("#noteModal").modal(), $("#contact").html(e), "" !== t.ads && void 0 !== t.ads && $(".ads").removeClass("hidden").html(t.ads), "" !== t.notifications && void 0 !== t.notifications && $(".notifications").removeClass("hidden").html(t.notifications), loadMomo(), void 0 !== t.history && "1" == t.history && loadHistorys(t.only_win, t.limit), void 0 !== t.hu && "1" == t.hu && (loadHu(), $("#amount-hu").text(number_format(t.hu.amount))), void 0 !== t.week_top && 1 == t.week_top && (loadWeekTop(), $(".week_top").removeClass("hidden")), void 0 !== t.day_mission && 1 == t.day_mission && loadMinigame({
                    game: "day_mission"
                }), void 0 !== t.wheel && 1 == t.wheel.active && loadMinigame({
                    game: "wheel"
                }), void 0 !== t.diemdanh && 1 == t.diemdanh && loadMinigame({
                    game: "diemdanh"
                }), void 0 !== t.giftcode && 1 == t.giftcode && loadMinigame({
                    game: "giftcode"
                }), void 0 !== t.refer_friend && 1 == t.refer_friend.active && loadMinigame({
                    game: "refer_friend",
                    settings_encode: t.refer_friend.settings_encode
                }), setInterval(reset_data, 1e3), setInterval(day_limit, 5e3)
            }
        }
    })
}, loadHistorys = (t, e) => {
    initAjax({
        url: initUrl({
            type: "history",
            only_win: t,
            limit: e
        }),
        method: "POST",
        success: function (t) {
            if (1 == t.status && 1 == t.history.status) {
                let e = {
                        1: '<span class="label label-success text-uppercase">Thắng</span>',
                        0: '<span class="label label-secondary text-uppercase">Thua</span>'
                    },
                    a = "";
                for (let n of t.history.data) {
                    let t = "#" + ((1 << 24) * (Math.random() + 1) | 0).toString(16).substr(1);
                    a += "<tr>", a += `<td>${n.partnerId}</td>`, a += `<td>${number_format(n.amount)}</td>`, a += `<td><span class="fa-stack"><span class="fa fa-circle fa-stack-2x" style="color:${t}"></span><span class="fa-stack-1x text-white">${n.comment}</span></span></td>`, a += `<td>${e[n.victory]}</td>`, a += "</tr>", n.amount >= 5e4 && null == noti_wined[n.id] && (noti_win[n.id] = {
                        game: "",
                        partnerId: n.partnerId,
                        amount: n.amount
                    })
                }
                $("#history").html(a)
            }
        }
    })
}, loadWeekTop = () => {
    initAjax({
        url: initUrl({
            type: "week_top"
        }),
        method: "POST",
        success: function (t) {
            if (1 == t.status && 1 == t.weekTop.status) {
                let e = "";
                for (let a of t.weekTop.data) e += "<tr>", e += `<td><span class="fa-stack"> <span class="fa fa-circle fa-stack-2x text-danger"></span><strong class="fa-stack-1x text-white">${a.key}</strong></span></td>`, e += `<td class="col-xs-2"><span class="label label-success">${a.phone}</span></td>`, e += `<td class="col-xs-5 text-center"><span class="label label-danger">${number_format(a.amount)}</span></td>`, e += `<td class="col-xs-5 text-center"><span class="label label-danger">${number_format(a.gift)}</span></td>`, e += "</tr>";
                $(".week_top #week_top").html(e)
            }
        }
    })
}, loadMinigame = t => {
    const {
        game: e
    } = t;
    initAjax({
        url: initUrl({
            type: "render_minigame"
        }),
        method: "POST",
        data: {
            game: e
        },
        success: function (t) {
            1 == t.status && ($(`[data-minigame=${e}]`).removeClass("hidden"), $(".minigame-rules").append(t.html))
        }
    })
}, loadHu = () => {
    initAjax({
        url: initUrl({
            type: "balance-hu"
        }),
        method: "POST",
        success: function (t) {
            1 == t.status && ($("#hu-left-display").removeClass("hidden"), $(".hu-balance").html(number_format(t.amount)))
        }
    })
}, check_dayMission = t => {
    initAjax({
        url: initUrl({
            type: "check-day-mission"
        }),
        method: "POST",
        data: {
            phone: t
        },
        beforeSend: function () {
            $(".check-day-mission").attr("disabled", !0).addClass("disabled"), $("#day_mission_querying").show(), $("#query_done").html(), $("#non_query").hide()
        },
        success: function (t) {
            "error" == t.status ? (alert("Oh !! Số điện thoại này chưa chơi game nào, hãy kiểm tra lại"), $("#non_query").show(), $("#gift").hide()) : (alert(t.message), $("#non_query").show(), $("#day_mission_querying").hide(), $(".check-day-mission").attr("disabled", !1).removeClass("disabled"))
        }
    })
}, reward_dayMission = (t, e) => {
    initAjax({
        url: initUrl({
            type: "reward-day-mission",
            partnerId: t
        }),
        method: "POST",
        data: {
            milEncode: e
        },
        beforeSend: function () {
            $(".reward-day-mission").attr("disabled", !0).addClass("disabled")
        },
        success: function (t) {
            if (1 == t.status) {
                if (1 == t.data.status) {
                    let e = t.data;
                    $(".reward-day-mission").remove(), $(".ntmsg").html(`\n                            <div><b>${e.message}</b></div>\n                            <div class="st"><b class="text-danger">Sá»‘ tiá»n: ${number_format(e.amount)} vnÄ‘</b></div>\n                            <div class="st"><b class="text-warning">Lá»i nháº¯n: ${e.comment}</b></div>`)
                }
            } else $(".ntmsg b").text(t.message).addClass("text-danger")
        }
    })
}, checkTran = t => {
    initAjax({
        url: initUrl({
            type: "check-tran"
        }),
        data: {
            tran_id: t
        },
        method: "POST",
        success: function (t) {
            1 == t.status ? 1 == t.data.status ? $("#result-check").attr("class", "").addClass("alert alert-success").html(t.data.message) : $("#result-check").attr("class", "").addClass("alert alert-danger").html(t.data.message) : 404 == t.code ? $(".more_infomation").removeClass("hidden") : $("#result-check").attr("class", "").addClass("alert alert-danger").html(t.message), $(".check-tran").attr("disabled", !1).removeClass("disabled")
        }
    })
}, refund = t => {
    initAjax({
        url: initUrl({
            type: "refund"
        }),
        data: {
            tran_id: t
        },
        method: "POST",
        success: function (t) {
            alert(t.message)
        }
    })
}, checkTran2 = (t, e) => {
    initAjax({
        url: initUrl({
            type: "check-tran2"
        }),
        method: "POST",
        data: {
            tran_id: t,
            receiver: e
        },
        beforeSend: function () {
            $(".check-tran").attr("disabled", !0).addClass("disabled")
        },
        success: function (t) {
            1 == t.status ? 1 == t.data.status ? $("#result-check").attr("class", "").addClass("alert alert-success").html(t.data.message) : $("#result-check").attr("class", "").addClass("alert alert-danger").html(t.data.message) : $("#result-check").attr("class", "").addClass("alert alert-danger").html(t.message), $(".check-tran").attr("disabled", !1).removeClass("disabled")
        }
    })
}, joinhu = function (t) {
    initAjax({
        url: initUrl({
            type: "join-hu",
            partnerId: t
        }),
        method: "POST",
        beforeSend: function () {
            $(".submit-join-hu").attr("disabled", !0).addClass("disabled")
        },
        success: function (t) {
            1 == t.status && 1 == t.data.status ? ($("#msg_hu").html(t.data.message), $(".submit-join-hu").attr("disabled", !1).removeClass("disabled"), 1 == t.data.is_join ? $(".submit-join-hu").removeClass("btn-success").addClass("btn-danger").html("Há»§y Tham Gia") : $(".submit-join-hu").removeClass("btn-danger").addClass("btn-success").html("Tham Gia")) : ($("#msg_hu").html(t.data.message), $(".submit-join-hu").attr("disabled", !1).removeClass("disabled"))
        }
    })
}, joinDiemdanh = t => {
    initAjax({
        url: initUrl({
            type: "diem-danh"
        }),
        data: {
            phone: t
        },
        method: "POST",
        success: function (t) {
            alert(t.message)
        }
    })
}, day_limit = function () {
    $("#hmln[attr-name=times]").toggleClass("hidden"), $("#hmln[attr-name=amount]").toggleClass("hidden")
}, reset_data = function () {
    var t = (new Date).getTime();
    let e = Math.floor((next_reset - t) / 1e3);
    if (e <= 0 && (e = 0), $(".coundown-time").text(e), e % 2 == 0) {
        let t = Object.keys(noti_win)[0];
        t > 0 && (DUNGA.noti_win(noti_win[t]), noti_wined[history.id] = history.id, delete noti_win[t])
    }
    t >= next_reset && 1 == settings.active && (loadMomo(game_active), void 0 !== settings.history && 1 == settings.history && loadHistorys(settings.only_win, settings.limit), void 0 !== settings.hu && 1 == settings.hu.active && loadHu(), next_reset = t + 2e4)
}, {
    init: function () {
        loadSettings()
    },
    coppy: function (t, e, a) {
        copyStringToClipboard(t), alert("Đã sao chép số: " + t + " chơi từ " + number_format(e) + " VNĐ đến " + number_format(a) + " VNĐ. Nếu bạn chuyển nhỏ hơn hoặc lớn thua sẽ mất tiền.  ")
    },
    play: function (t) {
        window.open(`https://nhantien.momo.vn/${t}`, "_blank")
    },
    number_format: function (t) {
        number_format(t)
    },
    check_tranid: function () {
        $this = this;
        let t = $("input[name=tran_id]").val();
        checkTran(t)
    },
    refund: function () {
        $this = this;
        let t = $("input[name=tran_id]").val();
        refund(t)
    },
    check_tranid2: function () {
        $this = this;
        let t = $("input[name=tran_id]").val(),
            e = $("input[name=receiver]").val();
        checkTran2(t, e)
    },
    hu_click: function () {
        $("#hu-info").modal("show")
    },
    check_dayMission: function () {
        $this = this;
        let t = $("input[name=partnerId]").val();
        check_dayMission(t)
    },
    joinDiemdanh: function () {
        $this = this;
        let t = $("input[name=phoneDiemDanh]").val();
        if (t.length <= 9) return alert("Khong hop le"), !1;
        let e = getRndInteger(1, 9),
            a = getRndInteger(1, 9),
            n = prompt("Xác minh bạn là học sinh giỏi toán " + e + "+" + a + "= ?:", "");
        if (null == n || n != e + a) return alert("Bạn đã nhập sai phép tính, vui lòng thử lại"), !1;
        joinDiemdanh(t)
    },
    joinhu: function () {
        let t = $("#result_hu input[name=partnerId]").val();
        joinhu(t)
    },
    reward: function () {
        $this = this;
        let t = $("input[name=partnerId]").val(),
            e = $(".reward-day-mission").attr("data-mil-encode");
        reward_dayMission(t, e)
    },
    noti_win: function (t) {
        const {
            game: e,
            partnerId: a,
            amount: n
        } = t;
        new Notify({
            status: "success",
            title: "Trò chơi: " + e,
            text: `Chúc mừng <b>${a}</b> đã thắng ${number_format(n)}`,
            autoclose: !0,
            customIcon: '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512"><path d="M19,9H14a5.006,5.006,0,0,0-5,5v5a5.006,5.006,0,0,0,5,5h5a5.006,5.006,0,0,0,5-5V14A5.006,5.006,0,0,0,19,9Zm-5,6a1,1,0,1,1,1-1A1,1,0,0,1,14,15Zm5,5a1,1,0,1,1,1-1A1,1,0,0,1,19,20ZM15.6,5,12.069,1.462A5.006,5.006,0,0,0,5,1.462L1.462,5a5.006,5.006,0,0,0,0,7.071L5,15.6a4.961,4.961,0,0,0,2,1.223V14a7.008,7.008,0,0,1,7-7h2.827A4.961,4.961,0,0,0,15.6,5ZM5,10A1,1,0,1,1,6,9,1,1,0,0,1,5,10ZM9,6a1,1,0,1,1,1-1A1,1,0,0,1,9,6Z"></path></svg>'
        })
    }
});
"undefined" != typeof module && void 0 !== module.exports && (module.exports = DUNGA), $(document).ready((function () {
    DUNGA.init();
    new Pusher(pusher_key, {
        cluster: "ap1",
        authEndpoint: DUNGASettings.pusher.authEndpoint,
        channel_auth_endpoint: DUNGASettings.pusher.channel_auth_endpoint,
        crypt_master_key_base64: DUNGASettings.pusher.crypt_master_key_base64
    })
}));
let QuangWheel = function () {
    let t, e, a = new Audio("/upload/files/tick.mp3"),
        n = !1;
    return init = function () {
        t = new Winwheel({
            drawMode: "image",
            drawText: !0,
            numSegments: 8,
            outerRadius: 200,
            canvasId: "canvas",
            animation: {
                type: "spinToStop",
                duration: 10,
                spins: 3,
                callbackSound: playSound,
                soundTrigger: "pin",
                callbackAfter: "draw_wheel()",
                callbackFinished: "spin_finished()"
            },
            pins: {
                number: 16,
                fillStyle: "while",
                outerRadius: 6,
                responsive: !0
            }
        });
        let e = new Image;
        e.src = "/upload/files/main-wheel-3.png", e.onload = function () {
            t.wheelImage = e, t.draw()
        }, draw_wheel()
    }, spin_finished = function () {
        "unlucky" === e.type ? Swal.fire({
            title: "Opps!",
            text: e.message,
            type: "error",
            confirmButtonText: "Thá»­ láº¡i!"
        }) : Swal.fire({
            title: "Xin chĂºc má»«ng!",
            text: " " + e.message,
            type: "success",
            confirmButtonText: "ChÆ¡i tiáº¿p !"
        }), t.stopAnimation(!1), n = !1, $("#wheel-btn").show()
    }, draw_wheel = function () {
        let e = t.ctx;
        e.strokeStyle = "navy", e.fillStyle = "aqua", e.lineWidth = 2, e.beginPath(), e.stroke(), e.fill()
    }, start_spin = function () {
        0 == wheelSpinning && (t.startAnimation(), wheelSpinning = !0)
    }, roll_spin = function (a) {
        if (e = a, e.key) {
            let a = t.getRandomForSegment(e.key);
            t.animation.stopAngle = a, start_spin()
        }
    }, spin = function (t) {
        return !n && (t.length <= 10 ? (Swal.fire({
            title: "Opps!",
            text: "MĂ£ giao dá»‹ch khĂ´ng há»£p lá»‡.",
            type: "error",
            confirmButtonText: "Thá»­ láº¡i!"
        }), !1) : (reset_wheel(), n = !0, $("#wheel-btn").hide(), void initAjax({
            url: initUrl({
                type: "spin-wheel"
            }),
            method: "POST",
            data: {
                id_tran: t
            },
            success: function (t) {
                if (0 == t.status) return n = !1, $("#wheel-btn").show(), Swal.fire({
                    title: "á»i! Lá»—i rá»“i!",
                    text: t.message,
                    type: "error",
                    confirmButtonText: "Thá»­ láº¡i!"
                }), !1;
                roll_spin(t.data)
            }
        })))
    }, start_spin = function () {
        0 == wheelSpinning && (t.startAnimation(), wheelSpinning = !0)
    }, reset_wheel = function () {
        t.stopAnimation(!1), t.rotationAngle = -20, t.draw(), wheelSpinning = !1
    }, withdraw = function () {
        Swal.fire({
            title: "Nháº­p sá»‘ Ä‘iá»‡n thoáº¡i cá»§a báº¡n:",
            input: "text",
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: !0,
            confirmButtonText: "Kiá»ƒm tra",
            showLoaderOnConfirm: !0,
            preConfirm: t => {
                check_amount(t)
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((t => {
            t.isConfirmed && Swal.fire({
                title: `${t.value.login}'s avatar`,
                imageUrl: t.value.avatar_url
            })
        }))
    }, roll = function () {
        return Swal.fire({
            title: "Nháº­p mĂ£ giao dá»‹ch Ä‘Ă£ chÆ¡i:",
            input: "text",
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: !0,
            confirmButtonText: "Quay Ngay",
            showLoaderOnConfirm: !0,
            preConfirm: t => {
                spin(t)
            },
            allowOutsideClick: () => !Swal.isLoading()
        }), !1
    }, playSound = function () {
        a.pause(), a.currentTime = 0, a.play()
    }, withdraw_wheel = function (t) {
        initAjax({
            url: initUrl({
                type: "withdraw-wheel"
            }),
            method: "POST",
            data: t,
            success: function (t) {
                1 == t.status ? Swal.fire({
                    title: "ThĂ nh cĂ´ng!",
                    text: t.message,
                    type: "success",
                    confirmButtonText: "ÄĂ³ng!"
                }) : Swal.fire({
                    title: "Opps!",
                    text: t.message,
                    type: "error",
                    confirmButtonText: "Thá»­ láº¡i!"
                })
            }
        })
    }, check_amount = function (t) {
        if (t.legth < 10 && t.legth > 12) return Swal.fire({
            title: "Opps!",
            text: "Sá»‘ Ä‘iá»‡n thoáº¡i khĂ´ng há»£p lá»‡.",
            type: "error",
            confirmButtonText: "Thá»­ láº¡i!"
        }), !1;
        initAjax({
            url: initUrl({
                type: "check-amount-wheel"
            }),
            method: "POST",
            data: {
                partnerId: t
            },
            success: function (e) {
                1 == e.status ? Swal.fire({
                    title: "Báº¡n Ä‘ang cĂ³ " + DUNGA.number_format(e.data.amount) + " vnÄ‘. Nháº­p sá»‘ tiá»n muá»‘n rĂºt:",
                    input: "number",
                    inputAttributes: {
                        autocapitalize: "off"
                    },
                    showCancelButton: !0,
                    confirmButtonText: "RĂºt Ngay",
                    showLoaderOnConfirm: !0,
                    preConfirm: e => {
                        withdraw_now({
                            partnerId: t,
                            amount: e
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }) : Swal.fire({
                    title: "Opps!",
                    text: e.message,
                    type: "error",
                    confirmButtonText: "Thá»­ láº¡i!"
                })
            }
        })
    }, {
        init: function () {
            init()
        },
        roll: function () {
            roll()
        },
        withdraw: function () {
            withdraw()
        }
    }
}();
"undefined" != typeof module && void 0 !== module.exports && (module.exports = QuangWheel), $(document).ready((function () {}));
let DUNGAMinigame = (check_ReferFriend = t => {
    initAjax({
        url: initUrl({
            type: "check-refer-friend",
            partnerId: t
        }),
        method: "POST",
        beforeSend: function () {
            $(".check-refer-friend").attr("disabled", !0).addClass("disabled"), $("#refer_friend_querying").show(), $("#query_done").html(), $("#non_query").hide()
        },
        success: function (t) {
            1 == t.status ? ($("#query_done").html(t.html), $("#query_done").show(), $("#refer_friend_querying").hide(), $(".check-refer-friend").attr("disabled", !1).removeClass("disabled")) : (alert(t.message), $("#non_query").show(), $("#refer_friend_querying").hide(), $(".check-refer-friend").attr("disabled", !1).removeClass("disabled"))
        }
    })
}, reward_ReferFriend = (t, e) => {
    initAjax({
        url: initUrl({
            type: "reward-day-mission",
            partnerId: t
        }),
        method: "POST",
        data: {
            milEncode: e
        },
        beforeSend: function () {
            $(".reward-day-mission").attr("disabled", !0).addClass("disabled")
        },
        success: function (t) {
            if (1 == t.status) {
                if (1 == t.data.status) {
                    let e = t.data;
                    $(".reward-day-mission").remove(), $(".ntmsg").html(`\n                            <div><b>${e.message}</b></div>\n                            <div class="st"><b class="text-danger">Sá»‘ tiá»n: ${number_format(e.amount)} vnÄ‘</b></div>\n                            <div class="st"><b class="text-warning">Lá»i nháº¯n: ${e.comment}</b></div>`)
                }
            } else $(".ntmsg b").text(t.message).addClass("text-danger")
        }
    })
}, {
    init: function () {},
    diemdanh: function () {
        ! function () {
            $this = this;
            let t = $("input[name=partnerId]").val();
            check_dayMission(t)
        }($("input[name=dd_partnerId]").val())
    },
    dd_change: function (t) {
        $(t).attr("data-action")
    },
    checkReferFriend: function () {
        $this = this;
        let t = $("input[name=partnerId]").val();
        check_ReferFriend(t)
    }
});
"undefined" != typeof module && void 0 !== module.exports && (module.exports = QuangWheel), $(document).ready((function () {})), $("#result_hu [name=partnerId]").on("input", (function () {
    this.value.length >= 10 && this.value.length <= 11 ? $("#msg_hu2").html('<button type="text" class="btn btn-success submit-join-hu" onclick="DUNGA.joinhu()">Tham gia</button>') : $("#msg_hu2").html("Vui lòng nhập số điện thoại để tiếp tục")
}));