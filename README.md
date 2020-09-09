Yii2 CoreUI
===============

[![Latest Stable Version](https://poser.pugx.org/daxslab/yii2-coreui/v/stable.svg)](https://packagist.org/packages/daxslab/yii2-coreui)
[![Total Downloads](https://poser.pugx.org/daxslab/yii2-coreui/downloads)](https://packagist.org/packages/daxslab/yii2-coreui)
[![Latest Unstable Version](https://poser.pugx.org/daxslab/yii2-coreui/v/unstable.svg)](https://packagist.org/packages/daxslab/yii2-coreui)
[![License](https://poser.pugx.org/daxslab/yii2-coreui/license.svg)](https://packagist.org/packages/daxslab/yii2-coreui)

Yii2 extension includind the base layout for CoreUI admin dashboard

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist daxslab/yii2-coreui "*"
```

or add

```
"daxslab/yii2-coreui": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Make your module or controller layout to be `@daxslab/coreui/views/layouts/main.php` by modifiying the layout attribute.

Also you can make your `@app/views/layouts/main.php` to look like:

```html

<?php $this->beginContent('@daxslab/coreui/views/layouts/main.php') ?>
    <?= $content ?>
<?php $this->endContent() ?>

```
Consider that there a a group of variables at the beginning of `@daxslab/coreui/views/layouts/main.php` that you can set
to specify brand icons, menu contents, etc.