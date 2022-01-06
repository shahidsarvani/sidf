$(document).ready(function () {

  function modalTranslated(e) {
    // console.log('modal translated')
    var i = e.currentTarget;
    if($(i).find('.owl-item.active .box_content_innerrr.english').hasClass('active')) {
      $(i).parent().find('.lang-eng').addClass('active');
      $(i).parent().find('.lang-ar').removeClass('active');
    } else {
      $(i).parent().find('.lang-eng').removeClass('active');
      $(i).parent().find('.lang-ar').addClass('active');
    }
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
    // console.log('modal initialized')
    var owlItem = $(i).find('.owl-item.active .new_inner_img')
    var inactiveOwlItems = $(i).find('.owl-item .new_inner_img')
    $.each(inactiveOwlItems, function (index, item) {
      if (item.nodeName == 'VIDEO') {
        item.pause()
      }
    })
    if (owlItem[0].nodeName == 'VIDEO') {
      owlItem[0].play()
    }
    if(owlItem.parent().find('.box_content_innerrr.english').hasClass('active')) {
      owlItem.parents('.modal_box').find('.lang-eng').addClass('active');
      owlItem.parents('.modal_box').find('.lang-ar').removeClass('active');
    } else {
      owlItem.parents('.modal_box').find('.lang-eng').removeClass('active');
      owlItem.parents('.modal_box').find('.lang-ar').addClass('active');
    }
  }

  // OPEN MODAL
  const pulsatingCircle = document.querySelectorAll('.pulsating-circle');
  var prevId = '';
  pulsatingCircle.forEach(function (item) {
    item.addEventListener('click', function (e) {
      const id = e.currentTarget.dataset.modal_id;
      var modal = document.getElementById(id); //get modal
      //show/hide modals
      if (prevId == id) {
        // console.log('modal is same')
      } else {
        // console.log('modal is changed')
        readTextFile("modals.json", function (text) {
          var data = JSON.parse(text);
          if (data[id] == undefined) {
            // console.log('data is not added')
          } else {
            if (data[id].length == 0) {
              // console.log('does not contains data');
              $(modal).find('.content_slider').html('')
              $(modal).find('.lang-toggle').html('')
            } else {
              // console.log('contains data');
              var html = data[id];
              $(modal).find('.content_slider').html(html)
            }
            $('#' + id).find('.content_slider').addClass('active');
            // console.log($('#' + id).find('.content_slider .item').length);
            if ($('#' + id).find('.content_slider .item').length != 0) {
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
            }
          }
        });
        $(modal).parents('.main_box').find('.modal_box').removeClass('active')
        $(modal).parents('.main_box').find('.content_slider').find('.owl-item video').not(".owl-item.cloned video").each(function (index, value) {
          value.pause();
          value.currentTime = 0;
        });
        $(modal).parents('.main_box').find('.content_slider').removeClass('active').owlCarousel('destroy')
        setTimeout(function () {
          modal.classList.add('active');
        }, 300);
        prevId = id;
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
      prevId = '';
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

