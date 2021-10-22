$(document).ready(function () {
  // $(".slider_one").owlCarousel({
  //   items: 1,
  //   animateOut: "fadeOut",
  //   dots: false,
  //   autoplayTimeout: 5000,
  //   autoplay: true,
  //   loop: true,
  //   margin: 0,
  // });
  // $(".slider_two").owlCarousel({
  //   items: 1,
  //   animateOut: "fadeOut",
  //   dots: false,
  //   autoplayTimeout: 4500,
  //   autoplay: true,
  //   loop: true,
  //   margin: 0,
  // });
  // $(".slider_three").owlCarousel({
  //   items: 1,
  //   animateOut: "fadeOut",
  //   dots: false,
  //   autoplayTimeout: 4000,
  //   autoplay: true,
  //   loop: true,
  //   margin: 0,
  // });
  // $(".slider_four").owlCarousel({
  //   items: 1,
  //   animateOut: "fadeOut",
  //   dots: false,
  //   autoplayTimeout: 3500,
  //   autoplay: true,
  //   loop: true,
  //   margin: 0,
  // });
  // $(".slider_five").owlCarousel({
  //   items: 1,
  //   animateOut: "fadeOut",
  //   dots: false,
  //   autoplayTimeout: 3000,
  //   autoplay: true,
  //   loop: true,
  //   margin: 0,
  // });
  // $(".slider_six").owlCarousel({
  //   items: 1,
  //   animateOut: "fadeOut",
  //   dots: false,
  //   autoplayTimeout: 2500,
  //   autoplay: true,
  //   loop: true,
  //   margin: 0,
  // });
  // $(".slider_seven").owlCarousel({
  //   items: 1,
  //   animateOut: "fadeOut",
  //   dots: false,
  //   autoplayTimeout: 2000,
  //   autoplay: true,
  //   loop: true,
  //   margin: 0,
  // });
  // $(".content_slider").owlCarousel({
  //   items: 1,
  //   animateOut: "fadeOut",
  //   dots: false,
  //   video: true,
  //   nav: $(".content_slider").find('.item').length > 1,
  //   navText: [
  //     "<img src='./assets/frontend_assets/img/arrow_left.svg'>",
  //     "<img src='./assets/frontend_assets/img/arrow_right.svg'>",
  //   ],
  //   autoplayTimeout: 5000,
  //   autoplay: true,
  //   loop: true,
  //   margin: 0,
  // });

  
  // OPEN MODAL
  const pulsatingCircle = document.querySelectorAll('.pulsating-circle');
  pulsatingCircle.forEach(function (item) {
    item.addEventListener('click', function (e) {
      const id = e.currentTarget.dataset.modal_id;
      var modal = document.getElementById(id); //get modal
      //show/hide modals
      if ($(modal).parents('.main_box').find('.modal_box').hasClass('active')) {
        console.log('if')
        console.log(modal);
        $(modal).parents('.main_box').find('.modal_box').removeClass('active')
        $(modal).parents('.main_box').find('.content_slider').find('.owl-item video').not(".owl-item.cloned video").each(function (index, value) {
          console.log(value);
          this.pause();
          this.currentTime = 0;
        });
        $(modal).parents('.main_box').find('.content_slider').removeClass('active').owlCarousel('destroy')
        setTimeout(function () {
          modal.classList.add('active');
        }, 300);
      } else {
        console.log('else')
        modal.classList.add('active');
      }
      $('#' + id).find('.content_slider').addClass('active');
      $('#' + id).find('.content_slider').owlCarousel({
        items: 1,
        animateOut: "fadeOut",
        dots: false,
        video: true,
        lazyLoad: true,
        nav: true,
        navText: [
          "<img src='./assets/frontend_assets/img/arrow_left.svg'>",
          "<img src='./assets/frontend_assets/img/arrow_right.svg'>",
        ],
        autoplayTimeout: 5000,
        autoplay: true,
        loop: true,
        margin: 0,
        onInitialized: modalInitialized,
        onTranslated: modalTranslated,
      });

      function modalTranslated(e) {
        var i = e.currentTarget;
        $(i).find('.owl-item video').each(function (index, value) {
          this.pause();
          this.currentTime = 0;
        });
        $(i).find('.owl-item.active video').each(function (index, value) {
          this.play();
        });
      }
      function modalInitialized(e) {
        var i = e.currentTarget;
        // console.log(i);
        var owlItem = $(i).find('.owl-item.active .new_inner_img')
        if (owlItem[0].nodeName == 'VIDEO') {
          owlItem[0].play()
        }
      }
    })
  })
  // CLOSE MODAL
  const closeModal = document.querySelectorAll('.close-modal');
  closeModal.forEach(function (close) {
    close.addEventListener('click', function () {
      $(this).parent().find('.content_slider').find('.owl-item video').each(function (index, value) {
        this.pause();
        this.currentTime = 0;
      });
      $(this).parent().find('.content_slider').removeClass('active').owlCarousel('destroy')
      $(this).parents('.modal_box').removeClass('active');
    })
  })
  //CHANGE LANGUAGE
  $('.lang-eng').click(function () {
    $(this).parents('.modal_box').find('.arabic').removeClass('active');
    $(this).parents('.modal_box').find('.english').addClass('active');
    $(this).addClass('active').parent().find('.lang-ar').removeClass('active');
  })
  $('.lang-ar').click(function () {
    $(this).parents('.modal_box').find('.english').removeClass('active');
    $(this).parents('.modal_box').find('.arabic').addClass('active');
    $(this).addClass('active').parent().find('.lang-eng').removeClass('active');
  })

  //READ TIMELINE ITEMS JSON
  
})

