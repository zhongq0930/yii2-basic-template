<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\helpers\ModuleHelper;
use app\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $items = ArrayHelper::merge([
        ['label' => Yii::t('common', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('common', 'About'), 'url' => ['/site/about']],
        ['label' => Yii::t('common', 'Contact'), 'url' => ['/site/contact']],
    ], ModuleHelper::getMenuItems());

    if (Yii::$app->user->isGuest) {
        $items = ArrayHelper::merge($items, [
            ['label' => Yii::t('common', 'Sign in'), 'url' => ['/user/security/login']],
            ['label' => Yii::t('common', 'Register'), 'url' => ['/user/registration/register']],
        ]);
    } else {
        $items = ArrayHelper::merge($items, [
            [
                'label' => Yii::t('common', 'System'),
                'visible' => Yii::$app->user->identity->isAdmin,
                'items' => [
                    [
                        'label' => Yii::t('common', 'Users'),
                        'url' => ['/user/admin']
                    ],
                ],
            ],
            [
                'label' => Yii::$app->user->identity->username,
                'items' => [
                    [
                        'label' => Yii::t('common', 'Profile'),
                        'url' => ['/user/profile/'],
                    ],
                    '<li class="divider"></li>',
                    [
                        'label' => Yii::t('common', 'Settings'),
                        'url' => ['/user/settings/profile/'],
                    ],
                    [
                        'label' => Yii::t('common', 'Sign out'),
                        'url' => ['/user/security/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
                ],
            ],
        ]);
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
