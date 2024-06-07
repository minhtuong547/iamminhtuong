window.addEventListener("DOMContentLoaded", function() {
  const html            = document.querySelector("html");
  const navBtn          = document.querySelector(".navbar-btn");
  const navList         = document.querySelector(".navbar-list");
  const backToTopFixed  = document.querySelector(".back-to-top-fixed");
  let lastTop           = 0;
  let theme             = window.localStorage.getItem('theme') || '';

  theme && html.classList.add(theme)

  const goScrollTop = () => {
    let currentTop = getScrollTop()
    let speed = Math.floor(-currentTop / 10)
    if (currentTop > lastTop) {
      return lastTop = 0
    }
    let distance = currentTop + speed;
    lastTop = distance;
    document.documentElement.scrollTop = distance;
    distance > 0 && window.requestAnimationFrame(goScrollTop)
  }

  const toggleBackToTopBtn = (top) => {
    top = top || getScrollTop()
    if (top >= 100) {
      backToTopFixed.classList.add("show")
    } else {
      backToTopFixed.classList.remove("show")
    }
  }

  toggleBackToTopBtn()

  // theme light click
  document.querySelector('#theme-light').addEventListener('click', function () {
    html.classList.remove('theme-dark')
    html.classList.add('theme-light')
    window.localStorage.setItem('theme', 'theme-light')
  })

  // theme dark click
  document.querySelector('#theme-dark').addEventListener('click', function () {
    html.classList.remove('theme-light')
    html.classList.add('theme-dark')
    window.localStorage.setItem('theme', 'theme-dark')
  })

  // theme auto click
  document.querySelector('#theme-auto').addEventListener('click', function() {
    html.classList.remove('theme-light')
    html.classList.remove('theme-dark')
    window.localStorage.setItem('theme', '')
  })

  // mobile nav click
  navBtn.addEventListener("click", function () {
    html.classList.toggle("show-mobile-nav");
    this.classList.toggle("active");
  });

  // mobile nav link click
  navList.addEventListener("click", function (e) {
    if (e.target.nodeName == "A" && html.classList.contains("show-mobile-nav")) {
      navBtn.click()
    }
  })

  // click back to top
  backToTopFixed.addEventListener("click", function () {
    lastTop = getScrollTop()
    goScrollTop()
  });

  window.addEventListener("scroll", function () {
    toggleBackToTopBtn()
  }, { passive: true });

  handleLazyBG();
});

/**
 *
 *
 * @returns 
 */
function getScrollTop () {
  return window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
}

function querySelectorArrs (selector) {
  return Array.from(document.querySelectorAll(selector))
}


function handleLazyBG () {
  const lazyBackgrounds = querySelectorArrs('[background-image-lazy]')
  let lazyBackgroundsCount = lazyBackgrounds.length
  if (lazyBackgroundsCount > 0) {
    let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function({ isIntersecting, target }) {
        if (isIntersecting) {
          let img = target.dataset.img
          if (img) {
            target.style.backgroundImage = `url(${img})`
          }
          lazyBackgroundObserver.unobserve(target)
          lazyBackgroundsCount --
        }
        if (lazyBackgroundsCount <= 0) {
          lazyBackgroundObserver.disconnect()
        }
      })
    })

    lazyBackgrounds.forEach(function(lazyBackground) {
      lazyBackgroundObserver.observe(lazyBackground)
    })
  }
}
let paginationLeftPos = "20px";
let paginationOpacity = 0;
let checkPaginationClick = 0;

$(".pagination-page-number").click(function () {
  $(".pagination-page-number").removeClass("active");
  $(this).addClass("active");
  paginationLeftPos = $(this).prop("offsetLeft") + "px";
  paginationOpacity = 1;
  checkPaginationClick = 1;

  $(".pagination-hover-overlay").css({
    left: paginationLeftPos,
    backgroundColor: "#C0C0C0",
    opacity: paginationOpacity,
  });
  $(this).css({
    color: "#fff",
  });
});

$(".pagination-page-number").hover(
  function () {
    paginationOpacity = 1;
    $(".pagination-hover-overlay").css({
      backgroundColor: "#808080",
      left: $(this).prop("offsetLeft") + "px",
      opacity: paginationOpacity,
    });

    $(".pagination-page-number.active").css({
      color: "#808080",
    });

    $(this).css({
      color: "#fff",
    });
  },
  function () {
    if (checkPaginationClick) {
      paginationOpacity = 1;
    } else {
      paginationOpacity = 0;
    }

    $(".pagination-hover-overlay").css({
      backgroundColor: "#FF66CC",
      opacity: paginationOpacity,
      left: paginationLeftPos,
    });

    $(this).css({
      color: "#444444",
    });

    $(".pagination-page-number.active").css({
      color: "#fff",
    });
  }
);

function error_page() {
  Swal.fire(
      'latiuem Cho Biết',
      'Có lẻ mục này không tồn tại hoặc đang bảo trì !',
      'error'
  )
}

function error_back_next() {
  Swal.fire(
      'latiuem Cho Biết',
      'Có lẻ mục này không tồn tại hoặc đang bảo trì !',
      'error'
  )
}

