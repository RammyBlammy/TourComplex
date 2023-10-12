<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use app\widgets\Pjax;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Dropdown;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerJsFile('@web/js/adminka.js');
$this->registerJsFile('@web/js/modalTour.js');
$this->registerCssFile('@web/css/site.css');
$this->title = 'Админка';
Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []);
?>
<?php $this->beginPage();
?>
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
            'brandUrl' => ['/admin/index'],

            'options' => ['class' => 'navbar-expand-md navbar-dark fixed-top', 'style'=>'background-color:rgb(26, 46, 31);']
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'encodeLabels' => false,
            'items' => [
                ['label' => 'Главная', 'url' => ['/admin/index']],
                ['label' => 'Туры', 'url' => ['/admin/tours']],
                ['label' => 'Питание', 'url' => ['/admin/food']],
                ['label' => 'Снаряжение', 'url' => ['/admin/equipment']],
                ['label' => 'Группы', 'url' => ['/admin/groups']],
                ['label' => 'Номера', 'url' => ['/admin/apartment']],

                !Yii::$app->user->isGuest
                    ? '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                    : ''
            ]
        ]);
        NavBar::end();
        ?>
    </header>
    <main id="main" class="flex-shrink-0 bg-dark h-auto" style="background-image: url('../images/preload.jpg'); min-height: 100vh;" role="main">
        <div class="container bg-light mb-4 w-100" style="--bs-bg-opacity: .20;">
            <div class="body-content row">

                <div class="flex-shrink-0 p-3 bg-white rounded-end col-md-auto ms-2" style="width: 280px; ">
                    <a href="/admin" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                        <svg class="bi me-2" width="30" height="24">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                        <span class="fs-5 fw-semibold">Меню</span>
                    </a>
                    <div class="list-unstyled ps-0">
                        <div class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                                Туры
                            </button>
                            <div class="collapse show" id="home-collapse">
                                <div class="btn-toggle-nav list-unstyled fw-normal pb-1 small nav-menu">
                                    <?= Html::a('Просмотр и редактирование', ['tours'], ['class' => 'link-dark rounded']); ?><br>
                                    <?= Html::a('Категории туров', ['categorytours'], ['class' => 'link-dark rounded']); ?><br>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="true">
                                Группы
                            </button>
                            <div class="collapse show" id="dashboard-collapse" style="">
                                <div class="btn-toggle-nav list-unstyled fw-normal pb-1 small nav-menu">

                                    <?= Html::a('Список групп', ['groups'], ['class' => 'link-dark rounded']); ?><br>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="true">
                                Питание
                            </button>
                            <div class="collapse show" id="dashboard-collapse" style="">
                                <div class="btn-toggle-nav list-unstyled fw-normal pb-1 small nav-menu">

                                    <?= Html::a('Меню', ['food'], ['class' => 'link-dark rounded']); ?><br>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="true">
                                Снаряжение
                            </button>
                            <div class="collapse show" id="orders-collapse">
                                <div class="btn-toggle-nav list-unstyled fw-normal pb-1 small nav-menu">
                                    <?= Html::a('Каталог', ['equipment'], ['class' => 'link-dark rounded']); ?><br>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="true">
                                Проживание
                            </button>
                            <div class="collapse show" id="orders-collapse">
                                <div class="btn-toggle-nav list-unstyled fw-normal pb-1 small nav-menu">
                                    <?= Html::a('Номера', ['apartment'], ['class' => 'link-dark rounded']); ?><br>
                                </div>
                            </div>
                        </div>
                        <div class="border-top my-3"></div>
                        <div class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                                Администраторы
                            </button>
                            <div class="collapse" id="account-collapse" style="">
                                <div class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <?= Html::a('Администраторы', ['control'], ['class' => 'link-dark rounded']); ?><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="content" class=" ms-3 col">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>

            </div>
    </main>

    <footer id="footer navbar-fixed-bottom" class=" py-3 " style="min-height: 7vh;">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; лерочкина разработка <?= date('Y') ?></div>
            </div>
        </div>
    </footer>
    <?php 
    $this->registerJsFile('@web/js/ajax_send.js');
    $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>