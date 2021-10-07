<?php
session_start();

require './cms/config/config.php';
require_once('./cms/model/Screen.php');


$screen = new Screen();

$screens = array();
$slugs = [
  'screen-1',
  'screen-2',
  'screen-3',
  'screen-4',
  'screen-5',
  'screen-6',
  'screen-7',
];
foreach ($slugs as $slug) {
  $screen_item = $screen->get_screen_by_slug($slug);
  $media = $screen->get_screen_media($screen_item['id']);
  $medias = array();
  foreach ($media as $item) {
    array_push($medias, $item);
  }
  $screen_item['media'] = $medias;
  array_push($screens, $screen_item);
}
// echo json_encode($screens);

// die();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIDF Animation</title>
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/frontend_assets/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/frontend_assets/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/frontend_assets/img/favicon-16x16.png">
  <link rel="stylesheet" href="./assets/frontend_assets/css/fonts/style.css" />
  <!-- styles -->
  <link rel="stylesheet" href="./assets/frontend_assets/css/main.css" />
  <!-- Owl Carousel CSS-->
  <link rel="stylesheet" href="./assets/frontend_assets/owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="./assets/frontend_assets/owlcarousel/assets/owl.theme.default.min.css">
</head>

<body>
  <div class="main_box">
    <div class="fadeOut owl-carousel owl-theme slider_box slider_one">
      <?php
      foreach ($screens[0]['media'] as $media) :
      ?>
      <div class="item">
        <img src="<?php echo USER_ASSET.'/images/'.$media['name'] ?>" alt="" class="img_slid">
      </div>
      <?php
      endforeach;
      ?>
    </div>
    <div class="modal_box" id="modal1">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <video controls autoplay class="video">
            <source src="./assets/frontend_assets/'Toast' - One Minute Comedy Film _ Award Winning.mp4" type="video/mp4">
          </video>
          <!-- <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img"> -->
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor first</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor أولاً</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
    <div class="modal_box" id="modal2">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <video controls class="video">
            <source src="./assets/frontend_assets/'Toast' - One Minute Comedy Film _ Award Winning.mp4" type="video/mp4">
          </video>
          <!-- <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img"> -->
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor third</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor الثالث</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor fourth</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor الرابع</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
  </div>
  <div class="main_box">
    <div class="fadeOut owl-carousel owl-theme slider_box slider_two">
      <?php
      foreach ($screens[1]['media'] as $media) :
      ?>
      <div class="item">
        <img src="<?php echo USER_ASSET.'/images/'.$media['name'] ?>" alt="" class="img_slid">
      </div>
      <?php
      endforeach;
      ?>
    </div>
    <div class="modal_box" id="modal3">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor fifth</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor الخامس</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor sixth</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor السادس</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
  </div>
  <div class="main_box">
    <div class="fadeOut owl-carousel owl-theme slider_box slider_three">
      <?php
      foreach ($screens[2]['media'] as $media) :
      ?>
      <div class="item">
        <img src="<?php echo USER_ASSET.'/images/'.$media['name'] ?>" alt="" class="img_slid">
      </div>
      <?php
      endforeach;
      ?>
    </div>
    <div class="modal_box" id="modal4">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor seventh</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor السابع</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor eighth</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor ثامن</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
    <div class="modal_box" id="modal5">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor ninth</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor تاسع</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor tenth</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor العاشر</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
    <div class="modal_box" id="modal6">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor eleventh</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor الحاديه عشر</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor twelvth</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor الثاني عشر</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
  </div>
  <div class="main_box">
    <div class="fadeOut owl-carousel owl-theme slider_box slider_four">
      <?php
      foreach ($screens[3]['media'] as $media) :
      ?>
      <div class="item">
        <img src="<?php echo USER_ASSET.'/images/'.$media['name'] ?>" alt="" class="img_slid">
      </div>
      <?php
      endforeach;
      ?>
    </div>
    <div class="modal_box" id="modal7">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 13th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor الثالث عشر</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 14th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor الرابع عشر</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
    <div class="modal_box" id="modal8">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 15th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 15th</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 16th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 16th</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
    <div class="modal_box" id="modal9">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 17th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 17th</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 18th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 18th</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
  </div>
  <div class="main_box">
    <div class="fadeOut owl-carousel owl-theme slider_box slider_five">
      <?php
      foreach ($screens[4]['media'] as $media) :
      ?>
      <div class="item">
        <img src="<?php echo USER_ASSET.'/images/'.$media['name'] ?>" alt="" class="img_slid">
      </div>
      <?php
      endforeach;
      ?>
    </div>
    <div class="modal_box" id="modal10">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 19th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 19th</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 20th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 20th</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
    <div class="modal_box" id="modal11">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 21st</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 21st</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 22nd</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 22nd</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
  </div>
  <div class="main_box">
    <div class="fadeOut owl-carousel owl-theme slider_box slider_six">
      <?php
      foreach ($screens[5]['media'] as $media) :
      ?>
      <div class="item">
        <img src="<?php echo USER_ASSET.'/images/'.$media['name'] ?>" alt="" class="img_slid">
      </div>
      <?php
      endforeach;
      ?>
    </div>
    <div class="modal_box" id="modal12">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 23rd</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 23rd</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 24th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 24th</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
  </div>
  <div class="main_box">
    <div class="fadeOut owl-carousel owl-theme slider_box slider_seven">
      <?php
      foreach ($screens[6]['media'] as $media) :
      ?>
      <div class="item">
        <img src="<?php echo USER_ASSET.'/images/'.$media['name'] ?>" alt="" class="img_slid">
      </div>
      <?php
      endforeach;
      ?>
    </div>
    <div class="modal_box" id="modal13">
      <div class="owl-carousel owl-theme content_slider">
        <div class="item">
          <img src="./assets/frontend_assets/img/5.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 25th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 26th</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
        <div class="item">
          <img src="./assets/frontend_assets/img/6.jpg" alt="" class="new_inner_img">
          <div class="box_content_innerrr english active">
            <h3>Lorem ipsum dolor 26th</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipisc-
              ing elit, sed diam nonummy nibh euismod tinci-
              dunt ut laoreet dolore magna aliquam erat volut-
              pat. Ut wisi enim ad minim veniam, quis nostrud
              exerci tation ullamcorper suscipit lobortis nis</p>
          </div>
          <div class="box_content_innerrr arabic">
            <h3>Lorem ipsum dolor 27th</h3>
            <p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد</p>
          </div>
        </div>
      </div>
      <div class="lang-toggle">
        <span class="lang-eng active">English</span>&nbsp;/
        <span class="lang-ar">عربی</span>
      </div>
      <span class="close-modal"><img src="./assets/frontend_assets/img/close-cross.svg" alt=""></span>
    </div>
  </div>






  <section class="bottom_upper_section">
    <div class="box_pin box_pin_one">
      <div class="pulsating-circle" data-modal_id="modal1"></div>
      <span class="border_verti"></span>
      <h3>1974</h3>
      <p class="text arabic">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_two">
      <div class="pulsating-circle" data-modal_id="modal2"></div>
      <span class="border_verti"></span>
      <h3>1975</h3>
      <p class="text arabic">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_three">
      <div class="pulsating-circle" data-modal_id="modal3"></div>
      <span class="border_verti"></span>
      <h3>1976</h3>
      <p class="text arabic">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_four">
      <div class="pulsating-circle" data-modal_id="modal4"></div>
      <span class="border_verti"></span>
      <h3>1997</h3>
      <p class="text arabic">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_five">
      <div class="pulsating-circle" data-modal_id="modal5"></div>
      <span class="border_verti"></span>
      <h3>1999</h3>
      <p class="text arabic">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_six">
      <div class="pulsating-circle" data-modal_id="modal6"></div>
      <span class="border_verti"></span>
      <h3>2001</h3>
      <p class="text arabic">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_seven">
      <div class="pulsating-circle" data-modal_id="modal7"></div>
      <span class="border_verti"></span>
      <h3>2007</h3>
      <p class="text arabic">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_eight">
      <div class="pulsating-circle" data-modal_id="modal8"></div>
      <span class="border_verti"></span>
      <h3>2012</h3>
      <p class="text arabic">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_nine">
      <div class="pulsating-circle" data-modal_id="modal9"></div>
      <span class="border_verti"></span>
      <h3>2016</h3>
      <p class="text arabic text-center text-white new_txt">إطلاق</p>
      <img src="./assets/frontend_assets/img/Logo.svg" alt="" class="mx_auto">
    </div>
    <div class="box_pin box_pin_ten white_blob">
      <div class="pulsating-circle" data-modal_id="modal10"></div>
      <span class="border_verti"></span>
      <h3>2018</h3>
      <p class="text arabic text-white">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_eleven white_blob">
      <div class="pulsating-circle" data-modal_id="modal11"></div>
      <span class="border_verti"></span>
      <h3>2019</h3>
      <p class="text arabic text-white">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_twelve white_blob">
      <div class="pulsating-circle" data-modal_id="modal12"></div>
      <span class="border_verti"></span>
      <h3>2020</h3>
      <p class="text arabic text-white">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="box_pin box_pin_thirteen white_blob">
      <div class="pulsating-circle" data-modal_id="modal13"></div>
      <span class="border_verti"></span>
      <h3>2020-2030</h3>
      <p class="text arabic text-white">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</p>
      <p class="text english text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
  </section>
  <section class="bottom_section">
    <img src="./assets/frontend_assets/img/bg_new_img.png" alt="">
  </section>
  <!-- javascript -->
  <script src="./assets/frontend_assets/js/jquery.min.js"></script>
  <script src="./assets/frontend_assets/owlcarousel/owl.carousel.js"></script>
  <script src="./assets/frontend_assets/js/main.js"></script>
</body>

</html>