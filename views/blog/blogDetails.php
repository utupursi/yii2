<style>
  #t {
    margin-top: 10px;
  }

  #p {

    width: 700px;
    height: 400px;


  }
  #image{
    width:500px;

  }
  #con{
    background-color: whitesmoke;
  }
</style>
<!-- Page Content -->
<div class="container">
  <div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-8" id="con">

      <!-- Title -->
      <h1 class="mt-4"><?php use yii\helpers\Html;

          echo $blog->header ?></h1>

      <!-- Author -->
      <p class="lead">
        by
        <a href="#"><?php echo $blog->createdBy->username ?></a>
      </p>

      <hr>

      <!-- Date/Time -->
      <p>Posted on <?php echo yii::$app->formatter->asDatetime($blog->created_at) ?></p>

      <hr
      <!-- Preview Image -->
          <?php echo Html::img('@web/Files/' . $blog->image, ['class' => 'img-fluid', 'id' => 'image']); ?>

      <hr>
      <!-- Post Content -->
        <?php echo $blog->text ?>
        <?php if (!empty($blog['link'])): ?>
          <iframe id="t" width="710" height="415"
                  src="https://www.youtube.com/embed/<?php echo $blog->link; ?>"></iframe>
        <?php endif; ?>


    </div>

    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">

      <!-- Search Widget -->


      <!-- Categories Widget -->
      <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="/international?category=international">international</a>
                </li>

                <li>
                  <a href="/ToursAndTravels?category=Tours And Travel">Tours and Travels</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="/cookingtips?category=Cooking Tips">Cooking tips</a>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Side Widget -->
      <div class="single-widget protfolio-widget">
        <img class="img-fluid" src="http://d4.cdn.adbetnet.com/uploads/media/5/6/2765/v2/Bonus_5000_3sporta_260x400.gif"
             alt="">
        <a href="#">
          <h4>Sponsored by: 1XBET</h4>
        </a>
        <p class="p-text">
          1XBET IS OUR FIRST SPONSOR
        </p>


      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; sergiasblogebi.ge 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
    <?php $this->registerJsFile(
        '@web/js/vendor/jquery/jquery.min.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );
    $this->registerJsFile(
        '@web/js/vendor/bootstrap/js/bootstrap.bundle.min.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );
    ?>
  </body>

  </html>


