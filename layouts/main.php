<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->params['top-menu'] = isset($this->params['top-menu']) ? $this->params['top-menu'] : [];
$this->params['left-menu'] = isset($this->params['left-menu']) ? $this->params['left-menu'] : [];
$this->params['user-menu'] = isset($this->params['user-menu']) ? $this->params['user-menu'] : [];

$homeUrl = isset(Yii::$app->params['index-url']) ? Yii::$app->params['index-url'] : Yii::$app->homeUrl;
$logoUrl = isset(Yii::$app->params['logo-url']) ? Yii::$app->params['logo-url'] : Yii::getAlias('@web/images/logo.png');
$iconUrl = isset(Yii::$app->params['icon-url']) ? Yii::$app->params['icon-url'] : Yii::getAlias('@web/images/icon.png');

$controller = $this->context->id;
$action = $this->context->action->id;

$helpFile = FileHelper::localize(Yii::getAlias("@app/help/{$controller}-{$action}.md"));

if (isset($this->params['breadcrumbs']) && file_exists($helpFile)) {

    $helpButton = Html::a(Yii::t('app', '{icon} Help', [
        'icon' => Html::tag('i', null, ['class' => 'icon-question']),
    ]), '#modal-help', [
        'class' => 'btn',
        'data-toggle' => 'modal',
    ]);

    $rightOptionsContainer = Html::tag('div', $helpButton, [
        'class' => 'btn-group',
        'role' => 'group',
        'aria-label' => 'Button group',
    ]);

    $this->params['breadcrumbs'][] = Html::tag('li', $rightOptionsContainer, [
        'class' => 'breadcrumb-menu d-md-down-none'
    ]);
}

?>

<?php $this->beginContent('@daxslab/coreui/layouts/empty.php') ?>

<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?= $homeUrl ?>">
        <img class="navbar-brand-full" src="<?= $logoUrl ?>" alt="<?= Yii::$app->name ?>">
        <img class="navbar-brand-minimized" src="<?= $iconUrl ?>" alt="<?= Yii::$app->name ?>">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <?= \yii\bootstrap4\Nav::widget([
        'id' => 'top-menu',
        'encodeLabels' => false,
        'options' => ['class' => 'nav navbar-nav ml-auto'],
        'items' => array_merge($this->params['top-menu'], $this->params['user-menu']),
    ]) ?>

</header>
<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <?= \yii\widgets\Menu::widget(['items' => $this->params['left-menu'],
                    'encodeLabels' => false,
                    'options' => ['class' => 'nav'],
                    'linkTemplate' => '<a class="nav-link" href="{url}">{label}</a>',
                    'itemOptions' => ['class' => 'nav-item']]) ?>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
    <main class="main">

        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
            'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
            'encodeLabels' => false,]) ?>

        <div class="container-fluid">
            <div class="animated fadeIn">
                <?= $content ?>
            </div>
        </div>
    </main>
</div>
<footer class="app-footer">
    <div>
        <a href="<?= Yii::$app->request->hostInfo ?>"><?= Yii::$app->name ?></a>
        <span>&copy; 2018 <?= Yii::t('app', 'All rights reserved') ?>.</span>
    </div>
    <div class="ml-auto">
        <?= Yii::t('app', 'By {vendor} with {icon}', ['icon' => Html::tag('i', null, ['class' => 'fa fa-heart text-danger']),
            'vendor' => Html::a('daxslab', 'http://daxslab.com', ['target' => '_blank'])]) ?>
    </div>
</footer>

<?php $this->endContent() ?>

<?php if (file_exists($helpFile)): ?>

    <?php \yii\bootstrap4\Modal::begin(['id' => 'modal-help',
        'title' => Yii::t('app', 'Help on {title}', ['title' => $this->title]),
        'size' => \yii\bootstrap4\Modal::SIZE_LARGE,]) ?>

    <?= \yii\helpers\Markdown::process($this->renderFile($helpFile)) ?>

    <?php \yii\bootstrap4\Modal::end() ?>

<?php endif; ?>
