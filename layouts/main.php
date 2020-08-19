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

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <img class="c-sidebar-brand-full" src="<?= $logoUrl ?>" alt="<?= Yii::$app->name ?>">
        <img class="c-sidebar-brand-minimized" src="<?= $iconUrl ?>" alt="<?= Yii::$app->name ?>">
    </div>
    <ul class="nav">
        <?= \yii\widgets\Menu::widget(['items' => $this->params['left-menu'],
            'encodeLabels' => false,
            'options' => ['class' => 'c-sidebar-nav'],
            'linkTemplate' => '<a class="c-sidebar-nav-link" href="{url}">{label}</a>',
            'itemOptions' => ['class' => 'c-sidebar-nav-item']]) ?>
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-unfoldable"></button>
</div>

<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
        </button>
        <a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui-pro.svg#full"></use>
            </svg>
        </a>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
        </button>
        <ul class="c-header-nav mfs-auto">
            <li class="c-header-nav-item px-3 c-d-legacy-none">
                <button class="c-class-toggler c-header-nav-btn" type="button" id="header-tooltip" data-target="body"
                        data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom"
                        title="Toggle Light/Dark Mode">
                    <svg class="c-icon c-d-dark-none">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-moon"></use>
                    </svg>
                    <svg class="c-icon c-d-default-none">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-sun"></use>
                    </svg>
                </button>
            </li>
        </ul>
        <?= \yii\bootstrap4\Nav::widget([
            'id' => 'top-menu',
            'encodeLabels' => false,
            'options' => ['class' => 'c-header-nav'],
            'items' => array_merge($this->params['top-menu'], $this->params['user-menu']),
        ]) ?>

        <div class="c-subheader justify-content-between px-3">
            <?= Breadcrumbs::widget([
                'options' => ['class' => 'breadcrumb border-0 m-0 px-0 px-md-3'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                'encodeLabels' => false,
            ])
            ?>
        </div>
    </header>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div id="ui-view">
                    <?= $content ?>
                </div>
            </div>
        </main>
    </div>
    <footer class="c-footer">
        <div>
            <a href="<?= Yii::$app->request->hostInfo ?>"><?= Yii::$app->name ?></a>
            <span>&copy; 2018 <?= Yii::t('app', 'All rights reserved') ?>.</span>
        </div>
        <div class="mfs-auto">
            <?= Yii::t('app', 'By {vendor} with {icon}', ['icon' => Html::tag('i', null, ['class' => 'fa fa-heart text-danger']),
                'vendor' => Html::a('daxslab', 'http://daxslab.com', ['target' => '_blank'])]) ?>
        </div>
    </footer>
</div>

<?php $this->endContent() ?>

<?php if (file_exists($helpFile)): ?>

    <?php \yii\bootstrap4\Modal::begin(['id' => 'modal-help',
        'title' => Yii::t('app', 'Help on {title}', ['title' => $this->title]),
        'size' => \yii\bootstrap4\Modal::SIZE_LARGE,]) ?>

    <?= \yii\helpers\Markdown::process($this->renderFile($helpFile)) ?>

    <?php \yii\bootstrap4\Modal::end() ?>

<?php endif; ?>
