<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SuratMasukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-masuk-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Surat Masuk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	
	<?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_surat',
            'tgl_surat',
            'dari',
            'kepada',
            'perihal:ntext',
            'catatan:ntext',
            [
                'attribute'=>'id_user',
                'value' => function ($model) {
					return $model->user->username;
				},
            ],

            [
				'attribute'=>'aksi',
				'format' => 'raw',
				'value' => function($model) {
					if($model->id_user == Yii::$app->user->identity->id) {
						return Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id' => $model->no_surat])
							.' '.Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $model->no_surat], [
								'data' => ['confirm' => 'Apakah Anda yakin menghapus data ini?','method' => 'post']
							]
						);
					}
					return '';
				},
			],
        ],
    ]); ?>
	
	<?php Pjax::end(); ?>

</div>
