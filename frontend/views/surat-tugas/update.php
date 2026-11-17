<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SuratTugas */

$this->title = 'Ubah Surat Tugas: ' . $model->no_surat;
$this->params['breadcrumbs'][] = ['label' => 'Surat Tugas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_unit, 'url' => ['view', 'id_unit' => $model->id_unit, 'id_surat' => $model->id_surat]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-tugas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
