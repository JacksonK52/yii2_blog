<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Post;
use app\models\User;

$this->title = 'Blog | ' .$page;

// Breadcrumb and alert msg
include Yii::$app->basePath . '/views/layouts/nav.php';

// User defined function
include Yii::$app->basePath. '/views/req/usrDefFunc.php';
?>
<!-- Carousel -->
<?php if($count==0): ?>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <h1>No record found!</h1>
    </div>
<?php else : ?>
    /**
     * If their is even a single record
     * Display the carousel
     */
    <?php $i=0; ?>
    <div id="carouselExampleCaptions" class="carousel slide cust-mt" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach (Post::find()->where(['user_id'=>Yii::$app->user->identity->id])->orderBy('id DESC')->each(3) as $item): ?>
                <div class="carousel-item <?php if($i==0) echo 'active';?>">
                    <!-- TODO - Change below php code to $item->img_loc1 -->
                    <img src="<?= Yii::getAlias('@web'). ($item->img_loc1 == null ? '/uploads/img/carousel-bg.jpg' : '/' .$item->img_loc1) ?>" height="680px" class="d-block w-100" alt="<?= $item->title ?>">
                    <div class="carousel-caption cust-carousel-pose">
                        <div class="card bg-dark cust-opacity-card">
                            <div class="card-title">
                                <h4 class="m-2"><?= $item->title; ?></h5>
                                <hr class="bg-white">    
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote text-justify">
                                    <!-- Limiting body text to 25 words -->
                                    <?= limit_text($item->body, 25); ?>
                                    <a href="<?= 'index.php?r=post/details&slug=' .$item->slug?>" class="btn btn-primary rounded-pill btn-sm">Read more</a>
                                    <footer class="blockquote-footer text-right text-white">Written by <cite title="Source Title"><?= User::findOne(['id'=>$item->user_id])->full_name ?></cite></footer>
                                </blockquote>    
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    <small><?= custTimeFormat($item->created_at); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            <?php endforeach; ?>
            <?php if($count > 1): ?>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Lower section -->
<div class="container">
    <div class="row">
		<div class="col-sm-12 col-md-12">
				
		</div>
    </div>
</div>