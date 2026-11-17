<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\MJabatan;

/* @var $this yii\web\View */
/* @var $model app\models\NotaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="memo-search">

    <?php $form = ActiveForm::begin([	
		'type' => ActiveForm::TYPE_INLINE,		
        'fieldConfig' => ['options' => ['class' => 'form-group mb-3 mr-2 me-2']],
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_unit')->widget(Select2::classname(), [
			'bsVersion' => '4.x',
			'data' => ArrayHelper::map(MJabatan::find()->asArray()->all(), 'id', 'nama_jabatan'),
			'options' => ['placeholder' => 'Pilih Jabatan Penandatangan'],
			'pluginOptions' => [ 
				'allowClear' => true,			
				'width' => '450px',
		],
	]); ?>

    <?= '';//$form->field($model, 'id_memo') ?>

    <?= '';//$form->field($model, 'no_memo') ?>

    <?= '';//$form->field($model, 'tgl_memo') ?>

    <?= '';//$form->field($model, 'perihal') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <div class="form-group mb-3">
        <?= Html::submitButton('Pilih', ['class' => 'btn btn-primary']) ?>
        <!--<?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>-->
    </div>

    <?php ActiveForm::end(); ?>

</div>
