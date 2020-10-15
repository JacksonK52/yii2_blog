<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Blog | ' .$page;

// Breadcrumb and alert msg
include Yii::$app->basePath . '/views/layouts/nav.php';
?>
<!-- Carousel -->
<?php if($count==0): ?>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <h1>No record found!</h1>
    </div>
<?php else : ?>
    <div id="carouselExampleCaptions" class="carousel slide cust-mt" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach($fthree as $item): ?>
                <div class="carousel-item <?php if($item->id==$count) echo 'active';?>">
                    <!-- TODO - Change below php code to $item->img_loc1 -->
                    <img src="<?= Yii::getAlias('@web'). '/img/carousel-bg.jpg' ?>" class="d-block w-100" alt="<?= $item->title ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= $item->title; ?></h5>
                        <p><?= $item->body; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php endif; ?>

<!-- Lower section -->
<div class="container">
    <div class="row">
		<div class="col-sm-12 col-md-12">
			 
				
		</div>
    </div>
</div>