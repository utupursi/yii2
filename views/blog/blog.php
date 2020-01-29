<?php
?>

<style>
  .news {
    overflow: hidden;
    margin-bottom:10px;
  }

  .newsad {
    margin-bottom: 9px;
  }

  .newstitle, .heading {
    background: #3f3e3e;
    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzNmM2UzZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMyYzJjMmMiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
    background: -moz-linear-gradient(top, #3f3e3e 0%, #2c2c2c 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3f3e3e), color-stop(100%, #2c2c2c));
    background: -webkit-linear-gradient(top, #3f3e3e 0%, #2c2c2c 100%);
    background: -o-linear-gradient(top, #3f3e3e 0%, #2c2c2c 100%);
    background: -ms-linear-gradient(top, #3f3e3e 0%, #2c2c2c 100%);
    background: linear-gradient(to bottom, #3f3e3e 0%, #2c2c2c 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3f3e3e', endColorstr='#2c2c2c', GradientType=0);
    background: #16326c;
    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzE2MzI2YyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwYzI2NWQiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
    background: -moz-linear-gradient(top, #16326c 0%, #0c265d 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #16326c), color-stop(100%, #0c265d));
    background: -webkit-linear-gradient(top, #16326c 0%, #0c265d 100%);
    background: -o-linear-gradient(top, #16326c 0%, #0c265d 100%);
    background: -ms-linear-gradient(top, #16326c 0%, #0c265d 100%);
    background: linear-gradient(to bottom, #16326c 0%, #0c265d 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#16326c', endColorstr='#0c265d', GradientType=0);
    border-radius: 3px 3px 0 0;
    width: 690px;
    height: 48px;
    display: table;
  }

  .heading h2, .newstitle h1 {
    font: 14px newsfont;
    color: #fff;
    text-shadow: 0 1px 0 rgba(0, 0, 0, .15);
    width: 670px;
    padding: 0 5px;
    white-space: normal;
    vertical-align: middle;
    display: table-cell;
    margin: 0;
    line-height: 1.3;
  }

  .newstitle h1 a {
    color: #fff;
    text-decoration: none;
  }

  .newscont, .brdform, .basecont {
    width: 688px;
    border: 1px solid #dfdede;
    border-top: 0;
    overflow: hidden;
    margin-bottom: 14px;
    border-radius: 0 0 3px 3px;
  }

  .brdform, .basecont {
    padding: 5px;
    width: 678px;
  }

  .newsimage {
    margin: 5px 0;
    overflow: hidden;
  }

  .newsimage img {
    border-radius: 3px;
    max-width: 470px;
  }

  .newstext {
    font: 14px newsfont;
    color: #000;
    line-height: 20px;
    margin: 0 5px 5px 5px;
    text-align: justify;
  }

  ul.newsinfo {
    border-top: 1px solid #dfdede;
    list-style: none;
  }

  ul.newsinfo li {
    padding: 0 5px 0 5px;
    margin-left: 5px;
    height: 34px;
    border-right: 1px solid #dfdede;
    float: left;
    font: 12px newsfont;
    color: #323232;
    line-height: 34px;
  }

  ul.newsinfo li:last-child {
    border-right: 0;
  }

  ul.newsinfo .author {
    background: url(../images/author.png) no-repeat left center;
    padding-left: 14px;
  }

  ul.newsinfo .time {
    background: url(../images/time.png) no-repeat left center;
    padding-left: 17px;
  }

  ul.newsinfo .views {
    background: url(../images/views.png) no-repeat left center;
    padding-left: 17px;
  }

  ul.newsinfo .comms {
    background: url(../images/comments.png) no-repeat left center;
    padding-left: 17px;
  }

  ul.newsinfo li a {
    font: 12px newsfont;
    color: #323232;
    height: 34px;
    text-decoration: none;
    line-height: 34px;
  }

  ul.newsinfo li a:hover {
    text-decoration: underline;
  }
  #image{
    height:280px;
  }
</style>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500|Rubik:500" rel="stylesheet">
  <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"-->
  <!--        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php use yii\helpers\Html;

    $this->registerCssFile("@web/css/linearicons.css", [
        'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    ]);

    $this->registerCssFile("@web/css/font-awesome.min.css", [
        'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    ]);
    $this->registerCssFile("@web/css/magnific-popup.css", [
        'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    ]);
    $this->registerCssFile("@web/css/nice-select.css", [
        'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    ]);
    $this->registerCssFile("@web/css/animate.min.css", [
        'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    ]);
    $this->registerCssFile("@web/css/owl.carousel.css", [
        'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    ]);
    $this->registerCssFile("@web/css/main.css", [
        'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    ]);


    ?>
</head>

<body>
<!--================ Start header Top Area =================-->
<section class="header-top">
  <div class="container box_1170">
    <div class="row align-items-center justify-content-between">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <a href="index.html" class="logo">
          <img src="img/logo.png" alt="">
        </a>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 search-trigger">
        <a href="#" class="search">
          <i class="lnr lnr-magnifier" id="search"></i></a>
        </a>
      </div>
    </div>
  </div>
</section>
<!--================ End header top Area =================-->

<!-- Top Stories Area -->
<section class="top-stories-area">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="owl-carousel active-stories-carousel">
          <!-- single stories carousel -->
          <div class="single-stories-carousel d-flex align-items-center">
            <div class="stories-thumb">
              <img class="img-fluid"
                   src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                   alt="">
            </div>
            <div class="stories-details">
              <h6><a href="">2nd Gen Smoke Alarm <br>
                  get up from sleep</a></h6>
              <p>September 14, 2018</p>
            </div>
          </div>
          <!-- single stories carousel -->
          <div class="single-stories-carousel d-flex align-items-center">
            <div class="stories-thumb">
              <img class="img-fluid"
                   src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                   alt="">
            </div>
            <div class="stories-details">
              <h6><a href="">2nd Gen Smoke Alarm <br>
                  get up from sleep</a></h6>
              <p>September 14, 2018</p>
            </div>
          </div>
          <!-- single stories carousel -->
          <div class="single-stories-carousel d-flex align-items-center">
            <div class="stories-thumb">
              <img class="img-fluid"
                   src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500 alt="">
            </div>
            <div class="stories-details">
              <h6><a href="">2nd Gen Smoke Alarm <br>
                  get up from sleep</a></h6>
              <p>September 14, 2018</p>
            </div>
          </div>
          <!-- single stories carousel -->
          <div class="single-stories-carousel d-flex align-items-center">
            <div class="stories-thumb">
              <img class="img-fluid"
                   src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500 alt="">
            </div>
            <div class="stories-details">
              <h6><a href="">2nd Gen Smoke Alarm <br>
                  get up from sleep</a></h6>
              <p>September 14, 2018</p>
            </div>
          </div>
          <!-- single stories carousel -->
          <div class="single-stories-carousel d-flex align-items-center">
            <div class="stories-thumb">
              <img class="img-fluid"
                   src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                   alt="">
            </div>
            <div class="stories-details">
              <h6><a href="">2nd Gen Smoke Alarm <br>
                  get up from sleep</a></h6>
              <p>September 14, 2018</p>
            </div>
          </div>
          <!-- single stories carousel -->
          <div class="single-stories-carousel d-flex align-items-center">
            <div class="stories-thumb">
              <img class="img-fluid"
                   src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                   alt="">
            </div>
            <div class="stories-details">
              <h6><a href="">2nd Gen Smoke Alarm <br>
                  get up from sleep</a></h6>
              <p>September 14, 2018</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Stories Area -->

<!-- Start Post Silder Area -->
<section class="post-slider-area">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="owl-carousel active-post-carusel">
          <!-- single carousel item -->
          <div class="single-post-carousel">
            <div class="post-thumb">
              <img class="img-fluid"
                   src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                   alt="">
            </div>
            <div class="post-details">
              <h2><a href="#">2nd Gen Smoke Alarm get up <br>
                  from sleep Daily</a></h2>
              <div class="post-content d-flex justify-content-between">
                <div class="post-meta">
                  <div class="thumb"><img src="img/auth" alt=""></div>
                  <div class="c-desc">
                    <h6>Marvel Maison</h6>
                    <p><span class="lnr lnr-calendar-full"></span>13th Oct, 2018</p>
                  </div>
                </div>
                <div class="details">
                  <p>There is a moment in the life of any aspiring astronomer that it is time to buy that first
                    telescope.
                    It’s exciting to think about setting up your own viewing station.</p>
                </div>
              </div>
            </div>
          </div>
          <!-- single carousel item -->
          <div class="single-post-carousel">
            <div class="post-thumb">
              <img class="img-fluid"
                   src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                   alt="">
            </div>
            <div class="post-details">
              <h2><a href="#">2nd Gen Smoke Alarm get up <br>
                  from sleep Daily</a></h2>
              <div class="post-content d-flex justify-content-between">
                <div class="post-meta">
                  <div class="thumb"><img src="img/author/a1.png" alt=""></div>
                  <div class="c-desc">
                    <h6>Marvel Maison</h6>
                    <p><span class="lnr lnr-calendar-full"></span>13th Oct, 2018</p>
                  </div>
                </div>
                <div class="details">
                  <p>There is a moment in the life of any aspiring astronomer that it is time to buy that first
                    telescope.
                    It’s exciting to think about setting up your own viewing station.</p>
                </div>
              </div>
            </div>
          </div>
          <!-- single carousel item -->
          <div class="single-post-carousel">
            <div class="post-thumb">
              <img class="img-fluid"
                   src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                   alt="">
            </div>
            <div class="post-details">
              <h2><a href="#">2nd Gen Smoke Alarm get up <br>
                  from sleep Daily</a></h2>
              <div class="post-content d-flex justify-content-between">
                <div class="post-meta">
                  <div class="thumb"><img src="img/author/a1.png" alt=""></div>
                  <div class="c-desc">
                    <h6>Marvel Maison</h6>
                    <p><span class="lnr lnr-calendar-full"></span>13th Oct, 2018</p>
                  </div>
                </div>
                <div class="details">
                  <p>There is a moment in the life of any aspiring astronomer that it is time to buy that first
                    telescope.
                    It’s exciting to think about setting up your own viewing station.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Start Post Silder Area -->

<!-- Start main body Area -->
<div class="main-body section-gap">
  <div class="container box_1170">
    <div class="row">
      <div class="col-lg-8 post-list">
        <!-- Start Post Area -->
        <section class="post-area">
          <div class="row" style="margin-top:20px;">
              <?php foreach ($blogs as $blog): ?>
                <div class="news" >
                  <div class="newstitle"><h1><a href="blog-details?id=<?php echo $blog->id ?>"><?php echo $blog->header ?></a>
                    </h1></div>
                  <div class="newscont">
                    <div class="newsimage" align="center">
                        <?php echo Html::img('@web/Files/' . $blog->image, ['id' => 'image']); ?>
                    </div>
                    <div class="newstext">
                      <div style="text-align:center;"><b><!--colorstart:#CC0000--><span
                            style="color:#CC0000">
              <!--colorend--></span><!--/colorend--></b></div>
                    </div>
                    <ul class="newsinfo">
                      <li class="time"><i class="fa fa-calendar-o" aria-hidden="true"> <?php echo yii::$app->formatter->asDatetime($blog->created_at) ?></i></li>
                      <li class="views"><i class="fa fa-eye" aria-hidden="true"> 694</i> </li>
                      <li class="comms"><a href="http://halamadrid.ge/index.php?newsid=64057#comment">27</a></li>
                      <li></li>
                    </ul>
                    <div class="full-link"><a href="http://halamadrid.ge/index.php?newsid=64057">სრულად ნახვა</a></div>
                    <div class="clr"></div>
                  </div>
                </div>
              <?php endforeach; ?>

            <div class="col-lg-12">
              <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">
                  <li class="page-item">
                    <a href="#" class="page-link" aria-label="Previous">
												<span aria-hidden="true">
													<span class="lnr lnr-arrow-left"></span>
												</span>
                    </a>
                  </li>
                  <li class="page-item"><a href="#" class="page-link">01</a></li>
                  <li class="page-item active"><a href="#" class="page-link">02</a></li>
                  <li class="page-item"><a href="#" class="page-link">03</a></li>
                  <li class="page-item"><a href="#" class="page-link">04</a></li>
                  <li class="page-item"><a href="#" class="page-link">09</a></li>
                  <li class="page-item">
                    <a href="#" class="page-link" aria-label="Next">
												<span aria-hidden="true">
													<span class="lnr lnr-arrow-right"></span>
												</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </section>
        <!-- Start Post Area -->
      </div>


      <div class="col-lg-4 sidebar">
        <div class="single-widget protfolio-widget">
          <img class="img-fluid" src="img/blog/user2.png" alt="">
          <a href="#">
            <h4>Peter Anderson</h4>
          </a>
          <p class="p-text">
            Boot camps have its supporters andit sdetractors. Some people do not understand why you should have to spend
            money on boot camp whenyou can get. Boot camps have itssuppor ters andits detractors.
          </p>
          <ul class="social-links">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a href="#"><i class="fa fa-behance"></i></a></li>
          </ul>
          <img src="img/sign.png" alt="">
        </div>

        <div class="single-widget popular-posts-widget">
          <div class="jq-tab-wrapper" id="horizontalTab">
            <div class="jq-tab-menu">
              <div class="jq-tab-title active" data-tab="1">Popular</div>
              <div class="jq-tab-title" data-tab="2">Latest</div>
            </div>
            <div class="jq-tab-content-wrapper">
              <div class="jq-tab-content active" data-tab="1">
                <div class="single-popular-post d-flex flex-row">
                  <div class="popular-thumb">
                    <img class="img-fluid" src="img/posts/carousel/stories1.jpg" alt="">
                  </div>
                  <div class="popular-details">
                    <h6><a href="">2nd Gen Smoke Alarm <br>
                        get up from sleep</a></h6>
                    <p>September 14, 2018</p>
                  </div>
                </div>
                <div class="single-popular-post d-flex flex-row">
                  <div class="popular-thumb">
                    <img class="img-fluid" src="img/posts/carousel/stories2.jpg" alt="">
                  </div>
                  <div class="popular-details">
                    <h6><a href="">2nd Gen Smoke Alarm <br>
                        get up from sleep</a></h6>
                    <p>September 14, 2018</p>
                  </div>
                </div>
                <div class="single-popular-post d-flex flex-row">
                  <div class="popular-thumb">
                    <img class="img-fluid" src="img/posts/carousel/stories3.jpg" alt="">
                  </div>
                  <div class="popular-details">
                    <h6><a href="">2nd Gen Smoke Alarm <br>
                        get up from sleep</a></h6>
                    <p>September 14, 2018</p>
                  </div>
                </div>
                <div class="single-popular-post d-flex flex-row">
                  <div class="popular-thumb">
                    <img class="img-fluid" src="img/posts/carousel/stories4.jpg" alt="">
                  </div>
                  <div class="popular-details">
                    <h6><a href="">2nd Gen Smoke Alarm <br>
                        get up from sleep</a></h6>
                    <p>September 14, 2018</p>
                  </div>
                </div>
              </div>

              <div class="jq-tab-content active" data-tab="2">

                <div class="single-popular-post d-flex flex-row">
                  <div class="popular-thumb">
                    <img class="img-fluid" src="img/posts/carousel/stories2.jpg" alt="">
                  </div>
                  <div class="popular-details">
                    <h6><a href="">2nd Gen Smoke Alarm <br>
                        get up from sleep</a></h6>
                    <p>September 14, 2018</p>
                  </div>
                </div>
                <div class="single-popular-post d-flex flex-row">
                  <div class="popular-thumb">
                    <img class="img-fluid" src="img/posts/carousel/stories3.jpg" alt="">
                  </div>
                  <div class="popular-details">
                    <h6><a href="">2nd Gen Smoke Alarm <br>
                        get up from sleep</a></h6>
                    <p>September 14, 2018</p>
                  </div>
                </div>
                <div class="single-popular-post d-flex flex-row">
                  <div class="popular-thumb">
                    <img class="img-fluid" src="img/posts/carousel/stories1.jpg" alt="">
                  </div>
                  <div class="popular-details">
                    <h6><a href="">2nd Gen Smoke Alarm <br>
                        get up from sleep</a></h6>
                    <p>September 14, 2018</p>
                  </div>
                </div>
                <div class="single-popular-post d-flex flex-row">
                  <div class="popular-thumb">
                    <img class="img-fluid" src="img/posts/carousel/stories4.jpg" alt="">
                  </div>
                  <div class="popular-details">
                    <h6><a href="">2nd Gen Smoke Alarm <br>
                        get up from sleep</a></h6>
                    <p>September 14, 2018</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="single-widget category-widget">
          <h4 class="title">Post Categories</h4>
          <ul>
            <li>
              <a href="#" class="justify-content-between align-items-center d-flex">
                <p><img src="img/bullet.png" alt="">International (56)</p>
              </a>
            </li>
            <li>
              <a href="#" class="justify-content-between align-items-center d-flex">
                <p><img src="img/bullet.png" alt="">Tours and Travels (45)</p>
              </a>
            </li>
            <li>
              <a href="#" class="justify-content-between align-items-center d-flex">
                <p><img src="img/bullet.png" alt="">Cooking Tips (23)</p>
              </a>
            </li>
            <li>
              <a href="#" class="justify-content-between align-items-center d-flex">
                <p><img src="img/bullet.png" alt="">Life Style and Fashion (72)</p>
              </a>
            </li>
            <li>
              <a href="#" class="justify-content-between align-items-center d-flex">
                <p><img src="img/bullet.png" alt="">Organic News (37)</p>
              </a>
            </li>
            <li>
              <a href="#" class="justify-content-between align-items-center d-flex">
                <p><img src="img/bullet.png" alt="">Games and Sports (19)</p>
              </a>
            </li>
          </ul>
        </div>

        <div class="single-widget tags-widget">
          <h4 class="title">Post Tags</h4>
          <ul>
            <li><a href="#">Lifestyle</a></li>
            <li><a href="#">Art</a></li>
            <li><a href="#">Adventure</a></li>
            <li><a href="#">Food</a></li>
            <li><a href="#">Techlology</a></li>
            <li><a href="#">Fashion</a></li>
            <li><a href="#">Architecture</a></li>
            <li><a href="#">Food</a></li>
            <li><a href="#">Technology</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- Start main body Area -->

<!-- start footer Area -->
<footer class="footer-area section-gap">
  <div class="container box_1170">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-footer-widget">
          <h6 class="footer_title">About Us</h6>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
            magna aliqua.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-footer-widget">
          <h6 class="footer_title">Newsletter</h6>
          <p>Stay updated with our latest trends</p>
          <div id="mc_embed_signup">
            <form target="_blank"
                  action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                  method="get" class="subscribe_form relative">
              <div class="input-group d-flex flex-row">
                <input name="EMAIL" placeholder="Email Address" onfocus="this.placeholder = ''"
                       onblur="this.placeholder = 'Email Address '"
                       required="" type="email">
                <button class="btn sub-btn"><span class="lnr lnr-arrow-right"></span></button>
              </div>
              <div class="mt-10 info"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="single-footer-widget instafeed">
          <h6 class="footer_title">Instagram Feed</h6>
          <ul class="list instafeed d-flex flex-wrap">
            <li><img src="img/i1.jpg" alt=""></li>
            <li><img src="img/i2.jpg" alt=""></li>
            <li><img src="img/i3.jpg" alt=""></li>
            <li><img src="img/i4.jpg" alt=""></li>
            <li><img src="img/i5.jpg" alt=""></li>
            <li><img src="img/i6.jpg" alt=""></li>
            <li><img src="img/i7.jpg" alt=""></li>
            <li><img src="img/i8.jpg" alt=""></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-2 col-md-6 col-sm-6">
        <div class="single-footer-widget f_social_wd">
          <h6 class="footer_title">Follow Us</h6>
          <p>Let us be social</p>
          <div class="f_social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-dribbble"></i></a>
            <a href="#"><i class="fa fa-behance"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="row footer-bottom d-flex justify-content-between align-items-center">
      <p class="col-lg-12 footer-text text-center">
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
        All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
          href="https://colorlib.com" target="_blank">Colorlib</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
    </div>
  </div>
</footer>

</body>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>-->
<!--<script src="js1/bootstrap.min.js"></script>-->
<!--<script src="js1/summernote.min.js"></script>-->
<!--<script src="js1/script.js"></script>-->
<!-- <script src="js/vendor/jquery-2.2.4.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<!--<script src="js/vendor/bootstrap.min.js"></script>-->
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<!--<script src="js/easing.min.js"></script>-->
<!--<script src="js/hoverIntent.js"></script>-->
<!--<script src="js/superfish.min.js"></script>-->
<!--<script src="js/jquery.ajaxchimp.min.js"></script>-->
<!--<script src="js/jquery.magnific-popup.min.js"></script>-->
<!--<script src="js/owl.carousel.min.js"></script>-->
<!--<script src="js/jquery.tabs.min.js"></script>-->
<!--<script src="js/jquery.nice-select.min.js"></script>-->
<!--<script src="js/waypoints.min.js"></script>-->
<!--<script src="js/mail-script.js"></script>-->
<!--<script src="js/main.js"></script>-->
<!--<script src="category.js"></script>-->

<?php $this->registerJsFile(
    '@web/js/vendor/bootstrap.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/vendor/jquery-2.2.4.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/easing.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/hoverIntent.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/superfish.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/jquery.ajaxchimp.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/jquery.magnific-popup.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/owl.carousel.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/jquery.tabs.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/jquery.nice-select.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/waypoints.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/mail-script.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/main.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
</html>
