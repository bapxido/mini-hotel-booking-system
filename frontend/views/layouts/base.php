<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top orange-bar',
        ],
    ]); ?>
    <?php echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('hotel', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('hotel','About'), 'url' => ['/site/about']],
            ['label' => Yii::t('hotel','Rooms'), 'url' => ['/rooms/index']],
            ['label' => Yii::t('hotel','Menu'), 'url' => ['/menu/index']],
            ['label' => Yii::t('hotel','Booking'), 'url' => ['/hotel-booking/create']],
            ['label' => Yii::t('hotel','Contact'), 'url' => ['/site/contact']],
            [
                'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity(),
                'visible'=>!Yii::$app->user->isGuest,
                'items'=>[
                    [
                        'label' => Yii::t('frontend', 'Settings'),
                        'url' => ['/user/default/index']
                    ],
                    [
                        'label' => Yii::t('frontend', 'Backend'),
                        'url' => Yii::getAlias('@backendUrl'),
                        'visible'=>Yii::$app->user->can('manager')
                    ],
                    [
                        'label' => Yii::t('frontend', 'Logout'),
                        'url' => ['/user/sign-in/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ]
                ]
            ],
            [
                'label'=>Yii::t('hotel', 'Language'),
                'items'=>array_map(function ($code) {
                    return [
                        'label' => Yii::$app->params['availableLocales'][$code],
                        'url' => ['/site/set-locale', 'locale'=>$code],
                        'active' => Yii::$app->language === $code
                    ];
                }, array_keys(Yii::$app->params['availableLocales']))
            ]
        ]
    ]); ?>
    <?php NavBar::end(); ?>

    <?php echo $content ?>

</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Hotel Mariam <?php echo date('Y') ?></p>
        <p class="pull-right">Made by
            <a href="https://github.com/GiorgiB97">Giorgi Batiashvili (Frontend)</a> and
            <a href="https://github.com/Saiat3">Saiat Kalbiev (Backend)</a>
        </p>
    </div>
</footer>
<?php $this->endContent() ?>