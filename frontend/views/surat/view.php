<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Surat */

$this->title = $model->no_surat;
$this->params['breadcrumbs'][] = ['label' => 'Surat Dinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="surat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id_unit' => $model->id_unit, 'id_surat' => $model->id_surat], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id_unit' => $model->id_unit, 'id_surat' => $model->id_surat], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Anda yakin akan menghapus data ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_unit',
            //'id_surat',
            'no_surat',
            'tgl_surat',
            'perihal:ntext',
            [
                'attribute'=>'id_user',
                'value'=>$model->user->username,
            ],
            'tujuan',
        ],
    ]) ?>

</div>
