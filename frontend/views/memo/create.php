<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nota */

$this->title = 'Buat Nomor Memorandum';
$this->params['breadcrumbs'][] = ['label' => 'Memorandum', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'id_unit' => $id_unit,
    ]) ?>

</div>
