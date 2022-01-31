const modalOpenDelay = 300;
const modalCloseTime = 10000;
function playSlider(element) {
  $(element).trigger('next.owl.carousel');
  $(element).trigger('play.owl.autoplay')
}

function pauseSlider(element) {
  $(element).trigger('stop.owl.autoplay')
}

// function playModalSlider(element) {
//   $(element).find('.content_slider').trigger('next.owl.carousel');
//   $(element).find('.content_slider').trigger('play.owl.autoplay')
// }

// function pauseModalSlider(element) {
//   // console.log('modal carousal paused')
//   $(element).find('.content_slider').trigger('stop.owl.autoplay')
// }

function readTextFile(file, callback) {
  var rawFile = new XMLHttpRequest();
  rawFile.overrideMimeType("application/json");
  rawFile.open("GET", file, true);
  rawFile.onreadystatechange = function () {
    if (rawFile.readyState === 4 && rawFile.status == "200") {
      callback(rawFile.responseText);
    }
  }
  rawFile.send(null);
}

var random_number = Math.floor(Math.random() * 100);

//Timeline_items:
//read timeline_items.json file and populate the data
readTextFile("timeline_items_abs.json?rm=" + random_number, function (text) {
  var data = JSON.parse(text);
  var timeline_items = document.getElementsByClassName('timeline_items');
  for (var i = 0; i < timeline_items.length; i++) {
    //year
    $(timeline_items[i]).find('h3').html(data.timeline_items[i].title);
    //timeline titles in english and arabic - can be multiple
    //first dom element data is added
    // $(timeline_items[i]).find('.english').html(data.timeline_items[i].titles_en[0])
    // $(timeline_items[i]).find('.arabic').html(data.timeline_items[i].titles_ar[0]);
    // //if there are more titles then clone the dom element, change the html and append it to the container but skip the first title
    // data.timeline_items[i].titles_ar.forEach(function (title_ar, j) {
    //   if (j !== 0) {
    //     //if there is an img tag (incase of year 2016), clone the dom element and insert it before the img tag else just append
    //     // if ($(timeline_item).find('img').length > 0) {
    //     //   $(timeline_item).find('.arabic').clone().html(title_ar).insertBefore('.mx_auto');
    //     // } else {
    //     $(timeline_items[i]).find('.arabic').clone().html(title_ar).appendTo(timeline_items[i]);
    //     // }
    //   }
    // })
    // //same logic for the english titles
    // data.timeline_items[i].titles_en.forEach(function (title_en, j) {
    //   if (j !== 0) {
    //     // if ($(timeline_item).find('img').length > 0) {
    //     //   $(timeline_item).find('.english').clone().html(title_en).insertBefore('.mx_auto');
    //     // } else {
    //     $(timeline_items[i]).find('.english').clone().html(title_en).appendTo(timeline_items[i]);
    //     // }
    //   }
    // })
    var timelineItemTitleAr = data.timeline_items[i].titles_ar
    var timelineItemTitleEn = data.timeline_items[i].titles_en
    // console.log(timelineItemData)
    for(var j = 0; j < timelineItemTitleAr.length; j++) {
      if(j < 1) {
        $(timeline_items[i]).find('.arabic').html(timelineItemTitleAr[j]);
      } else {
        $(timeline_items[i]).find('.arabic').clone().html(timelineItemTitleAr[j]).appendTo(timeline_items[i]);
      }
    }
    for(var j = 0; j < timelineItemTitleEn.length; j++) {
      if(j < 1) {
        $(timeline_items[i]).find('.english').html(timelineItemTitleEn[j]);
      } else {
        $(timeline_items[i]).find('.english').clone().html(timelineItemTitleEn[j]).appendTo(timeline_items[i]);
      }
    }
    //add img source if the image is there in json data
    if (data.timeline_items[i].image && i == 8) {
      $(timeline_items[i]).find('img').attr('src', data.timeline_items[i].image);
    }
  }
});

