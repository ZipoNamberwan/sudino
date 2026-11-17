<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nomor Memorandum';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memo-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php Pjax::begin(); ?>
	<?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Buat Nomor Memorandum', ['create', 'id_unit' => Html::getAttributeValue($searchModel,'id_unit')], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_unit',
            //'id_memo',
            'no_memo',
            'tgl_memo',
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

            [
				'attribute'=>'aksi',
				'format' => 'raw',
				'value' => function($model) {
					if($model->id_user == Yii::$app->user->identity->id) {
						return Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id_unit' => $model->id_unit, 'id_memo' => $model->id_memo])
							.' '.Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id_unit' => $model->id_unit, 'id_memo' => $model->id_memo], [
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
