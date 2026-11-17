<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SuratMasuk */

$this->title = 'Ubah Surat Masuk: ' . $model->no_surat;
$this->params['breadcrumbs'][] = ['label' => 'Surat Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_surat, 'url' => ['view', 'id' => $model->no_surat]];
$this->params['breadcrumbs'][] = 'ubah';
?>
<div class="surat-masuk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
