<?php

namespace app\controllers;

use app\models\Post;
use yii\web\UploadedFile;
use Yii;

class PostController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $items = new Post();

        $context = [
            'site' => 'Post',
            'page' => 'Post',
            'count' => $items->find()->count(),
            // 'fthree' => $model->find()->orderBy('id DESC')->limit(3)->all(),
            // 'items' => $items->find()->where(['user_id'=>Yii::$app->user->identity->id])->orderBy('id DESC'),
        ];

        return $this->render('index', $context);
    }

    public function actionCreate() {
        $model = new Post();

        // Default data
        $model->slug = 'post';
        $model->user_id = Yii::$app->user->identity->id;

        // After post
        if($model->load(Yii::$app->request->post())) {
            if($model->validate()) {
                // Creating and testing slug
                $slug = $model->title;
                $slug = $this->slugCreator($slug);
                if($this->slugValidate($slug) == false) {
                    $slug = $this->slugCreator($slug);
                } else {
                    $model->slug = $slug;
                }
                
                /**
                 * Upload blog images-large
                 * --------------------------------
                 * if user upload an image then connect the uploaded file to img_loc1
                 * get Image extension
                 * Check weather the uploaded img is a jpg file or not
                 * Replace all the whitespace with _ from name, Add randome numbers and add file extension
                 * Create user folder if it doesn't exist, and create image path.
                 * Save image to defined location
                 * Save image path to database
                 */
                
                if($model->img_loc1 = UploadedFile::getInstance($model, 'img_loc1')) {
                    $ext = $model->img_loc1->extension;
                    if($ext == 'jpg') {
                        $img_name = str_replace(' ', '_', $model->title) . rand(0, 4000) . '.' .$ext;
                        // uploads/2/post/post_title/img.jpg
                        $this->createFolder($slug);
                        $id = Yii::$app->user->identity->id;
                        $img_path = 'uploads/' .$id. '/post/' .$slug. '/'.$img_name;
                        $model->img_loc1->saveAs($img_path);
                        $this->ResizeImage($img_path, 1920, 680);
                        $model->img_loc1 = $img_path;
                        
                        /**
                        * Upload blog images-small
                        * --------------------------------
                        * Link image to img_loc2
                        * Create img name
                        * Create img path
                        * Resized the img
                        * Save image
                        * save img path to db
                        */
                        $model->img_loc2 = UploadedFile::getInstance($model, 'img_loc1');
                        $img_name1 = str_replace(' ', '_', $model->title) . rand(0, 4000) . '.' .$ext;
                        // uploads/2/post/post_title/img2.jpg
                        $img_path1 = 'uploads/' .$id. '/post/' .$slug. '/' .$img_name1;
                        copy($img_path, $img_path1);
                        $this->ResizeImage($img_path1, 480, 320);
                        $model->img_loc2->saveAs($img_path1);                        
                        $model->img_loc2 = $img_path1;
                    } else {
                        Yii::$app->session->setFlash('error', 'Please upload jpg image only!');
                        $context = [
                            'site' => 'Post',
                            'page' => 'Create Post',
                            'model' => $model,
                        ];
                        return $this->render('create', $context);
                    }
                } else {
                    $model->img_loc1 = null;
                    $model->img_loc2 = null;
                }
                
                $model->save();
                Yii::$app->session->setFlash('success', 'New post created successfully!');
                return $this->redirect('index.php?r=post/index');
            } 
        }

        $context = [
            'site' => 'Post',
            'page' => 'Create Post',
            'model' => $model,
        ];
        return $this->render('create', $context);
    }

    public function actionDetails($slug=null) {
        $model = Post::findOne(['slug'=>$slug]);

        $context = [
            'site' => 'Post',
            'page' => 'Post Details',
            'slug' => $slug,
            'model' => $model,
        ];

        return $this->render('details', $context);
    }

    public function ResizeImage($file, $w, $h, $crop = FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if($crop) {
            if($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }

        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagejpeg($dst, $file);
        return $dst;
    }

    public function createFolder($slug) {
        // uploads/2/post/post_title/img.jpg
        $path = 'uploads/' .Yii::$app->user->identity->id. '/post';
        if(!is_dir($path)) {
            mkdir($path, 0777);
            mkdir($path. '/' .$slug, 0777);
            return true;
        } else {
            mkdir($path. '/' .$slug, 0777);
            return true;
        }

        return false;
    }

    public function slugCreator($slug) {
        $slug = str_replace(array(' ', '-', '/', '(',')'), '_', $slug);
        $slug = $slug.Yii::$app->security->generateRandomString(3);
        return $slug;
    }

    public function slugValidate($slug) {
        $modelslug = Post::findAll(['slug' => $slug]);
        if (empty($modelslug)) {
            return true;
        }

        return false;
    }

}