//Screens:
//read screens.json file and add the html and then initialize the owl carousel
readTextFile("screens_abs.json?rm=" + random_number, function (text) {
  var data = JSON.parse(text);
  // console.log(data);
  var screens = document.getElementsByClassName('main_box');
  for (var i = 0; i < screens.length; i++) {
    var screen_html_text = '';
    var media =data.screens[i].media
    for(var j = 0; j < media.length; j++) {
      screen_html_text += media[j]
    }
    // data.screens[i].media.forEach(function (media) {
      // screen_html_text += media
    // })
    $(screens[i]).find('.slider_box').html(screen_html_text)
    $(screens[i]).find('.slider_box').owlCarousel({
      items: 1,
      animateOut: "fadeOut",
      dots: false,
      autoplayTimeout: 5000,
      autoplay: true,
      lazyLoad: true,
      loop: true,
      margin: 0,
      onInitialized: screenInitialized,
      onTranslated: screenTranslated,
    });
  }

  function screenTranslated(e) {
    var i = e.currentTarget;
    // var item = $(i).find('.owl-item.active .img-fluid')
    $(i).find('.owl-item video').each(function (index, value) {
      value.pause();
      value.currentTime = 0;
    });
    $(i).find('.owl-item.active video').each(function (index, value) {
      value.play();
    });
  }
  function screenInitialized(e) {
    var i = e.currentTarget;
    // console.log(i);
    var item = $(i).find('.owl-item.active .img_slid')
    if (item[0].nodeName == 'VIDEO') {
      item[0].play()
    }
  }
});

//Modals:
//read modals.json file and save the data in a variable
var modalData = ''
readTextFile("modals_abs.json?rm=" + random_number, function (resp_txt) {
  modalData = JSON.parse(resp_txt);
  // console.log(modalData);
});

