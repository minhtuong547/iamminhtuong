"use strict";
!function(t, e) {
    t.Package.name = "DashLite",
    t.Package.version = "2.3";
    var n = e(window)
      , a = e("body")
      , i = e(document)
      , o = "nk-menu"
      , s = "nk-header"
      , r = "nk-header-menu"
      , c = t.Break;
    function l(t, e) {
        return Object.keys(e).forEach(function(n) {
            t[n] = e[n]
        }),
        t
    }
    return t.ClassNavMenu = function() {
        t.BreakClass("." + r, c.lg, {
            timeOut: 0
        }),
        n.on("resize", function() {
            t.BreakClass("." + r, c.lg)
        })
    }
    ,
    t.Prettify = function() {
        window.prettyPrint && prettyPrint()
    }
    ,
    t.Copied = function() {
        var t = ".clipboard-init"
          , n = ".clipboard-text"
          , a = "clipboard-success"
          , i = "clipboard-error";
        function o(t, o) {
            var s = e(t)
              , r = s.parent()
              , c = {
                text: "Copy",
                done: "Copied",
                fail: "Failed"
            }
              , l = {
                text: s.data("clip-text"),
                done: s.data("clip-success"),
                fail: s.data("clip-error")
            };
            c.text = l.text ? l.text : c.text,
            c.done = l.done ? l.done : c.done,
            c.fail = l.fail ? l.fail : c.fail;
            var d = "success" === o ? c.done : c.fail;
            r.addClass("success" === o ? a : i).find(n).html(d),
            setTimeout(function() {
                r.removeClass(a + " " + i).find(n).html(c.text).blur(),
                r.find("input").blur()
            }, 2e3)
        }
        ClipboardJS.isSupported() ? new ClipboardJS(t).on("success", function(t) {
            o(t.trigger, "success"),
            t.clearSelection()
        }).on("error", function(t) {
            o(t.trigger, "error")
        }) : e(t).css("display", "none")
    }
    ,
    t.CurrentLink = function() {
        var t = window.location.href
          , n = t.substring(0, -1 == t.indexOf("#") ? t.length : t.indexOf("#"))
          , n = n.substring(0, -1 == n.indexOf("?") ? n.length : n.indexOf("?"));
        e(".nk-menu-link, .menu-link, .nav-link").each(function() {
            var t = e(this)
              , a = t.attr("href");
            n.match(a) ? (t.closest("li").addClass("active current-page").parents().closest("li").addClass("active current-page"),
            t.closest("li").children(".nk-menu-sub").css("display", "block"),
            t.parents().closest("li").children(".nk-menu-sub").css("display", "block")) : t.closest("li").removeClass("active current-page").parents().closest("li:not(.current-page)").removeClass("active")
        })
    }
    ,
    t.PassSwitch = function() {
        t.Passcode(".passcode-switch")
    }
    ,
    t.Toast = function(t, e, n) {
        var e = e || "info"
          , a = ""
          , i = "info" === e ? "ni ni-info-fill" : "success" === e ? "ni ni-check-circle-fill" : "error" === e ? "ni ni-cross-circle-fill" : "warning" === e ? "ni ni-alert-fill" : ""
          , o = {
            position: "bottom-right",
            ui: "",
            icon: "auto",
            clear: !1
        }
          , s = n ? l(o, n) : o;
        if (s.position = s.position ? "toast-" + s.position : "toast-bottom-right",
        s.icon = "auto" === s.icon ? i : s.icon ? s.icon : "",
        s.ui = s.ui ? " " + s.ui : "",
        a = "" !== s.icon ? '<span class="toastr-icon"><em class="icon ' + s.icon + '"></em></span>' : "",
        "" != (t = "" !== t ? a + '<div class="toastr-text">' + t + "</div>" : "")) {
            !0 === s.clear && toastr.clear();
            var r = {
                closeButton: !0,
                debug: !1,
                newestOnTop: !1,
                progressBar: !1,
                positionClass: s.position + s.ui,
                closeHtml: '<span class="btn-trigger">Close</span>',
                preventDuplicates: !0,
                showDuration: "1500",
                hideDuration: "1500",
                timeOut: "2000",
                toastClass: "toastr",
                extendedTimeOut: "3000"
            };
            toastr.options = l(r, s),
            toastr[e](t)
        }
    }
    ,
    t.TGL.screen = function(t) {
        e(t).exists() && e(t).each(function() {
            var t = e(this).data("toggle-screen");
            t && e(this).addClass("toggle-screen-" + t)
        })
    }
    ,
    t.TGL.content = function(a, o) {
        var s = e(a || ".toggle")
          , r = e("[data-content]")
          , d = !1
          , u = {
            active: "active",
            content: "content-active",
            break: !0
        }
          , p = o ? l(u, o) : u;
        t.TGL.screen(r),
        s.on("click", function(n) {
            d = this,
            t.Toggle.trigger(e(this).data("target"), p),
            n.preventDefault()
        }),
        i.on("mouseup", function(n) {
            if (d) {
                var a = e(d)
                  , i = e(".select2-container")
                  , o = e(".datepicker-dropdown")
                  , s = e(".ui-timepicker-container");
                a.is(n.target) || 0 !== a.has(n.target).length || r.is(n.target) || 0 !== r.has(n.target).length || i.is(n.target) || 0 !== i.has(n.target).length || o.is(n.target) || 0 !== o.has(n.target).length || s.is(n.target) || 0 !== s.has(n.target).length || (t.Toggle.removed(a.data("target"), p),
                d = !1)
            }
        }),
        n.on("resize", function() {
            r.each(function() {
                var n = e(this).data("content")
                  , a = c[e(this).data("toggle-screen")];
                t.Win.width > a && t.Toggle.removed(n, p)
            })
        })
    }
    ,
    t.TGL.expand = function(n, a) {
        var i = {
            toggle: !0
        }
          , o = a ? l(i, a) : i;
        e(n || ".expand").on("click", function(n) {
            t.Toggle.trigger(e(this).data("target"), o),
            n.preventDefault()
        })
    }
    ,
    t.TGL.ddmenu = function(n, a) {
        var i = {
            active: "active",
            self: "nk-menu-toggle",
            child: "nk-menu-sub"
        }
          , o = a ? l(i, a) : i;
        e(n || ".nk-menu-toggle").on("click", function(n) {
            t.Win.width < c.lg && t.Toggle.dropMenu(e(this), o),
            n.preventDefault()
        })
    }
    ,
    t.TGL.showmenu = function(a, o) {
        var d = e(a || ".nk-nav-toggle")
          , u = e("[data-content]")
          , p = u.hasClass(r) ? c.lg : c.xl
          , f = {
            active: "toggle-active",
            content: s + "-active",
            body: "nav-shown",
            overlay: s + "-overlay",
            break: p,
            close: {
                profile: !0,
                menu: !1
            }
        }
          , g = o ? l(f, o) : f;
        d.on("click", function(n) {
            t.Toggle.trigger(e(this).data("target"), g),
            n.preventDefault()
        }),
        i.on("mouseup", function(e) {
            d.is(e.target) || 0 !== d.has(e.target).length || u.is(e.target) || 0 !== u.has(e.target).length || !(t.Win.width < p) || t.Toggle.removed(d.data("target"), g)
        }),
        n.on("resize", function() {
            (t.Win.width < c.xl || t.Win.width < p) && t.Toggle.removed(d.data("target"), g)
        })
    }
    ,
    t.Ani.formSearch = function(t, n) {
        var a = {
            active: "active",
            timeout: 400,
            target: "[data-search]"
        }
          , o = n ? l(a, n) : a
          , s = e(t)
          , r = e(o.target);
        s.exists() && (s.on("click", function(t) {
            t.preventDefault();
            var n = e(this).data("target")
              , a = e("[data-search=" + n + "]")
              , i = e("[data-target=" + n + "]");
            a.hasClass(o.active) ? (i.add(a).removeClass(o.active),
            setTimeout(function() {
                a.find("input").val("")
            }, o.timeout)) : (i.add(a).addClass(o.active),
            a.find("input").focus())
        }),
        i.on({
            keyup: function t(e) {
                "Escape" === e.key && s.add(r).removeClass(o.active)
            },
            mouseup: function t(e) {
                r.find("input").val() || r.is(e.target) || 0 !== r.has(e.target).length || s.is(e.target) || 0 !== s.has(e.target).length || s.add(r).removeClass(o.active)
            }
        }))
    }
    ,
    t.Ani.formElm = function(t, n) {
        var a = {
            focus: "focused"
        }
          , i = n ? l(a, n) : a;
        e(t).exists() && e(t).each(function() {
            var t = e(this);
            t.val() && t.parent().addClass(i.focus),
            t.on({
                focus: function e() {
                    t.parent().addClass(i.focus)
                },
                blur: function e() {
                    t.val() || t.parent().removeClass(i.focus)
                }
            })
        })
    }
    ,
    t.Validate = function(t, n) {
        e(t).exists() && e(t).each(function() {
            var t = {
                errorElement: "span"
            }
              , a = n ? l(t, n) : t;
            e(this).validate(a)
        })
    }
    ,
    t.Validate.init = function() {
        t.Validate(".form-validate", {
            errorElement: "span",
            errorClass: "invalid",
            errorPlacement: function t(e, n) {
                n.parents().hasClass("input-group") ? e.appendTo(n.parent().parent()) : e.appendTo(n.parent())
            }
        })
    }
    ,
    t.Dropzone = function(t, n) {
        e(t).exists() && e(t).each(function() {
            var a = e(t).data("max-files")
              , a = a || null
              , i = e(t).data("max-file-size")
              , i = i || 256
              , o = e(t).data("accepted-files")
              , o = o || null
              , s = {
                autoDiscover: !1,
                maxFiles: a,
                maxFilesize: i,
                acceptedFiles: o
            }
              , r = n ? l(s, n) : s;
            e(this).addClass("dropzone").dropzone(r)
        })
    }
    ,
    t.Dropzone.init = function() {
        t.Dropzone(".upload-zone", {
            url: "/images"
        })
    }
    ,
    t.Wizard = function() {
        var t = e(".nk-wizard");
        t.exists() && t.each(function() {
            var t = e(this).attr("id")
              , n = e("#" + t).show();
            n.steps({
                headerTag: ".nk-wizard-head",
                bodyTag: ".nk-wizard-content",
                labels: {
                    finish: "Submit",
                    next: "Next",
                    previous: "Prev",
                    loading: "Loading ..."
                },
                titleTemplate: '<span class="number">0#index#</span> #title#',
                onStepChanging: function t(e, a, i) {
                    return a > i || (a < i && (n.find(".body:eq(" + i + ") label.error").remove(),
                    n.find(".body:eq(" + i + ") .error").removeClass("error")),
                    n.validate().settings.ignore = ":disabled,:hidden",
                    n.valid())
                },
                onFinishing: function t(e, a) {
                    return n.validate().settings.ignore = ":disabled",
                    n.valid()
                },
                onFinished: function t(e, n) {
                    window.location.href = "#"
                }
            }).validate({
                errorElement: "span",
                errorClass: "invalid",
                errorPlacement: function t(e, n) {
                    e.appendTo(n.parent())
                }
            })
        })
    }
    ,
    t.DataTable = function(t, n) {
        e(t).exists() && e(t).each(function() {
            var t = e(this).data("auto-responsive")
              , a = void 0 !== n.buttons && !!n.buttons
              , i = e(this).data("export-title") ? e(this).data("export-title") : "Export"
              , o = a ? '<"dt-export-buttons d-flex align-center"<"dt-export-title d-none d-md-inline-block">B>' : ""
              , s = a ? " with-export" : ""
              , r = '<"row justify-between g-2' + s + '"<"col-7 col-sm-4 text-left"f><"col-5 col-sm-8 text-right"<"datatable-filter"<"d-flex justify-content-end g-2"' + o + 'l>>>><"datatable-wrap my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>'
              , c = '<"row justify-between g-2' + s + '"<"col-7 col-sm-4 text-left"f><"col-5 col-sm-8 text-right"<"datatable-filter"<"d-flex justify-content-end g-2"' + o + 'l>>>><"my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>'
              , d = {
                responsive: !0,
                autoWidth: !1,
                dom: e(this).hasClass("is-separate") ? c : r,
                language: {
                    search: "",
                    searchPlaceholder: "Type in to Search",
                    lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                    info: "_START_ -_END_ of _TOTAL_",
                    infoEmpty: "No records found",
                    infoFiltered: "( Total _MAX_  )",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Prev"
                    }
                }
            }
              , u = n ? l(d, n) : d;
            u = !1 === t ? l(u, {
                responsive: !1
            }) : u,
            e(this).DataTable(u),
            e(".dt-export-title").text(i)
        })
    }
    ,
    t.DataTable.init = function() {
        t.DataTable(".datatable-init", {
            responsive: {
                details: !0
            }
        }),
        t.DataTable(".datatable-init-export", {
            responsive: {
                details: !0
            },
            buttons: ["copy", "excel", "csv", "pdf"]
        }),
        e.fn.DataTable.ext.pager.numbers_length = 7
    }
    ,
    t.BS.ddfix = function(n, a) {
        var i = a || "a:not(.clickable), button:not(.clickable), a:not(.clickable) *, button:not(.clickable) *";
        e(n || ".dropdown-menu").on("click", function(t) {
            if (!e(t.target).is(i)) {
                t.stopPropagation();
                return
            }
        }),
        t.State.isRTL && e(".dropdown-menu").each(function() {
            var t = e(this);
            t.hasClass("dropdown-menu-right") && !t.hasClass("dropdown-menu-center") ? t.prev('[data-toggle="dropdown"]').dropdown({
                popperConfig: {
                    placement: "bottom-start"
                }
            }) : t.hasClass("dropdown-menu-right") || t.hasClass("dropdown-menu-center") || t.prev('[data-toggle="dropdown"]').dropdown({
                popperConfig: {
                    placement: "bottom-end"
                }
            })
        })
    }
    ,
    t.BS.tabfix = function(t) {
        e(t || '[data-toggle="modal"]').on("click", function() {
            var t = e(this)
              , n = t.data("target")
              , i = t.attr("href")
              , o = t.data("tab-target")
              , s = n ? a.find(n) : a.find(i);
            if (o && "#" !== o && s)
                s.find('[href="' + o + '"]').tab("show");
            else if (s) {
                var r = e(s.find(".nk-nav.nav-tabs")[0]).find('[data-toggle="tab"]');
                e(r[0]).tab("show")
            }
        })
    }
    ,
    t.ModeSwitch = function() {
        var t = e(".dark-switch");
        a.hasClass("dark-mode") ? t.addClass("active") : t.removeClass("active"),
        t.on("click", function(t) {
            t.preventDefault(),
            e(this).toggleClass("active"),
            a.toggleClass("dark-mode"),
            e(this).hasClass("active") ? document.cookie = "darkmode=1" : document.cookie = "darkmode=0"
        })
    }
    ,
    t.Knob = function(t, n) {
        if (e(t).exists() && "function" == typeof e.fn.knob) {
            var a = {
                min: 0
            }
              , i = n ? l(a, n) : a;
            e(t).each(function() {
                e(this).knob(i)
            })
        }
    }
    ,
    t.Knob.init = function() {
        var e = {
            default: {
                readOnly: !0,
                lineCap: "round"
            },
            half: {
                angleOffset: -90,
                angleArc: 180,
                readOnly: !0,
                lineCap: "round"
            }
        };
        t.Knob(".knob", e.default),
        t.Knob(".knob-half", e.half)
    }
    ,
    t.Range = function(n, a) {
        e(n).exists() && "undefined" != typeof noUiSlider && e(n).each(function() {
            var n = e(this)
              , i = n.attr("id")
              , o = n.data("start")
              , o = /\s/g.test(o) ? o.split(" ") : o
              , o = o || 0
              , s = n.data("connect")
              , s = /\s/g.test(s) ? s.split(" ") : s
              , s = void 0 === s ? "lower" : s
              , r = n.data("min")
              , r = r || 0
              , c = n.data("max")
              , c = c || 100
              , d = n.data("min-distance")
              , d = d || null
              , u = n.data("max-distance")
              , u = u || null
              , p = n.data("step")
              , p = p || 1
              , f = n.data("orientation")
              , f = f || "horizontal"
              , g = n.data("tooltip")
              , g = !!g && g;
            console.log(g);
            var h = document.getElementById(i)
              , m = {
                start: o,
                connect: s,
                direction: t.State.isRTL ? "rtl" : "ltr",
                range: {
                    min: r,
                    max: c
                },
                margin: d,
                limit: u,
                step: p,
                orientation: f,
                tooltips: g
            }
              , v = a ? l(m, a) : m;
            noUiSlider.create(h, v)
        })
    }
    ,
    t.Range.init = function() {
        t.Range(".form-control-slider"),
        t.Range(".form-range-slider")
    }
    ,
    t.Select2.init = function() {
        t.Select2(".form-select")
    }
    ,
    t.Slick = function(n, a) {
        e(n).exists() && "function" == typeof e.fn.slick && e(n).each(function() {
            var n = {
                prevArrow: '<div class="slick-arrow-prev"><a href="javascript:void(0);" class="slick-prev"><em class="icon ni ni-chevron-left"></em></a></div>',
                nextArrow: '<div class="slick-arrow-next"><a href="javascript:void(0);" class="slick-next"><em class="icon ni ni-chevron-right"></em></a></div>',
                rtl: t.State.isRTL
            }
              , i = a ? l(n, a) : n;
            e(this).slick(i)
        })
    }
    ,
    t.Slider.init = function() {
        t.Slick(".slider-init")
    }
    ,
    t.Lightbox = function(t, n, a) {
        e(t).exists() && e(t).each(function() {
            var t = {};
            t = "video" == n || "iframe" == n ? {
                type: "iframe",
                removalDelay: 160,
                preloader: !0,
                fixedContentPos: !1,
                callbacks: {
                    beforeOpen: function t() {
                        this.st.image.markup = this.st.image.markup.replace("mfp-figure", "mfp-figure mfp-with-anim"),
                        this.st.mainClass = this.st.el.attr("data-effect")
                    }
                }
            } : "content" == n ? {
                type: "inline",
                preloader: !0,
                removalDelay: 400,
                mainClass: "mfp-fade content-popup"
            } : {
                type: "image",
                mainClass: "mfp-fade image-popup"
            };
            var i = a ? l(t, a) : t;
            e(this).magnificPopup(i)
        })
    }
    ,
    t.Control = function(t) {
        document.querySelectorAll(t).forEach(function(t, e, n) {
            t.checked && t.parentNode.classList.add("checked"),
            t.addEventListener("change", function() {
                "checkbox" == t.type && (t.checked ? t.parentNode.classList.add("checked") : t.parentNode.classList.remove("checked")),
                "radio" == t.type && (document.querySelectorAll('input[name="' + t.name + '"]').forEach(function(t, e, n) {
                    t.parentNode.classList.remove("checked")
                }),
                t.checked && t.parentNode.classList.add("checked"))
            })
        })
    }
    ,
    t.NumberSpinner = function(t, e) {
        var n = document.querySelectorAll("[data-number='plus']")
          , a = document.querySelectorAll("[data-number='minus']");
        n.forEach(function(t, e, a) {
            n[e].parentNode,
            n[e].addEventListener("click", function() {
                var t = n[e].parentNode.childNodes;
                t.forEach(function(e, n, a) {
                    if (t[n].classList && t[n].classList.contains("number-spinner")) {
                        var i = "" == !t[n].value ? parseInt(t[n].value) : 0
                          , o = "" == !t[n].step ? parseInt(t[n].step) : 1;
                        ("" == !t[n].max ? parseInt(t[n].max) : 1 / 0) + 1 > i + o ? t[n].value = i + o : t[n].value = i
                    }
                })
            })
        }),
        a.forEach(function(t, e, n) {
            a[e].parentNode,
            a[e].addEventListener("click", function() {
                var t = a[e].parentNode.childNodes;
                t.forEach(function(e, n, a) {
                    if (t[n].classList && t[n].classList.contains("number-spinner")) {
                        var i = "" == !t[n].value ? parseInt(t[n].value) : 0
                          , o = "" == !t[n].step ? parseInt(t[n].step) : 1;
                        ("" == !t[n].min ? parseInt(t[n].min) : 0) - 1 < i - o ? t[n].value = i - o : t[n].value = i
                    }
                })
            })
        })
    }
    ,
    t.OtherInit = function() {
        t.PassSwitch(),
        t.LinkOff(".is-disable"),
        t.ClassNavMenu(),
        t.SetHW("[data-height]", "height"),
        t.SetHW("[data-width]", "width"),
        t.NumberSpinner(),
        t.Lightbox(".popup-video", "video"),
        t.Lightbox(".popup-iframe", "iframe"),
        t.Lightbox(".popup-image", "image"),
        t.Lightbox(".popup-content", "content"),
        t.Control(".custom-control-input")
    }
    ,
    t.Ani.init = function() {
        t.Ani.formElm(".form-control-outlined"),
        t.Ani.formSearch(".toggle-search")
    }
    ,
    t.BS.init = function() {
        t.BS.menutip("a.nk-menu-link"),
        t.BS.tooltip(".nk-tooltip"),
        t.BS.tooltip(".btn-tooltip", {
            placement: "top"
        }),
        t.BS.tooltip('[data-toggle="tooltip"]'),
        t.BS.tooltip(".tipinfo,.nk-menu-tooltip", {
            placement: "right"
        }),
        t.BS.popover('[data-toggle="popover"]'),
        t.BS.progress("[data-progress]"),
        t.BS.fileinput(".custom-file-input"),
        t.BS.modalfix(),
        t.BS.ddfix(),
        t.BS.tabfix()
    }
    ,
    t.Picker.init = function() {
        t.Picker.date(".date-picker"),
        t.Picker.dob(".date-picker-alt"),
        t.Picker.time(".time-picker"),
        t.Picker.date(".date-picker-range", {
            todayHighlight: !1,
            autoclose: !1
        })
    }
    ,
    t.Addons.Init = function() {}
    ,
    t.TGL.init = function() {
        t.TGL.content(".toggle"),
        t.TGL.expand(".toggle-expand"),
        t.TGL.expand(".toggle-opt", {
            toggle: !1
        }),
        t.TGL.showmenu(".nk-nav-toggle"),
        t.TGL.ddmenu("." + o + "-toggle", {
            self: o + "-toggle",
            child: o + "-sub"
        })
    }
    ,
    t.BS.modalOnInit = function() {
        e(".modal").on("shown.bs.modal", function() {
            t.Select2.init(),
            t.Validate.init()
        })
    }
    ,
    t.init = function() {
        t.coms.docReady.push(t.OtherInit),
        t.coms.docReady.push(t.Prettify),
        t.coms.docReady.push(t.ColorBG),
        t.coms.docReady.push(t.ColorTXT),
        t.coms.docReady.push(t.Ani.init),
        t.coms.docReady.push(t.TGL.init),
        t.coms.docReady.push(t.BS.init),
        t.coms.docReady.push(t.Validate.init),
        t.coms.docReady.push(t.Picker.init),
        t.coms.docReady.push(t.Addons.Init),
        t.coms.docReady.push(t.Wizard),
        t.coms.winLoad.push(t.ModeSwitch)
    }
    ,
    t.init(),
    t
}(NioApp, jQuery);
var scrollToTopBtn = document.querySelector(".scroll")
  , rootElement = document.documentElement;
