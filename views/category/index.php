<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\db\ActiveRecord;
use yii\helpers\Url;

$this->title = 'Blog | ' .$page;

// Breadcrumb and alert msg
include Yii::$app->basePath . '/views/layouts/nav.php';
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h1 class="cust-bottom-border-2">Categories</h1>
        </div>
    </div>
    <div class="row">
        <?php if($count == 0) { ?>
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh">
                    <h1>No record found!</h1>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-sm-12 col-md-6">
                <div class="table-responsive-sm mt-3">
                    <table class="table table-striped bg-white table-bordered shadow" style="width: 500px">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <?php foreach ($models as $model): ?>
                            <tr>
                                <td><?= $model->id ?></td>
                                <td><?= $model->name ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex align-self-center">
                <div class="d-flex-none">
                    <h4>Information</h4>
                    <p>Categories are pre-defined by the admin. Users can't create new category, edit category or delete the existing category.</p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
