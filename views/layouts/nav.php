<?php
namespace app\controllers;

use Yii;
use yii\helpers\Url;
?>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
    <!-- Brand -->
    <a class="navbar-brand" href="<?= Url::to(['/site/index']); ?>">Blog</a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($page=='Home') echo 'active';  ?>">
                <a class="nav-link" href="<?= Url::to(['/site/index']) ?>">Home</a>
            </li>
            <?php if (!Yii::$app->user->isGuest) { ?>
                <li class="nav-item <?php if($page=='Categories') echo 'active'; ?>">
                    <a class="nav-link" href="<?= Url::to(['/category/index']) ?>">Categories</a>
                </li>
                <li class="nav-item <?php if($page=='Post') echo 'active'; ?>">
                    <a class="nav-link" href="<?= Url::to(['/post/index']) ?>">Post</a>
                </li>
                <li class="nav-item <?php if($page=='Create Post') echo 'active'; ?>">
                    <a class="nav-link" href="<?= Url::to(['/post/create']); ?>">Create Post</a>
                </li>
            <?php } ?>
            <li class="nav-item <?php if($page=='About') echo 'active'; ?>">
                <a class="nav-link" href="<?= Url::to(['/site/about']) ?>">About</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto mx-2">
            <form class="form-inline my-lg-0 mx-4 cust-bottom-border" style="margin-left: 5px">
                <div class="input-group-prepend">
                    <i class="fas fa-search" style="color: lightgray"></i>
                </div>
                <input class="form-control mr-sm-2 cust-input-outline" type="text" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn cust-btn-outline rounded-pill my-2 my-sm-0 btn-sm" type="submit"> Search</button>
                </div>
            </form>
            <?php if (Yii::$app->user->isGuest) { ?>
                <li class="nav-item <?php if($page=='Login') echo 'active'; ?>">
                    <a href="<?= Url::to(['/site/login']) ?>" class="nav-link">Login</a>
                </li>
                <li class="nav-item <?php if($page=='Sign up') echo 'active'; ?>">
                    <a href="<?= Url::to(['/user/register']) ?>" class="nav-link">Sign up</a>
                </li>
            <?php } else { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle" style="font-size: 20px;"></i>&nbsp; <?= Yii::$app->user->identity->username; ?>
                    </a>
                    <div class="dropdown-menu text-center" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#"><?= Yii::$app->user->identity->full_name; ?></a>
                        <a class="dropdown-item" href="#">Setting</a>
                    </div>
                </li>
                <li>
                    <form class="form-inline" action="<?= Url::to('index.php?r=site/logout') ?>" method="post">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                        <button type="submit" class="btn cust-btn-outline rounded-pill my-1 btn-sm">Logout</button>
                    </form>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>

<!-- Breadcrumb and Flash message -->
<div class="container" style="margin-top: 70px">
    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <?php if ($page != 'Home' && $page != 'Categories' && $page != 'Post') { ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index']) ?>"><?= $site ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $page ?></li>
                    </ol>
                </nav>
            <?php } ?>
        </div>
    </div>
    <!-- Flash message -->
    <div class="row" style="position: relative;">
        <div class="col-12">
            <!-- Position it -->
            <div style="position: absolute; top: 0; right: 0; z-index: 99">
                <!-- Success -->
                <?php foreach(Yii::$app->session->getAllFlashes() as $key => $message): ?>
                    <?php if (isset($key)): ?>
                        <!-- Then put toasts within -->
                        <!-- Repeat this part -->
                        <div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="border: none">
                            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false" style="min-width: 250px; border: none">
                                <div class="toast-header
                                <?php
                                    if($key=='success')
                                        echo 'bg-success';
                                    elseif($key=='error')
                                        echo 'bg-danger';
                                    elseif($key=='info')
                                        echo 'bg-info';
                                ?>">
                                    <strong class="mr-auto text-white">
                                        <?php
                                        if($key=='success')
                                            echo '<i class="far fa-check-square"></i>';
                                        elseif($key=='info')
                                            echo '<i class="fas fa-exclamation-triangle"></i>';
                                        elseif($key=='error')
                                            echo '<i class="fas fa-times"></i>';
                                        ?>
                                        <?= ucfirst($key) ?>
                                    </strong>
                                    <small class="text-white">Just now</small>
                                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="toast-body">
                                    <?= $message ?>
                                </div>
                            </div>
                        </div>
                        <!-- Upto here -->
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


