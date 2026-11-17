<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class GenerateNoController extends Controller
{
    public $enableCsrfValidation = false;
    
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionGetNoSurat() {
		if ($_POST['tgl']=="" OR $_POST['unit']=="" OR $_POST['jenis']=="" OR $_POST['klas']=="" OR $_POST['kode_klas']=="" OR $_POST['kode_subklas']=="" OR $_POST['kode_subklas2']=="no") {	
            return json_encode(array("err"=>'<div class="alert alert-danger alert-dismissable">
				 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				 Semua data tidak boleh kosong, <b>kecuali</b> yang tidak ada kode subsubklasifikasinya.
			</div>'));
		} else {
			$action = $_POST['action'];
			$tgl = $_POST['tgl'];
			$unit = $_POST['unit'];
			$jenis = ($_POST['jenis']=='T') ? '' : $_POST['jenis'].'-';			
			$klas = $_POST['klas'];
			$kode_klas = $_POST['kode_klas'];
			$kode_subklas = $_POST['kode_subklas'];			
			$kode_subklas2 = $_POST['kode_subklas2'];
			
			if($action=='update') {
				$max_id = substr($_POST['id'], 0, strpos($_POST['id'], "/"));
			} elseif($_POST['jenis']=='T') {	
			    $model = 'app\models\SuratTugas';
				$max_tgl = $model::find()->where(['id_unit' => $unit])->max('tgl_surat');
				
				if(!isset($max_tgl)){
					$max_id = "1";
				} elseif($tgl < $max_tgl){
					$sql = $model::find()->select([new \yii\db\Expression("SUBSTRING_INDEX(id_surat, '/', 1) as new_id")])
						->where(['id_unit' => $unit])
						->andWhere(['<=', 'tgl_surat', $tgl])
						->andWhere('YEAR(tgl_surat) = YEAR(:tgl)', [':tgl' => $tgl])
						->orderBy([
							"CAST(REGEXP_REPLACE(SUBSTRING_INDEX(id_surat, '/', 1), '[A-Z]+', '') AS UNSIGNED)"=>SORT_DESC,
							"LENGTH(REGEXP_REPLACE(SUBSTRING_INDEX(id_surat, '/', 1), '[0-9]+', ''))" => SORT_DESC,
							"SUBSTRING_INDEX(id_surat, '/', 1)" => SORT_DESC,
						])
						->limit(1)
						->asArray()
						->one();
					$max_id = $sql['new_id'];

					if(!is_numeric(substr($max_id,-1))){ //digit terakhir nomor surat alfabet
						$alfabet = substr($max_id,-1);
						$max_id = substr($max_id, 0, -1). ++$alfabet;
					} else { 
						$max_id = $max_id."A";
					}
				} else {
					$sql = $model::find()->select([new \yii\db\Expression('id_surat + 1 as new_id')])
						->where(['id_unit' => $unit])
						->andWhere('YEAR(tgl_surat) = YEAR(CURDATE())')
						->orderBy([
							'cast(id_surat as SIGNED)'=>SORT_DESC,
							'id_surat' => SORT_DESC,
						])
						->limit(1)
						->asArray()
						->one();
					$id = ($sql['new_id']=='' ? 1 : $sql['new_id']);
					$max_id = $id;
				}
			} else {			
				$model = 'app\models\Surat';
				$max_tgl = $model::find()->where(['id_unit' => $unit])->max('tgl_surat');
				
				if(!isset($max_tgl)){
					$max_id = "1";
				} elseif($tgl < $max_tgl){
					$sql = $model::find()->select([new \yii\db\Expression("SUBSTRING_INDEX(id_surat, '/', 1) as new_id")])
						->where(['id_unit' => $unit])
						->andWhere(['<=', 'tgl_surat', $tgl])
						->andWhere('YEAR(tgl_surat) = YEAR(:tgl)', [':tgl' => $tgl])
						->orderBy([
							"CAST(REGEXP_REPLACE(SUBSTRING_INDEX(id_surat, '/', 1), '[A-Z]+', '') AS UNSIGNED)"=>SORT_DESC,
							"LENGTH(REGEXP_REPLACE(SUBSTRING_INDEX(id_surat, '/', 1), '[0-9]+', ''))" => SORT_DESC,
							"SUBSTRING_INDEX(id_surat, '/', 1)" => SORT_DESC,
						])
						->limit(1)
						->asArray()
						->one();
					$max_id = $sql['new_id'];

					if(!is_numeric(substr($max_id,-1))){ //digit terakhir nomor surat alfabet
						$alfabet = substr($max_id,-1);
						$max_id = substr($max_id, 0, -1). ++$alfabet;
					} else { 
						$max_id = $max_id."A";
					}
				} else {
					$sql = $model::find()->select([new \yii\db\Expression('id_surat + 1 as new_id')])
						->where(['id_unit' => $unit])
						->andWhere('YEAR(tgl_surat) = YEAR(CURDATE())')
						->orderBy([
							'cast(id_surat as SIGNED)'=>SORT_DESC,
							'id_surat' => SORT_DESC,
						])
						->limit(1)
						->asArray()
						->one();
					$id = ($sql['new_id']=='' ? 1 : $sql['new_id']);
					$max_id = $id;
				}
			}
			
			$no_surat = $jenis.$max_id."/".$unit."/".$kode_klas.".".$kode_subklas.$kode_subklas2."/".date('Y',strtotime($tgl));
						
			return json_encode(array("id"=>ltrim($max_id, '0')."/".date('Y', strtotime($tgl)),"no"=>$no_surat,"err"=>""));
		}
	}	
	
	public function actionGetNoNota() {
		if ($_POST['tgl']=="" OR $_POST['unit']=="" OR $_POST['klas']=="" OR $_POST['kode_klas']=="" OR $_POST['kode_subklas']=="" OR $_POST['kode_subklas2']=="no") {			
            return json_encode(array("err"=>'<div class="alert alert-danger alert-dismissable">
				 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				 Semua data tidak boleh kosong, <b>kecuali</b> yang tidak ada kode subsubklasifikasinya.
			</div>'));
		} else {
			$action = $_POST['action'];
			$tgl = $_POST['tgl'];
			$unit = $_POST['unit'];
			$klas = $_POST['klas'];
			$jenis = $_POST['jenis'];
			$kode_klas = $_POST['kode_klas'];
			$kode_subklas = $_POST['kode_subklas'];			
			$kode_subklas2 = $_POST['kode_subklas2'];
			
			if($action=='update') {
				$max_id = substr($_POST['id'], 0, strpos($_POST['id'], "/"));
			} elseif($jenis=='M') {	
			    $model = 'app\models\Memo';
				$max_tgl = $model::find()->where(['id_unit' => $unit])->max('tgl_memo');

				if(!isset($max_tgl)){
					$max_id = "1";
				} elseif($tgl < $max_tgl){
					$sql = $model::find()->select([new \yii\db\Expression("SUBSTRING_INDEX(id_memo, '/', 1) as new_id")])
						->where(['id_unit' => $unit])
						->andWhere(['<=', 'tgl_memo', $tgl])
						->andWhere('YEAR(tgl_memo) = YEAR(:tgl)', [':tgl' => $tgl])
						->orderBy([
							"CAST(REGEXP_REPLACE(SUBSTRING_INDEX(id_memo, '/', 1), '[A-Z]+', '') AS UNSIGNED)"=>SORT_DESC,
							"LENGTH(REGEXP_REPLACE(SUBSTRING_INDEX(id_memo, '/', 1), '[0-9]+', ''))" => SORT_DESC,
							"SUBSTRING_INDEX(id_memo, '/', 1)" => SORT_DESC,
						])
						->limit(1)
						->asArray()
						->one();
					$max_id = $sql['new_id'];
					
					if(!is_numeric(substr($max_id,-1))){ //digit terakhir nomor surat alfabet
						$alfabet = substr($max_id,-1);
						$max_id = substr($max_id, 0, -1). ++$alfabet;
					} else { 
						$max_id = $max_id."A";
					}
				} else {
					$sql = $model::find()->select([new \yii\db\Expression('id_memo + 1 as new_id')])
						->where(['id_unit' => $unit])
						->andWhere('YEAR(tgl_memo) = YEAR(CURDATE())')
						->orderBy([
							'cast(id_memo as SIGNED)'=>SORT_DESC,
							'id_memo' => SORT_DESC,
						])
						->limit(1)
						->asArray()
						->one();
					$id = ($sql['new_id']=='' ? 1 : $sql['new_id']);
					$max_id = $id;
				}
			} else {			
				$model = 'app\models\Nota';
				$max_tgl = $model::find()->where(['id_unit' => $unit])->max('tgl_nota');

				if(!isset($max_tgl)){
					$max_id = "1";
				} elseif($tgl < $max_tgl){
					$sql = $model::find()->select([new \yii\db\Expression("SUBSTRING_INDEX(id_nota, '/', 1) as new_id")])
						->where(['id_unit' => $unit])
						->andWhere(['<=', 'tgl_nota', $tgl])
						->andWhere('YEAR(tgl_nota) = YEAR(:tgl)', [':tgl' => $tgl])
						->orderBy([
							"CAST(REGEXP_REPLACE(SUBSTRING_INDEX(id_nota, '/', 1), '[A-Z]+', '') AS UNSIGNED)"=>SORT_DESC,
							"LENGTH(REGEXP_REPLACE(SUBSTRING_INDEX(id_nota, '/', 1), '[0-9]+', ''))" => SORT_DESC,
							"SUBSTRING_INDEX(id_nota, '/', 1)" => SORT_DESC,
						])
						->limit(1)
						->asArray()
						->one();
					$max_id = $sql['new_id'];
					
					if(!is_numeric(substr($max_id,-1))){ //digit terakhir nomor surat alfabet
						$alfabet = substr($max_id,-1);
						$max_id = substr($max_id, 0, -1). ++$alfabet;
					} else { 
						$max_id = $max_id."A";
					}
				} else {
					$sql = $model::find()->select([new \yii\db\Expression('id_nota + 1 as new_id')])
						->where(['id_unit' => $unit])
						->andWhere('YEAR(tgl_nota) = YEAR(CURDATE())')
						->orderBy([
							'cast(id_nota as SIGNED)'=>SORT_DESC,
							'id_nota' => SORT_DESC,
						])
						->limit(1)
						->asArray()
						->one();
					$id = ($sql['new_id']=='' ? 1 : $sql['new_id']);
					$max_id = $id;
				}
			}
			
			$no_nota = $max_id."/".$unit."/".$kode_klas.".".$kode_subklas.$kode_subklas2."/".date('Y',strtotime($tgl));
						
			return json_encode(array("id"=>ltrim($max_id, '0')."/".date('Y', strtotime($tgl)),"no"=>$no_nota,"err"=>""));
		}
	}	
}
