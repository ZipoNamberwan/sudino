<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nota */

$this->title = 'Buat Nomor Nota Dinas';
$this->params['breadcrumbs'][] = ['label' => 'Nota Dinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'id_unit' => $id_unit,
    ]) ?>

</div>
