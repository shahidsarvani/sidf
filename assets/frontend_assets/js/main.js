const modalOpenDelay = 300;
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
readTextFile("timeline_items.json?rm=" + random_number, function (text) {
  var data = JSON.parse(text);
  var timeline_items = document.querySelectorAll('.timeline_items');
  timeline_items.forEach(function (timeline_item, i) {
    //year
    $(timeline_item).find('h3').html(data.timeline_items[i].title);
    //timeline titles in english and arabic - can be multiple
    //first dom element data is added
    $(timeline_item).find('.english').html(data.timeline_items[i].titles_en[0])
    $(timeline_item).find('.arabic').html(data.timeline_items[i].titles_ar[0]);
    //if there are more titles then clone the dom element, change the html and append it to the container but skip the first title
    data.timeline_items[i].titles_ar.forEach(function (title_ar, j) {
      if (j !== 0) {
        //if there is an img tag (incase of year 2016), clone the dom element and insert it before the img tag else just append
        // if ($(timeline_item).find('img').length > 0) {
        //   $(timeline_item).find('.arabic').clone().html(title_ar).insertBefore('.mx_auto');
        // } else {
        $(timeline_item).find('.arabic').clone().html(title_ar).appendTo(timeline_item);
        // }
      }
    })
    //same logic for the english titles
    data.timeline_items[i].titles_en.forEach(function (title_en, j) {
      if (j !== 0) {
        // if ($(timeline_item).find('img').length > 0) {
        //   $(timeline_item).find('.english').clone().html(title_en).insertBefore('.mx_auto');
        // } else {
        $(timeline_item).find('.english').clone().html(title_en).appendTo(timeline_item);
        // }
      }
    })
    //add img source if the image is there in json data
    if (data.timeline_items[i].image && i == 8) {
      $(timeline_item).find('img').attr('src', data.timeline_items[i].image);
    }
  })
});

