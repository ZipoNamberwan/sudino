<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nota */

$this->title = 'Ubah Nota Dinas: ' . $model->no_nota;
$this->params['breadcrumbs'][] = ['label' => 'Nota Dinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_unit, 'url' => ['view', 'id_unit' => $model->id_unit, 'id_nota' => $model->id_nota]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="nota-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
