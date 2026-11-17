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

	<header class="masthead text-center" style="background-image: url('<?= $asset->baseUrl ?>/img/2447.jpg'); color: #ee0979;">
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">AGENDA</h1>	
        <h2 class="masthead-subheading mb-0">Surat dan Nota Dinas</h2>
		<a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">Learn More</a>
      </div>
    </div>
	</header>
	
	<!-- Content section 1-->
	<section id="scroll">
		<div class="container px-5">
			<div class="row gx-5 align-items-center">
				<div class="col-lg-6 order-lg-2">
					<div class="p-5"><img class="img-fluid rounded-circle" src="<?= $asset->baseUrl ?>/img/5964.jpg" alt="..." /></div>
				</div>
				<div class="col-lg-6 order-lg-1">
					<div class="p-5">
						<h2 class="display-4">Panduan Penggunaan</h2>
						<p>Klik tautan berikut untuk mengunduh Panduan Penggunaan Aplikasi Agen Sudino: <a href="<?= $asset->baseUrl ?>/download/Panduan Penggunaan.pdf" download>unduh</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Content section 2-->
	<section>
		<div class="container px-5">
			<div class="row gx-5 align-items-center">
				<div class="col-lg-6">
					<div class="p-5"><img class="img-fluid rounded-circle" src="<?= $asset->baseUrl ?>/img/10492.jpg" alt="..." /></div>
				</div>
				<div class="col-lg-6">
					<div class="p-5">
						<h2 class="display-4">Tata Naskah Dinas</h2>
						<p>Klik tautan berikut untuk mengunduh Peraturan BPS No 1 Tahun 2023 tentang Tata Naskah Dinas: <a href="http://s.bps.go.id/Dokumen_PerbanNomor1Tahun2023" download>unduh</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Content section 3-->
	<section>
		<div class="container px-5">
			<div class="row gx-5 align-items-center">
				<div class="col-lg-6 order-lg-2">
					<div class="p-5"><img class="img-fluid rounded-circle" src="<?= $asset->baseUrl ?>/img/5272.jpg" alt="..." /></div>
				</div>
				<div class="col-lg-6 order-lg-1">
					<div class="p-5">
						<h2 class="display-4">Kode Klasifikasi Arsip</h2>
						<p>Klik tautan berikut untuk mengunduh Daftar Kode Klasifikasi Arsip: <a href="<?= $asset->baseUrl ?>/download/KODE KLASIFIKASI.xlsx" download>unduh</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

</div>

<footer class="py-5 bg-black">
	<div class="container px-5"><p class="m-0 text-center text-white small">Copyright &copy; BPS Provinsi Jawa Timur 2022</p></div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
