<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\ActiveForm;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerJsFile('@web/js/userpages.js');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => ['/user/index'],

            'options' => ['class' => 'navbar-expand-md navbar-dark fixed-top', 'style' => 'background-color:rgb(26, 46, 31);']
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'encodeLabels' => false,
            'items' => [
                ['label' => 'Главная', 'url' => ['/user/index']],
                ['label' => 'Туры', 'url' => ['/user/tours']],
                ['label' => 'Проживание', 'url' => ['/user/apartment']],
                ['label' => 'Профиль', 'url' => ['/user/profile']],
                '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>',
            ]
        ]);
        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0 bg-dark" style="background-image: url('../images/preload_blur.jpg'); min-height: 100vh;" role="main">
        <div class="container bg-light rounded-3 mt-1 mb-2" style="min-width:95%; min-height: 90%;">

            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer navbar-fixed-bottom" class="mt-auto py-3 bg-light">
        <div class="container">
            <div class="text-muted align-center w-50 m-auto">
                <h2 class="h1-responsive font-weight-bold text-center my-4">Свяжитесь с нами<img src="../images/smile.png" alt=""></h2>
                <!--Section description-->
                <p class="text-center w-responsive mx-auto mb-5">Возникли вопросы? Хотите указать на недочеты или похвалить? Свяжитесь с нами по этой форме, 
                    и мы ответим так скоро, как только сможем! 
                    </p>
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-9 mb-md-0 mb-5">
                        <form id="contact-form" name="contact-form"  method="POST">
                            <!--Grid row-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                    <label for="name" class="">Имя</label>
                                        <input type="text" id="name1" name="name" class="form-control greenf">
                                        
                                    </div>
                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                    <label for="email" class="">Email</label>
                                        <input type="text" id="email1" name="email" class="form-control greenf">
                                        
                                    </div>
                                </div>
                                <!--Grid column-->

                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                    <label for="subject" class="">Тема</label>
                                        <input type="text" id="subject1" name="subject" class="form-control greenf">
                                        
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-12">

                                    <div class="md-form">
                                    <label for="message">Сообщение</label>
                                        <textarea type="text" id="message1" name="message" rows="3" class="form-control md-textarea greenf"></textarea>
                                        
                                    </div>

                                </div>
                            </div>
                            <!--Grid row-->

                        </form>

                        <div class="text-center text-md-left mt-2">
                            <a class="btn btn-success greenf">Send</a>
                        </div>
                        <div class="status"></div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-3 text-center">
                        <ul class="list-unstyled mb-0">
                            <li><img src="../images/ukaz.png" alt="">
                                <p>San Francisco, CA 94126, USA</p>
                            </li>

                            <li><img src="../images/tel.png" alt="">
                                <p>+ 01 234 567 89</p>
                            </li>

                            <li><img src="../images/mail.png" alt="">
                                <p>contact@mdbootstrap.com</p>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>