//Screens:
//read screens.json file and add the html and then initialize the owl carousel
readTextFile("screens.json?rm=" + random_number, function (text) {
  var data = JSON.parse(text);
  // console.log(data);
  var screens = document.querySelectorAll('.main_box');
  screens.forEach(function (screen, i) {
    var screen_html_text = '';
    data.screens[i].media.forEach(function (media) {
      screen_html_text += media
    })
    $(screen).find('.slider_box').html(screen_html_text)
    $(screen).find('.slider_box').owlCarousel({
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
  })

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
readTextFile("modals.json?rm=" + random_number, function (resp_txt) {
  modalData = JSON.parse(resp_txt);
  // console.log(modalData);
});

$(document).ready(function () {

  function modalTranslated(e) {
    console.log('modal translated')
    var i = e.currentTarget;
    if ($(i).find('.owl-item.active .box_content_innerrr.english').hasClass('active')) {
      $(i).parent().find('.lang-eng').addClass('active');
      $(i).parent().find('.lang-ar').removeClass('active');
    } else {
      $(i).parent().find('.lang-eng').removeClass('active');
      $(i).parent().find('.lang-ar').addClass('active');
    }
    $(i).find('.owl-item video').each(function (index, value) {
      value.pause();
      value.currentTime = 0;
    });
    $(i).find('.owl-item.active video').each(function (index, value) {
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
    //active language toggler
    if (owlItem.parent().find('.box_content_innerrr.arabic').hasClass('active')) {
      owlItem.parents('.modal_box').find('.lang-eng').removeClass('active');
      owlItem.parents('.modal_box').find('.lang-ar').addClass('active');
    } else {
      owlItem.parents('.modal_box').find('.lang-eng').addClass('active');
      owlItem.parents('.modal_box').find('.lang-ar').removeClass('active');
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
  const pulsatingCircles = document.querySelectorAll('.pulsating-circle');
  var prevModalId = '';
  pulsatingCircles.forEach(function (pulsatingCircle) {
    pulsatingCircle.addEventListener('touchstart', function (e) {
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
              data_items.forEach(function (data_item) {
                //here we will make html for the carousel item
                //if the type is image then add img tag in carousel else video
                if (data_item['type'] == 'video' || data_item['type'] == '') {
                  autoplay_val = (p == 1) ? 'autoplay' : '';
                  // modal_html_text += '<div class="item"><video class="new_inner_img" ' + autoplay_val + ' controls onplay="pauseModalSlider(\'#' + modalId + '\');" onended="playModalSlider(\'#' + modalId + '\');" ' + loop + '><source src="' + data_item['src'] + '" type="' + data_item['filetype'] + '"></video><div class="box_content_innerrr arabic ' + data_item['active_ar'] + '"><h3>' + data_item['title_ar'] + '</h3><p>' + data_item['text_ar'] + '</p></div><div class="box_content_innerrr english ' + data_item['active_en'] + '"><h3>' + data_item['title_eng'] + '</h3><p>' + data_item['text_eng'] + '</p></div></div>';
                  modal_html_text += '<div class="item"><video class="new_inner_img" ' + autoplay_val + ' controls ' + loop + '><source src="' + data_item['src'] + '" type="' + data_item['filetype'] + '"></video><div class="box_content_innerrr arabic ' + data_item['active_ar'] + '"><h3>' + data_item['title_ar'] + '</h3><p>' + data_item['text_ar'] + '</p></div><div class="box_content_innerrr english ' + data_item['active_en'] + '"><h3>' + data_item['title_eng'] + '</h3><p>' + data_item['text_eng'] + '</p></div></div>';
                  p++;
                } else {
                  modal_html_text += '<div class="item"><img src="' + data_item['src'] + '" alt="" class="new_inner_img"><div class="box_content_innerrr arabic ' + data_item['active_ar'] + '"><h3>' + data_item['title_ar'] + '</h3><p>' + data_item['text_ar'] + '</p></div><div class="box_content_innerrr english ' + data_item['active_en'] + '"><h3>' + data_item['title_eng'] + '</h3><p>' + data_item['text_eng'] + '</p></div></div>';
                }
              })
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

            //remove active class from other modal boxes in the same screen to close them
            $(modal).parents('.main_box').find('.modal_box').removeClass('active')
            //after removing active class pause the videos in that carousel
            $(modal).parents('.main_box').find('.content_slider').not($('#' + modalId).find('.content_slider')).find('.owl-item video').not(".owl-item.cloned video").each(function (index, value) {
              value.pause();
              value.currentTime = 0;
            });
            //remove the active class from other modal carousels and destroy the carousel
            $(modal).parents('.main_box').find('.content_slider').not($('#' + modalId).find('.content_slider')).removeClass('active').owlCarousel('destroy')
            //after modalOpenDelay add the active class to current clicked modal box so it can be displayed
            setTimeout(function () {
              modal.classList.add('active');
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
  })
  // CLOSE MODAL
  const closeModal = document.querySelectorAll('.close-modal');
  closeModal.forEach(function (close) {
    close.addEventListener('touchstart', function () {
      $(this).parent().find('.content_slider').find('.owl-item video').each(function (index, value) {
        // console.log(value)
        value.pause();
        value.currentTime = 0;
      });
      $(this).parent().find('.content_slider').removeClass('active').owlCarousel('destroy')
      $(this).parents('.modal_box').removeClass('active');
      prevModalId = '';
    })
  })
  //CHANGE LANGUAGE
  $('.lang-eng').on('touchstart', function () {
    $(this).parents('.modal_box').find('.arabic').scrollTop(0).removeClass('active');
    $(this).parents('.modal_box').find('.english').addClass('active');
    $(this).addClass('active').parent().find('.lang-ar').removeClass('active');
  })
  $('.lang-ar').on('touchstart', function () {
    $(this).parents('.modal_box').find('.english').scrollTop(0).removeClass('active');
    $(this).parents('.modal_box').find('.arabic').addClass('active');
    $(this).addClass('active').parent().find('.lang-eng').removeClass('active');
  })


  //prevent context menu to open
  document.addEventListener("contextmenu", function (e) {
    e.preventDefault();
  });


  //Readmore Functionality in modal popup
  const readMoreLinks = document.querySelectorAll('.readmore')
  readMoreLinks.forEach(function (readMoreLink) {
    var readMoreClicked = 1;
    var readLessClicked = 0;

    $(readMoreLink).parents('.modal_box').find('.lang-eng').click(function () {
      readMoreLink.innerHTML = '<a href="javascript:void(0)">Read more</a>'
      readMoreClicked = 1
    })
    $(readMoreLink).parents('.modal_box').find('.lang-ar').click(function () {
      readMoreLink.innerHTML = '<a href="javascript:void(0)">إقرأ المزيد</a>'
      readMoreClicked = 1
    })
    $(readMoreLink).parents('.modal_box').find('.close-modal').click(function () {
      // readMoreLink.innerHTML = '<a href="javascript:void(0)">إقرأ المزيد</a>'
      readMoreClicked = 1
    })
    $(readMoreLink).parents('.modal_box').find('.content_slider').on('translate.owl.carousel', function () {
      if ($(readMoreLink).parents('.modal_box').find('.lang-toggle .lang-eng').hasClass('active')) {
        readMoreLink.innerHTML = '<a href="javascript:void(0)">Read more</a>'
      } else {
        readMoreLink.innerHTML = '<a href="javascript:void(0)">إقرأ المزيد</a>'
      }
      readMoreClicked = 1
    })

    // disable scroll on mousewheel
    // $('.modal_box').on("wheel mousewheel", function (e) {
    //   var modal = e.currentTarget;
    //   var activeTextBox = $(modal).find('.owl-item.active .box_content_innerrr.active');
    //   var readMoreLink = $(modal).find('.readmore')[0]
    //   if (activeTextBox[0].scrollHeight - activeTextBox[0].scrollTop === activeTextBox[0].clientHeight) {
    //     if($(modal).find('.lang-toggle .lang-eng').hasClass('active')) {
    //       readMoreLink.innerHTML = '<a href="javascript:void(0)">Close</a>'
    //     } else {
    //       readMoreLink.innerHTML = '<a href="javascript:void(0)">أغلق</a>'
    //     }
    //     readLessClicked = 1
    //   } else {
    //     if($(modal).find('.lang-toggle .lang-eng').hasClass('active')) {
    //       readMoreLink.innerHTML = '<a href="javascript:void(0)">Read more</a>'
    //     } else {
    //       readMoreLink.innerHTML = '<a href="javascript:void(0)">إقرأ المزيد</a>'
    //     }
    //     readLessClicked = 0
    //   }
    // });


    //prevent touch move event to disable scroll
    $(readMoreLink).parents('.modal_box').find('.content_slider')[0].addEventListener("touchmove", function (e) {
      e.preventDefault();
    }, { passive: false })

    readMoreLink.addEventListener('touchstart', function (event) {

      console.log(Date.now());
      var modal = $(readMoreLink).parents('.modal_box');
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
              readMoreLink.innerHTML = '<a href="javascript:void(0)">Read more</a>'
            } else {
              readMoreLink.innerHTML = '<a href="javascript:void(0)">إقرأ المزيد</a>'
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
                readMoreLink.innerHTML = '<a href="javascript:void(0)">Close</a>'
              } else {
                readMoreLink.innerHTML = '<a href="javascript:void(0)">أغلق</a>'
              }
              readLessClicked = 1;
            }
            return 'slow';
          })
        // return;
      }
    })
    // readMoreLink.addEventListener('click', function (event) {

    //   console.log(Date.now());
    //   var modal = $(readMoreLink).parents('.modal_box');
    //   var activeTextBox = modal.find('.owl-item.active .box_content_innerrr.active');
    //   var height = activeTextBox.outerHeight() * readMoreClicked; //height of the scrollable div * dynamic number of clicks
    //   // console.log(activeTextBox[0].scrollHeight)
    //   // console.log(height)
    //   // console.log(readLessClicked)

    //   if (readLessClicked) {
    //     activeTextBox.animate(
    //       {
    //         scrollTop: '0'
    //       },
    //       function () {
    //         readMoreClicked = 1
    //         if (modal.find('.lang-toggle .lang-eng').hasClass('active')) {
    //           readMoreLink.innerHTML = '<a href="javascript:void(0)">Read more</a>'
    //         } else {
    //           readMoreLink.innerHTML = '<a href="javascript:void(0)">إقرأ المزيد</a>'
    //         }
    //         readLessClicked = 0;
    //         return 'slow';
    //       })
    //     // return;
    //   }
    //   if (activeTextBox[0].scrollHeight >= height) {
    //     activeTextBox.animate(
    //       {
    //         scrollTop: height
    //       },
    //       function () {
    //         readMoreClicked++;
    //         if (activeTextBox[0].scrollHeight - activeTextBox[0].scrollTop === activeTextBox[0].clientHeight) {
    //           if (modal.find('.lang-toggle .lang-eng').hasClass('active')) {
    //             readMoreLink.innerHTML = '<a href="javascript:void(0)">Close</a>'
    //           } else {
    //             readMoreLink.innerHTML = '<a href="javascript:void(0)">أغلق</a>'
    //           }
    //           readLessClicked = 1;
    //         }
    //         return 'slow';
    //       })
    //     // return;
    //   }
    // })
  })

  //Multitouch Scroll for modal popups
  // function isDescendant(child, queryString) {
  //   if (child.matches(queryString)) {
  //     return child;
  //   }
  //   var parent = child.parentNode;
  //   while (parent.matches) {
  //     if (parent.matches(queryString)) {
  //       return parent;
  //     }
  //     parent = parent.parentNode;
  //   }
  //   return false;
  // }

  // var touchedTargets = [];
  // var touchedData = [];


  // document.body.addEventListener('touchstart', function (event) {
  //   console.log('touchstart')
  //   var insideTarget = isDescendant(event.target, ".modal_box");
  //   console.log(insideTarget)
  //   if (insideTarget) {
  //     var index = touchedTargets.indexOf(event.target);
  //     if (index < 0) {
  //       var data = { x: 0, y: 0, scroller: insideTarget };
  //       for (var i = 0; i < event.touches.length; i++) {
  //         if (event.touches[i].target.isSameNode(event.target)) {
  //           data.x = event.touches[i].clientX;
  //           data.y = event.touches[i].clientY;
  //         }
  //       }
  //       touchedTargets.push(event.target);
  //       touchedData.push(data);
  //     }
  //   }
  // });
  // document.body.addEventListener('touchend', function (event) {
  //   console.log('touchend')
  //   var index = touchedTargets.indexOf(event.target);
  //   if (index > -1) {
  //     touchedTargets.splice(index, 1);
  //     touchedData.splice(index, 1);
  //   }
  // });
  // document.body.addEventListener('touchmove', function (event) {
  //   console.log('touchmove')
  //   for (var i = 0; i < event.touches.length; i++) {
  //     var index = touchedTargets.indexOf(event.touches[i].target);
  //     if (index > -1) {
  //       touchedData[index].scroller.scrollTop = touchedData[index].scroller.scrollTop + (event.touches[i].clientY - touchedData[index].y);
  //       touchedData[index].y = event.touches[i].clientY;
  //       event.preventDefault();
  //     }
  //   }
  // }, { passive: false });

})

