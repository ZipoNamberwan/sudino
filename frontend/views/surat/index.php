<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SuratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nomor Surat Dinas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
	<?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<p>
        <?= Html::a('Buat Nomor Surat Dinas', ['create', 'id_unit' => Html::getAttributeValue($searchModel,'id_unit')], ['class' => 'btn btn-success']) ?>
    </p>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_unit',
            //'id_surat',
            'no_surat',
            'tgl_surat',
            //'perihal:ntext',
            [
               'attribute' => 'perihal',
               'contentOptions' => [
                   'style' => [
                       'width' => '45%',
                       'white-space' => 'normal',
                   ],
               ],
            ],
            [
               'attribute' => 'tujuan',
               'contentOptions' => [
                   'style' => [
                       'width' => '30%',
                       'white-space' => 'normal',
                   ],
               ],
            ],
            [
                'attribute'=>'id_user',
                'value' => function ($model) {
					return $model->user->username;
				},
            ],

            //['class' => '\kartik\grid\ActionColumn'],
			[
				'attribute'=>'aksi',
				'format' => 'raw',
				'value' => function($model) {
					if($model->id_user == Yii::$app->user->identity->id) {
						return Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id_unit' => $model->id_unit, 'id_surat' => $model->id_surat])
							.' '.Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id_unit' => $model->id_unit, 'id_surat' => $model->id_surat], [
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