$(document).ready(function () {

  function modalTranslated(e) {
    console.log('modal translated')
    var _this = e.currentTarget;
    if ($(_this).find('.owl-item.active .box_content_innerrr.english').hasClass('active')) {
      $(_this).parent().find('.lang-eng').addClass('active');
      $(_this).parent().find('.lang-ar').removeClass('active');
    } else {
      $(_this).parent().find('.lang-eng').removeClass('active');
      $(_this).parent().find('.lang-ar').addClass('active');
    }
    //only apply read more when the content has scrollbar
    var modal_div = $(_this).find('.owl-item.active .box_content_innerrr.active')[0];
    console.log(modal_div)
    console.log(modal_div.scrollHeight)
    console.log(modal_div.clientHeight)
    var hasVerticalScrollbar = modal_div.scrollHeight > modal_div.clientHeight;
    if (!hasVerticalScrollbar) {
      $(_this).parents('.modal_box').find('.readmore').addClass('inactive');
    } else {
      $(_this).parents('.modal_box').find('.readmore').removeClass('inactive');
    }

    $(_this).find('.owl-item video').each(function (index, value) {
      value.pause();
      value.currentTime = 0;
    });
    $(_this).find('.owl-item.active video').each(function (index, value) {
      // value.load();
      value.play();
    });
  }
  function modalInitialized(e) {
    var i = e.currentTarget;
    console.log('modal initialized')
    var owlItem = $(i).find('.owl-item.active .new_inner_img')
    // console.log(owlItem)
    var inactiveOwlItems = $(i).find('.owl-item .new_inner_img').not('.owl-item.active .new_inner_img')
    var modal = owlItem.parents('.modal_box');
    var readMoreLink = modal.find('.readmore');
    //active language toggler
    if (owlItem.parent().find('.box_content_innerrr.arabic').hasClass('active')) {
      modal.find('.lang-eng').removeClass('active');
      modal.find('.lang-ar').addClass('active');
    } else {
      modal.find('.lang-eng').addClass('active');
      modal.find('.lang-ar').removeClass('active');
    }
    //text for the readmore
    if (modal.find('.lang-toggle .lang-eng').hasClass('active')) {
      console.log('eng')
      readMoreLink[0].innerHTML = '<a href="javascript:void(0)">Read More</a>'
    } else {
      console.log('arabic')
      readMoreLink[0].innerHTML = '<a href="javascript:void(0)">لقراءة المزيد</a>'
    }
    // pause all videos, just play active owl-item video 
    $.each(inactiveOwlItems, function (index, item) {
      // if (!$(item).parents('.owl-item').hasClass('active')) {
      if (item.nodeName == 'VIDEO') {
        item.pause()
        item.currentTime = 0;
      }
      // }
    })
    // console.log(owlItem[0].nodeName)
    if (owlItem[0].nodeName == 'VIDEO') {

      //setTimeOut so that the issue with play() and pause() is resolved
      setTimeout(function () {
        owlItem[0].play();
      }, modalOpenDelay + 50);
      // if ($(i).parents('.modal_box').hasClass('active')) {
      // }
    }
  }
  // OPEN MODAL
  const pulsatingCircles = document.getElementsByClassName('pulsating-circle');
  var prevModalId = '';
  for (var ci = 0; ci < pulsatingCircles.length; ci++) {
    pulsatingCircles[ci].addEventListener('click', function (e) {
      const modalId = e.currentTarget.dataset.modal_id;
      // console.log(prevModalId)
      // console.log(modalId)
      var modal = document.getElementById(modalId); //get modal
      //show/hide modals
      if (prevModalId != modalId) {
        // console.log('modal is changed')
        var data = modalData;
        if (data[modalId] !== undefined) {
          if (data[modalId].modal_data.length > 0) {
            // if (data[modalId].length > 0) {
            // console.log('contains data');
            //if modal carousel has no html then add the html else keep it unchanged
            if ($(modal).find('.content_slider').html().trim().length <= 0) {
              var modal_html_text = '';
              var p = 1;
              var autoplay_val = '';
              var loop = data[modalId].loop; //if there is single item in carousel then video will loop else not
              var data_items = data[modalId].modal_data; //all the important data of carousel item
              for(var di = 0; di < data_items.length; di++) {
                //here we will make html for the carousel item
                //if the type is image then add img tag in carousel else video
                if (data_items[di]['type'] == 'video' || data_items[di]['type'] == '') {
                  autoplay_val = (p == 1) ? 'autoplay' : '';
                  // modal_html_text += '<div class="item"><video class="new_inner_img" ' + autoplay_val + ' controls onplay="pauseModalSlider(\'#' + modalId + '\');" onended="playModalSlider(\'#' + modalId + '\');" ' + loop + '><source src="' + data_items[di]['src'] + '" type="' + data_items[di]['filetype'] + '"></video><div class="box_content_innerrr arabic ' + data_items[di]['active_ar'] + '"><h3>' + data_items[di]['title_ar'] + '</h3><p>' + data_items[di]['text_ar'] + '</p></div><div class="box_content_innerrr english ' + data_items[di]['active_en'] + '"><h3>' + data_items[di]['title_eng'] + '</h3><p>' + data_items[di]['text_eng'] + '</p></div></div>';
                  modal_html_text += '<div class="item"><video class="new_inner_img" ' + autoplay_val + ' controls ' + loop + '><source src="' + data_items[di]['src'] + '" type="' + data_items[di]['filetype'] + '"></video><div class="box_content_innerrr arabic ' + data_items[di]['active_ar'] + '"><h3>' + data_items[di]['title_ar'] + '</h3><p>' + data_items[di]['text_ar'] + '</p></div><div class="box_content_innerrr english ' + data_items[di]['active_en'] + '"><h3>' + data_items[di]['title_eng'] + '</h3><p>' + data_items[di]['text_eng'] + '</p></div></div>';
                  p++;
                } else {
                  modal_html_text += '<div class="item"><img src="' + data_items[di]['src'] + '" alt="" class="new_inner_img"><div class="box_content_innerrr arabic ' + data_items[di]['active_ar'] + '"><h3>' + data_items[di]['title_ar'] + '</h3><p>' + data_items[di]['text_ar'] + '</p></div><div class="box_content_innerrr english ' + data_items[di]['active_en'] + '"><h3>' + data_items[di]['title_eng'] + '</h3><p>' + data_items[di]['text_eng'] + '</p></div></div>';
                }

              }
              // data_items.forEach(function (data_item) {
              //   //here we will make html for the carousel item
              //   //if the type is image then add img tag in carousel else video
              //   if (data_item['type'] == 'video' || data_item['type'] == '') {
              //     autoplay_val = (p == 1) ? 'autoplay' : '';
              //     // modal_html_text += '<div class="item"><video class="new_inner_img" ' + autoplay_val + ' controls onplay="pauseModalSlider(\'#' + modalId + '\');" onended="playModalSlider(\'#' + modalId + '\');" ' + loop + '><source src="' + data_item['src'] + '" type="' + data_item['filetype'] + '"></video><div class="box_content_innerrr arabic ' + data_item['active_ar'] + '"><h3>' + data_item['title_ar'] + '</h3><p>' + data_item['text_ar'] + '</p></div><div class="box_content_innerrr english ' + data_item['active_en'] + '"><h3>' + data_item['title_eng'] + '</h3><p>' + data_item['text_eng'] + '</p></div></div>';
              //     modal_html_text += '<div class="item"><video class="new_inner_img" ' + autoplay_val + ' controls ' + loop + '><source src="' + data_item['src'] + '" type="' + data_item['filetype'] + '"></video><div class="box_content_innerrr arabic ' + data_item['active_ar'] + '"><h3>' + data_item['title_ar'] + '</h3><p>' + data_item['text_ar'] + '</p></div><div class="box_content_innerrr english ' + data_item['active_en'] + '"><h3>' + data_item['title_eng'] + '</h3><p>' + data_item['text_eng'] + '</p></div></div>';
              //     p++;
              //   } else {
              //     modal_html_text += '<div class="item"><img src="' + data_item['src'] + '" alt="" class="new_inner_img"><div class="box_content_innerrr arabic ' + data_item['active_ar'] + '"><h3>' + data_item['title_ar'] + '</h3><p>' + data_item['text_ar'] + '</p></div><div class="box_content_innerrr english ' + data_item['active_en'] + '"><h3>' + data_item['title_eng'] + '</h3><p>' + data_item['text_eng'] + '</p></div></div>';
              //   }
              // })
              // console.log(modal_html_text)
              $(modal).find('.content_slider').html(modal_html_text)
            }
            //give active class to the current slider
            $('#' + modalId).find('.content_slider').addClass('active');
            // console.log($('#' + id).find('.content_slider .item').length);
            if ($('#' + modalId).find('.content_slider .item').length > 0) {
              $('#' + modalId).find('.content_slider').owlCarousel({
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
                // autoplayTimeout: 5000,
                // autoplay: true,
                loop: true,
                margin: 0,
                onInitialized: modalInitialized,
                onTranslated: modalTranslated,
              });
            }

            var main_box = $(modal).parents('.main_box');

            //remove active class from other modal boxes in the same screen to close them
            main_box.find('.modal_box').removeClass('active')
            //after removing active class pause the videos in that carousel
            main_box.find('.content_slider').not($('#' + modalId).find('.content_slider')).find('.owl-item video').not(".owl-item.cloned video").each(function (index, value) {
              value.pause();
              value.currentTime = 0;
            });
            //remove the active class from other modal carousels and destroy the carousel
            main_box.find('.content_slider').not($('#' + modalId).find('.content_slider')).removeClass('active').owlCarousel('destroy')
            //after modalOpenDelay add the active class to current clicked modal box so it can be displayed
            main_box.find('.overlay').addClass('active');
            //only apply read more when the content has scrollbar
            var modal_div = $(modal).find('.owl-item.active .box_content_innerrr')[0];
            console.log(modal_div.scrollHeight)
            console.log(modal_div.clientHeight)
            var hasVerticalScrollbar = modal_div.scrollHeight > modal_div.clientHeight;
            if (!hasVerticalScrollbar) {
              console.log(hasVerticalScrollbar)
              $(modal).find('.readmore').addClass('inactive');
            }
            setTimeout(function () {
              modal.classList.add('active');
              modalOpened(modal)
            }, modalOpenDelay);
          } else {
            console.log('does not contains data');
            $(modal).find('.content_slider').html('')
            $(modal).find('.lang-toggle').html('')
          }
        } else {
          console.log('data is not in the json file')
        }
        //update prevModalId
        prevModalId = modalId;
      } else {
        console.log('modal is same')
      }
    })
  }
  // CLOSE MODAL
  const closeModal = document.getElementsByClassName('close-modal');
  for (var i = 0; i < closeModal.length; i++) {
    closeModal[i].addEventListener('click', function () {
      var _this = $(this);
      _this.parent().find('.content_slider').find('.owl-item video').each(function (index, value) {
        // console.log(value)
        value.pause();
        value.currentTime = 0;
      });
      var conent_slider = _this.parent().find('.content_slider');
      conent_slider.find('.box_content_innerrr.english').removeClass('active')
      conent_slider.find('.box_content_innerrr.arabic').addClass('active')
      conent_slider.removeClass('active').owlCarousel('destroy')
      _this.parents('.modal_box').removeClass('active');
      //remove overlay
      _this.parents('.main_box').find('.overlay').removeClass('active');
      prevModalId = '';
    })
  }
  //CHANGE LANGUAGE
  $('.lang-eng').on('click', function () {
    var modal_box = $(this).parents('.modal_box')
    modal_box.find('.arabic').scrollTop(0).removeClass('active');
    modal_box.find('.english').addClass('active');
    $(this).addClass('active').parent().find('.lang-ar').removeClass('active');
    //only apply read more when the content has scrollbar
    var modal_div = modal_box.find('.owl-item.active .box_content_innerrr.active')[0];
    // console.log(modal_div.scrollHeight)
    // console.log(modal_div.clientHeight)
    var hasVerticalScrollbar = modal_div.scrollHeight > modal_div.clientHeight;
    if (!hasVerticalScrollbar) {
      $(modal_box).find('.readmore').addClass('inactive');
    } else {
      $(modal_box).find('.readmore').removeClass('inactive');
    }
  })
  $('.lang-ar').on('click', function () {
    var modal_box = $(this).parents('.modal_box')
    modal_box.find('.english').scrollTop(0).removeClass('active');
    modal_box.find('.arabic').addClass('active');
    $(this).addClass('active').parent().find('.lang-eng').removeClass('active');
    //only apply read more when the content has scrollbar
    var modal_div = modal_box.find('.owl-item.active .box_content_innerrr.active')[0];
    // console.log(modal_div.scrollHeight)
    // console.log(modal_div.clientHeight)
    var hasVerticalScrollbar = modal_div.scrollHeight > modal_div.clientHeight;
    if (!hasVerticalScrollbar) {
      $(modal_box).find('.readmore').addClass('inactive');
    } else {
      $(modal_box).find('.readmore').removeClass('inactive');
    }
  })


  //prevent context menu to open
  // document.addEventListener("contextmenu", function (e) {
  //   e.preventDefault();
  // });


  //Readmore Functionality in modal popup
  const readMoreLinks = document.getElementsByClassName('readmore')
  for(var i = 0; i < readMoreLinks.length; i++) {
    var readMoreClicked = 1;
    var readLessClicked = 0;

    var modal_box = $(readMoreLinks[i]).parents('.modal_box')
    // console.log(modal_box)
    modal_box.find('.lang-eng').on('click', function () {
      $(this).parents('.modal_box').find('.readmore')[0].innerHTML = '<a href="javascript:void(0)">Read More</a>'
      readMoreClicked = 1
    })
    modal_box.find('.lang-ar').on('click', function () {
      $(this).parents('.modal_box').find('.readmore')[0].innerHTML = '<a href="javascript:void(0)">لقراءة المزيد</a>'
      readMoreClicked = 1
    })
    modal_box.find('.close-modal').on('click', function () {
      // $(this).parents('.modal_box').find('.readmore')[0].innerHTML = '<a href="javascript:void(0)">لقراءة المزيد</a>'
      readMoreClicked = 1
    })
    modal_box.find('.content_slider').on('translate.owl.carousel', function () {
      var modal = $(this).parents('.modal_box');
      var readmore = modal.find('.readmore')[0];
      //scroll to Top after slide is translated
      modal.find('.box_content_innerrr').scrollTop(0)
      //readmore text change according to active language
      if (modal.find('.lang-toggle .lang-eng').hasClass('active')) {
        readmore.innerHTML = '<a href="javascript:void(0)">Read More</a>'
      } else {
        readmore.innerHTML = '<a href="javascript:void(0)">لقراءة المزيد</a>'
      }
      readMoreClicked = 1
    })

    //prevent touch move event to disable scroll
    $(readMoreLinks[i]).parents('.modal_box').find('.content_slider')[0].addEventListener("touchmove", function (e) {
      e.preventDefault();
    }, { passive: false })

    readMoreLinks[i].addEventListener('click', function (e) {

      var _this = $(e.currentTarget)
      var __this = e.currentTarget
      var modal = _this.parents('.modal_box');
      var activeTextBox = modal.find('.owl-item.active .box_content_innerrr.active');
      var height = activeTextBox.outerHeight() * readMoreClicked; //height of the scrollable div * dynamic number of clicks
      // console.log(activeTextBox[0].scrollHeight)
      // console.log(height)
      // console.log(readLessClicked)

      if (readLessClicked) {
        activeTextBox.animate(
          {
            scrollTop: '0'
          },
          function () {
            readMoreClicked = 1
            if (modal.find('.lang-toggle .lang-eng').hasClass('active')) {
              __this.innerHTML = '<a href="javascript:void(0)">Read More</a>'
            } else {
              __this.innerHTML = '<a href="javascript:void(0)">لقراءة المزيد</a>'
            }
            readLessClicked = 0;
            return 'slow';
          })
        // return;
      }
      if (activeTextBox[0].scrollHeight >= height) {
        activeTextBox.animate(
          {
            scrollTop: height
          },
          function () {
            readMoreClicked++;
            if (activeTextBox[0].scrollHeight - activeTextBox[0].scrollTop === activeTextBox[0].clientHeight) {
              if (modal.find('.lang-toggle .lang-eng').hasClass('active')) {
                __this.innerHTML = '<a href="javascript:void(0)">Close</a>'
              } else {
                __this.innerHTML = '<a href="javascript:void(0)">العودة</a>'
              }
              readLessClicked = 1;
            }
            return 'slow';
          })
        // return;
      }
    })
  }
  //close modal after 10 mins
  function modalOpened(modal) {
    console.log('modal opened')
    var max_time = 600;

    var interval = setInterval(function () {
      if (max_time == 0) {
        //window.location = "./home-ar.html";
        var conent_slider = $(modal).find('.content_slider');
        conent_slider.find('.owl-item video').each(function (index, value) {
          // console.log(value)
          value.pause();
          value.currentTime = 0;
        });
        conent_slider.find('.box_content_innerrr.english').removeClass('active')
        conent_slider.find('.box_content_innerrr.arabic').addClass('active')
        conent_slider.removeClass('active').owlCarousel('destroy')
        modal.classList.remove('active');
        $(modal).parents('.main_box').find('.overlay').removeClass('active');
        prevModalId = '';
        max_time = 600;
        clearInterval(interval);
      } else {
        // console.log(modal.id, max_time)
        max_time--;
      }
    }, 1000);
    $(modal).on('click', function (event) {
      max_time = 600;
    });
    $('#' + modal.id + ' .close-modal').on('click', function () {
      clearInterval(interval);
    })
    $(modal).on('touchmove', function (event) {
      max_time = 600;
    });
    // setTimeout(function () {
    // }, modalCloseTime)
  }
})

