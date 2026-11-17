<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Surat */

$this->title = 'Buat Nomor Surat Tugas';
$this->params['breadcrumbs'][] = ['label' => 'Surat Tugas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'id_unit' => $id_unit,
    ]) ?>

</div>
