<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nota */

$this->title = $model->no_memo;
$this->params['breadcrumbs'][] = ['label' => 'Nota Dinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="memo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id_unit' => $model->id_unit, 'id_memo' => $model->id_memo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id_unit' => $model->id_unit, 'id_memo' => $model->id_memo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin menghapus data ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_unit',
            //'id_memo',
            'no_memo',
            'tgl_memo',
            'perihal:ntext',
            'tujuan',
            [
                'attribute'=>'id_user',
                'value'=>$model->user->username,
            ],
        ],
    ]) ?>

</div>
