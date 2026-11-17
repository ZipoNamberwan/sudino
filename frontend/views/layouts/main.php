<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\WonderAsset;
use common\widgets\Alert;

$asset = WonderAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <?php //$this->registerCsrfMetaTags() ?>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="'. $asset->baseUrl .'/img/sudino.png" class="img-responsive"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'id' => "mainNav",
			'class' => 'navbar navbar-expand-lg navbar-dark navbar-custom fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Beranda', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
		$menuItems[] = ['label' => 'Nota Dinas', 'url' => ['/nota']];
        $menuItems[] = ['label' => 'Memorandum', 'url' => ['/memo']];	
        $menuItems[] = ['label' => 'Surat Dinas', 'url' => ['/surat']];		
        $menuItems[] = ['label' => 'Surat Tugas', 'url' => ['/surat-tugas']];
        if (Yii::$app->user->identity->username == "Dewi W" or Yii::$app->user->identity->username == "dhardiwan" or Yii::$app->user->identity->username == "irien.ka") {
            $menuItems[] = ['label' => 'Surat Masuk', 'url' => ['/surat-masuk']];
        }
		$menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'LOGOUT (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn-primary', 'style' => 'font-size: 1rem; font-weight: 400; padding: 0.2rem 0.5rem;']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
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

<footer class="py-5 bg-black">
	<div class="container px-5"><p class="m-0 text-center text-white small">Copyright &copy; Your Website 2021</p></div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
