(function ($) {
  "use strict";

  /* Preloader */
  var preloader = $("#preloader");


  $(window).on('load', function () {
    preloader.fadeOut('slow');
  });


  /* Sticky Header */
  var header = $(".page-header");
  var mobileNav = $(".mobile-nav");
  var toggleClass = "is-sticky";
  var scrollLast = 0;


  function toggleHeader() {
    var scrollTop = $(window).scrollTop();
    var direction = scrollTop > scrollLast ? 'down' : 'up';
    scrollLast = scrollTop;

    if (scrollTop > 300 && direction == 'up') {
      if (!header.hasClass(toggleClass)) {
        header.addClass(toggleClass);
        mobileNav.animate({ opacity: 0 }, 100, function () {
          mobileNav.animate({ opacity: 1 }, 100);
        });
      }
    } else {
      header.removeClass(toggleClass);
      if (scrollTop > 300) {
        mobileNav.css('opacity', '0');
      }

    }
  }


  $(window).on('scroll', toggleHeader);

  /* Single page Anchor Menu */

  window.addEventListener('DOMContentLoaded', event => {
    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#navbar');
    if (mainNav) {
      new bootstrap.ScrollSpy(document.body, {
        target: '#navbar',
        offset: 40,
      });
    };

    // Function to check if the device is a mobile device based on screen width
    function isMobileDevice() {
      return window.innerWidth <= 992; // Adjust the width as needed for your design
    }
    // Get the necessary elements
    const navbarToggler = document.querySelector('.menu-toggler');
    const navItemsContainer = document.querySelector('#navbar');


    // Function to handle the click event
    function handleNavItemClick(event) {
      if (isMobileDevice() && event.target.classList.contains('nav-link')) {
        navbarToggler.click();
      }
    }

    // Attach the click event listener only if it's a mobile device
    if (isMobileDevice()) {
      navItemsContainer.addEventListener('click', handleNavItemClick);
    }


  });

  /* Menu Toggler */
  var menu = $('.menu-toggler');


  menu.on('click', function () {
    menu.toggleClass('open');
    if (menu.hasClass('open')) {
      $('html').addClass('no-scroll');
      $('body').addClass('no-scroll');
    }
    else {
      $('html').removeClass('no-scroll');
      $('body').removeClass('no-scroll');
    }
  });


  /* Swiper Instance */
  if ($('.swiper').length) {
    var swiper = new Swiper('.swiper', {
      loop: true,
      speed: 1000,
      autoHeight: false,
      effect: 'fade',
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      }
    });
  }


  /* Lottie Player */
  const playerContainers = document.querySelectorAll(".service-box");
  playerContainers.forEach(container => {
    container.addEventListener("mouseover", () => {
      const player = container.querySelector("lottie-player");
      player.setDirection(1);
      player.play();
    });

    container.addEventListener("mouseleave", () => {
      const player = container.querySelector("lottie-player");
      player.setDirection(-1);
      player.play();
    });
  });



  /* Project Slider */
  if ($('.project-thumb-carousel').length) {
    var projectThumbCarousel = new Swiper('.project-thumb-carousel', {
      slidesPerView: 1,
      spaceBetween: 0,
      freeMode: true,
      effect: 'fade',
      speed: 1400,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
      loop: true,
      grabCursor: true,
      autoplay: false,
      thumbs: {
        swiper: projectContentCarousel
      }
    });
  }


  if ($('.project-content-carousel').length) {
    var projectContentCarousel = new Swiper('.project-content-carousel', {
      pagination: {
        el: '.swiper-project-pagination',
        clickable: true,
      },
      observer: true,
      observeParents: true,
      speed: 1400,
      mousewheel: false,
      grabCursor: true,
      autoplay: false,
      autoplay: {
        delay: 5000,
      },
      thumbs: {
        swiper: projectThumbCarousel
      }
    });
  }


  /* Testimonial Slider */
  if ($('.testimonial-slider').length) {
    var testimonialCarousel = new Swiper('.testimonial-slider', {
      pagination: {
        el: '.swiper-testimonial-pagination',
        clickable: true,
      },
      observer: true,
      effect: "cube",
      grabCursor: true,
      cubeEffect: {
        shadow: false,
        slideShadows: false,
      },
      observeParents: true,
      speed: 1400,
      mousewheel: false,
      autoplay: {
        delay: 5000,
      }
    });
  }
  /* Client Slider */
  if ($('.client-slider').length) {
    var clientSwiper = new Swiper('.client-slider', {
      loop: false,
      speed: 1000,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },

      breakpoints: {
        0: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        414: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 15,
        },
        991: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
        1219: {
          slidesPerView: 5,
          spaceBetween: 25,
        },
      }
    });
  }

})(jQuery);