<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Post;
use app\models\User;
use app\models\Category;

$this->title = 'Blog | ' .$page;

// Breadcrumb and alert msg
include Yii::$app->basePath . '/views/layouts/nav.php';

// User defined function
include Yii::$app->basePath. '/views/req/usrDefFunc.php';
?>

<div class="container mt-3">
    <div class="row">
        <!-- Main Content -->
        <div class="col-sm-12 col-md-8">
            <!-- Short page intro -->
            <div class="row">
                <div class="col-12">
                    <h1 class="cust-bottom-border-2">Post Details</h1>
                </div>
            </div>
            <!-- Post Content starts here -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-0">
                        <div class="card-header bg-dark">
                            <div class="d-flex justify-content-between">
                                <div class="mr-auto">
                                    <h4 class="text-white"><?= $model->title ?></h4>    
                                </div>
                                <div class="ml-auto">
                                    <a href="" class="btn btn-primary rounded-pill btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                </div>
                                <div class="ml-2">
                                    <form class="form-inline" action="<?= 'index.php?r=post/delete'?>">
                                        <input type="hidden" name="" value="">
                                        <button class="btn btn-danger rounded-pill btn-sm"><i class="fas fa-pencil-alt"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if($model->img_loc2 != null): ?>
                                <div class="d-flex justify-content-center">
                                    <img class="img-thumbnail text-center img-fluid shadow" src="<?= Yii::getAlias('@web'). '/' .$model->img_loc2;?>" alt="<?= $model->title?>">                            
                                </div> 
                                <hr>
                            <?php endif; ?>
                            <?= $model->body ?>
                        </div>
                        <div class="card-footer bg-secondary text-white">
                            <div class="d-flex justify-content-between">
                                <div class="mr-auto"><small><?= User::findOne(['id'=>$model->user_id])->full_name ?></small></div>
                                <div class="bg-white text-dark px-2 rounded-pill shadow"><?= Category::findOne(['id'=>$model->category_id])->name ?></div>
                                <div class="ml-auto"><small><?= custTimeFormat($model->created_at); ?></small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Suggest content -->
        <div class="col-sm-12 col-md-4">
        
        </div>
    </div>
</div>
