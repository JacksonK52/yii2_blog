<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Blog | ' .$page;

// Breadcrumb and alert msg
include Yii::$app->basePath . '/views/layouts/nav.php';
?>

<!-- Carousel -->
<?php if(empty($post_model)): ?>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <h1>No record found!</h1>
    </div>
<?php else : ?>
    <?php $count = 0; ?>
    <div id="carouselExampleCaptions" class="carousel slide cust-mt" data-ride="carousel">
        <div class="carousel-inner">
            <?php while ($count <= 3): ?>
                <div class="carousel-item active">
                    <img src="<?= Yii::getAlias('@web'). '/img/carousel-bg.jpg' ?>" class="d-block w-100" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </div>
                </div>
                <?php $count++; endwhile; ?>
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
