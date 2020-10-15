<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use app\models\Category;

$this->title = 'Blog | ' . $page;

// Breadcrumb and alert msg
include Yii::$app->basePath . '/views/layouts/nav.php';
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h1 class="cust-bottom-border-2">Create New Post</h1>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <?php $form = ActiveForm::begin([
                'id' => 'createPost-form',
                'layout' => 'default',
                'options' => [
                    'enctype' => 'multipart/form-data'
                ],
            ]) ?>
            <?= $form->field($model, 'title')->textInput(['placeholder' => 'Post Title']) ?>
            <?= $form->field($model, 'body')->widget(CKEditor::className(), ['options' => ['rows' => 30], 'preset' => 'basic'])->label('Post Content') ?>
            <?= $form->field($model, 'img_loc1')->fileInput(['class' => 'form-control-file'])->label('Upload picture: ') ?>
            <?= $form->field($model, 'category_id')->dropDownList(
                Category::find()
                    ->select(['name'])
                    ->indexBy('id')
                    ->column(),
                ['prompt' => 'Select Category']
            ); ?>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'createPost-button']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>