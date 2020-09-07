<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;

$bodyClass = isset($this->params['showSidebar'])
        ? $this->params['showSidebar']
            ? "app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show"
            : "app header-fixed sidebar-fixed aside-menu-fixed"
        : "app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show";

\daxslab\coreui\CoreUiAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <link rel="shortcut icon" href="/favicon.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | <?= Yii::$app->name ?></title>
    <?php $this->head() ?>

    <!-- JS custom internationalization -->
    <script>
        i18n = {
            'Search': '<?=Yii::t('app', 'Search')?>',
            'Choose': '<?=Yii::t('app', 'Choose')?>',
        };
    </script>
</head>
<body class="c-app">

<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
