<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use app\models\MSatuanOrganisasi;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Surat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<fieldset class="border p-2">
	<legend class="w-auto" style="color:#72afd2!important;">Generate Nomor Surat</legend>
				
		<?php if(Yii::$app->controller->action->id == 'update') { ?>
			<?= $form->field($model, 'id_unit')->textInput(['maxlength' => true,'readonly' => true]) ?>
		<?php } else { 
		    if (Yii::$app->user->identity->username == "Dewi W" or Yii::$app->user->identity->username == "dhardiwan") { ?>
			<?= $form->field($model, 'id_unit')->widget(Select2::classname(), [
				'bsVersion' => '4.x',
				'data' => ArrayHelper::map(MSatuanOrganisasi::find()->asArray()->all(), 'id', 'satuan_organisasi'),
				'options' => ['placeholder' => 'Pilih Satuan Organisasi', 'value' => $id_unit],
				'pluginOptions' => [ 
					'allowClear' => true,	
				]
			]);?>
		<?php } else { ?>
		    <?= $form->field($model, 'id_unit')->widget(Select2::classname(), [
				'bsVersion' => '4.x',
				'data' => ArrayHelper::map(MSatuanOrganisasi::find()->where("id NOT IN ('35000', '35530-ST')")->asArray()->all(), 'id', 'satuan_organisasi'),
				'options' => ['placeholder' => 'Pilih Satuan Organisasi', 'value' => $id_unit],
				'pluginOptions' => [ 
					'allowClear' => true,	
				]
			]);?>
		<?php } } ?>
		
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
				
		<?php $data = ['B' => 'Biasa', 'K' => 'Khusus'];
		echo '<label class="control-label">Jenis Surat</label>';
			echo Select2::widget([
				'name' => 'jenis_surat',			
				'bsVersion' => '4.x',
				'data' => $data,
				'options' => [					
					'id' => 'jenis',
					'placeholder' => 'Pilih Jenis Surat',
				],
			]);		
		?><br/>
		
		<?php $klasifikasi = [ 'S' => 'Substantif', 'F' => 'Fasilitatif'];
			echo '<label class="control-label">Klasifikasi Surat</label>';
			echo Select2::widget([	
				'name' => 'klasifikasi_surat',
				'bsVersion' => '4.x',
				'data' => $klasifikasi,
				'options' => [
					'id' => 'klasifikasi',
					'placeholder' => 'Pilih Jenis Klasifikasi',
				],
			]);		
		?><br/>
				
		<?php echo DepDrop::widget([				
				'type' => DepDrop::TYPE_SELECT2,
				'name' => 'kode_klasifikasi',			
				'bsVersion' => '4.x',
				'options'=>['id'=>'kode_klasifikasi', 'placeholder'=>'Pilih Kode Klasifikasi'],
				'pluginOptions'=>[
					'depends'=>['klasifikasi'],
					'url'=>'https://webapps.bps.go.id/jatim/sudino/frontend/web/index.php?r=surat/kode',//Url::to(['/surat/kode']),
				]
			]);	
		?><br/>
		
		<?php echo DepDrop::widget([				
				'type' => DepDrop::TYPE_SELECT2,
				'name' => 'kode_subklasifikasi',			
				'bsVersion' => '4.x',
				'options'=>['id'=>'kode_subklasifikasi', 'placeholder'=>'Pilih Kode Subklasifikasi'],
				'pluginOptions'=>[
					'depends'=>['klasifikasi','kode_klasifikasi'],
					'url'=>'https://webapps.bps.go.id/jatim/sudino/frontend/web/index.php?r=surat/subkode',//Url::to(['/surat/subkode']),
				]
			]);	
		?><br/>
		
		<?php echo DepDrop::widget([				
				'type' => DepDrop::TYPE_SELECT2,
				'name' => 'kode_subklasifikasi2',			
				'bsVersion' => '4.x',
				'options'=>['id'=>'kode_subklasifikasi2', 'placeholder'=>'Pilih Kode Subsubklasifikasi'],
				'pluginOptions'=>[
					'depends'=>['klasifikasi','kode_klasifikasi','kode_subklasifikasi'],
					'url'=>'https://webapps.bps.go.id/jatim/sudino/frontend/web/index.php?r=surat/subkode2',//Url::to(['/surat/subkode2']),
				]
			]);	
		?><br/>
		
		<div class="info" id='flash'></div>
		
		<p><?= Html::button('Generate', ['class' => 'btn btn-secondary','id'=>'generate_no']) ?></p>
		
		<input type="hidden" id="surat-action" value="<?= Yii::$app->controller->action->id ?>">
	
<?php $script = <<< JS
        
		$('#generate_no').click(function(){
		    
			var tgl = $("#surat-tgl_surat").val();			
			var unit = $("#surat-id_unit").val();
			var jenis = $("#jenis").val();
			var klas = $("#klasifikasi").val();				
			var kode_klas = $("#kode_klasifikasi").val();			
			var kode_subklas = $("#kode_subklasifikasi").val();			
			var kode_subklas2 = $("#kode_subklasifikasi2").val();			
			var action = $("#surat-action").val();
			
            if ( !$('#kode_subklasifikasi2').is('[disabled]') && kode_subklas2.length == 0) {
            	kode_subklas2 = 'no';
            } else {
                kode_subklas2 = kode_subklas2;
            }
						
			if(action=='update'){				
				var id = $("#surat-id_surat").val();	
				var data = {action: action, id: id, tgl: tgl, unit: unit, jenis: jenis, klas: klas, kode_klas: kode_klas, kode_subklas: kode_subklas, kode_subklas2: kode_subklas2};
			} else {							
				var data = {action: action, tgl: tgl, unit: unit, jenis: jenis, klas: klas, kode_klas: kode_klas, kode_subklas: kode_subklas, kode_subklas2: kode_subklas2};
			}
			
			$.ajax({
				url : '?r=generate-no/get-no-surat',
				type : 'POST',			
				dataType: "json",
				data : data,
				success : function(data){ 
				  if(data.err!=''){
				    $('#flash').html(data.err).fadeIn().animate({opacity: 1.0}, 3500).fadeOut("slow");
				  } else {
				    $('#surat-id_surat').val(data.id);
				    $('#surat-no_surat').val(data.no);	
				  }
				}
			});
		});
    
JS;
$this->registerJs($script); ?>
	
	</fieldset>

    <?= $form->field($model, 'id_surat')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'no_surat')->textInput(['maxlength' => true,'readonly' => true]) ?>

    <?= $form->field($model, 'perihal')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'tujuan')->textInput(['maxlength' => true]) ?>

    <?php $id= yii::$app->user->identity->id;
		echo $form->field($model, 'id_user')->hiddenInput(['value' => $id])->label(false);
	?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
