<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\SuratMasuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-masuk-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_surat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_surat')->widget(DatePicker::classname(), [
		'name' => 'tgl_surat', 			
		'bsVersion' => '4.x',
		'options' => ['placeholder' => 'Pilih Tanggal'],
		'pluginOptions' => [
			'format' => 'yyyy-mm-dd',
			'todayHighlight' => true,				
			'autoclose'=>true,
		]	
	]);?>

    <?= $form->field($model, 'dari')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kepada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'perihal')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'catatan')->textarea(['rows' => 6]) ?>

    <?php $id= yii::$app->user->identity->id;
		echo $form->field($model, 'id_user')->hiddenInput(['value' => $id])->label(false);
	?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
