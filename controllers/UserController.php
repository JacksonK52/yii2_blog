<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\web\Controller;
use app\models\User;

class UserController extends Controller
{
    /**
     *
     * @if User already login
     * Redirect to homepage
     *
     * @if user didn't login
     * Link user model and pass model to register view
     *
     * @if username already exist return to registration with info msg
     * @if email already exist return to registration with info msg
     *
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('index.php?r=site');
        }

        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                // Check if user already exist or not
                $temp_username = User::findOne(['username' => $model->username]);
                if(!empty($temp_username)) {
                    Yii::$app->getSession()->setFlash('info', 'Username already exists. Please enter a different username');
                    return $this->redirect('index.php?r=user/register');
                }

                // Checking if email already exists
                $temp_email = User::findOne(['email' => $model->email]);
                if (!empty($temp_email))
                {
                    Yii::$app->getSession()->setFlash('info', 'Email already exists. Please enter a different email');
                    return $this->redirect('index.php?r=user/register');
                }

                $model->save();
                Yii::$app->session->setFlash('success', 'Account created successfully!');

                // Updating token_id
                $token = Yii::$app->security->generateRandomString();
                User::updateAll(['token_id' => $token], 'id  = ' .$model->id);

                // Email information
                $sent_to = 'info@mailtrap.io';
                $email_subject = 'no-reply: Email verification link';
                $email_body = '
                    Hey '.$model->full_name.'!
                    <br><br>
                    You have register an account on <a href="http:://localhost/basic/web/">blog.loc</a>. 
                    To verify you email address please click on the link given below. In case you didn\'t 
                    register any account at blog.loc then please avoid this email. We do not accept account 
                    registration without email verification so avoiding this email verification will be similar to not registering.
                    
                    Please click the below link to verify your account.
                    <br><br>
                    <a href="http://localhost/basic/web/index.php?r=user/verifyemail&token='.$model->token_id.'&auth='.$model->auth_key.'">http:://localhost.loc/varifylink</a>
                    <br><br>
                    Regards,
                    <br>
                    Team';

                if($this->sendEmail($sent_to, $email_subject, $email_body) === false) {
                    Yii::$app->session->setFlash('error', 'Unable to sent email at the moment. Please try again later');
                    return $this->redirect('index.php?r=site/login');
                }
                // If email send successfully
                Yii::$app->session->setFlash('info', 'Email verification link sent');

                //Create User folder
                if(!$this->createFolder($model->id)) {
                    Yii::$app->session->setFlash('error', 'Unable to create user director at the moment. Please contact admin!');
                }

                return $this->redirect('index.php?r=site/login');
            }
        }


        return $this->render('register', [
            'model' => $model,
            'site' => 'Home',
            'page' => 'Sign up',
        ]);
    }

    public function createFolder($id) {
        $path = 'uploads/' .$id;
        if(is_dir(!$path)) {
            mkdir($path, 0777);
            return true;
        } 

        return false;
    }

    public function actionVerifyemail($token, $auth) {
        $model = User::findOne(['auth_key' => $auth]);

        // Validate token_id
        if($token != $model->token_id) {
            Yii::$app->session->setFlash('error', 'The verification link expired or invalid, <a href="index.php?r=user/resendverification&id='.$user->id.'">Click here</a> to re-send verification link');
        } else {

            // If token_id validate then change active state and token_id
            $token = Yii::$app->security->generateRandomString();
            User::updateAll(['active' => true, 'token_id' => $token], 'id = '.$model->id);

            Yii::$app->session->setFlash('success', 'Email verify successfully!');
        }

        return $this->redirect('index.php?r=site/login');
    }

    public function actionResendverification($uname) {
        $model = User::findOne(['username' => $uname]);

        // Email information
        $sent_to = 'info@mailtrap.io';
        $email_subject = 'no-reply: Re-sending email verification link';
        $email_body = '
                    Hey '.$model->full_name.'!
                    <br><br>
                    We are resending your email verification link as per your request.
                    
                    Please click the below link to verify your account.
                    <br><br>
                    <a href="http://localhost/basic/web/index.php?r=user/verifyemail&token='.$model->token_id.'&auth='.$model->auth_key.'">http:://localhost.loc/varifylink</a>
                    <br><br>
                    Regards,
                    <br>
                    Team';

        if($this->sendEmail($sent_to, $email_subject, $email_body) === true) {
            Yii::$app->session->setFlash('success', 'Email verification link send!');
        } else {
            Yii::$app->session->setFlash('error', 'Unable to send email at the moment, Please try again later!');
        }

        return $this->redirect('index.php?r=site/login');
    }

    public function sendEmail($sent_to, $email_subject, $email_body) {
        try {
            Yii::$app->mailer->compose()
                ->setTo($sent_to)
                ->setFrom('recipient1@mailtrap.io')
                ->setSubject($email_subject)
                ->setHtmlBody($email_body)
                ->send();
            return true;
        } catch(Exception $e) {
            return false;
        }
    }

}