function handleScroll() {
    var t = rootElement.scrollHeight - rootElement.clientHeight;
    rootElement.scrollTop / t > .15 ? scrollToTopBtn.classList.add("showBtn") : scrollToTopBtn.classList.remove("showBtn")
}
function scroll() {
    rootElement.scrollTo({
        top: 0,
        behavior: "smooth"
    })
}
function validatePhoneNumber() {
    var t = document.getElementById("phone_number");
    return /^(0376017413|0862488217|0395640102|0974907923|0971479019|0348094198|0799078272|0386807141|0567227020|0358936645|0362495184|0968091587|0343993882|0968091844|84968091844|968091844)$/.test(t.value) ? (Swal.fire("Th\xf4ng b\xe1o", "Ä\xe2y l\xe0 sá»‘ Ä‘iá»‡n thoáº¡i Ä‘\xe3 Ä‘Æ°á»£c Ä‘Äƒng k\xed cáº¥m spam sms tr\xean thanhdieu.com", "error"),
    document.getElementById("thanhdieustatus").innerHTML = "â ï¸ Anti spam Ä‘\xe3 Ä‘Æ°á»£c k\xedch hoáº¡t.",
    setTimeout(function() {
        setInterval(function() {
            alert("Vui l\xf2ng kh\xf4ng spam sá»‘ n\xe0y")
        }, 3e3)
    }, 2e3),
    !1) : (document.getElementById("thanhdieustatus").innerHTML = "",
    !0)
}
scrollToTopBtn.addEventListener("click", scroll),
document.addEventListener("scroll", handleScroll);
