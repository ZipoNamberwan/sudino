<?php

namespace frontend\controllers;

use Yii;
use app\models\Surat;
use app\models\KlasifikasiSubstantif;
use app\models\SubklasifikasiSubstantif;
use app\models\KlasifikasiFasilitatif;
use app\models\SubklasifikasiFasilitatif;
use app\models\SubklasifikasiFasilitatif2;
use app\models\SuratSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuratController implements the CRUD actions for Surat model.
 */
class SuratController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Surat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuratSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Surat model.
     * @param string $id_unit
     * @param string $id_surat
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_unit, $id_surat)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_unit, $id_surat),
        ]);
    }

    /**
     * Creates a new Surat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_unit = null)
    {	
		if ($id_unit==null) { $id_unit = ''; }
		
        $model = new Surat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_unit' => $model->id_unit, 'id_surat' => $model->id_surat]);
        }

        return $this->render('create', [
            'model' => $model,
			'id_unit' => $id_unit,
        ]);
    }

    /**
     * Updates an existing Surat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id_unit
     * @param string $id_surat
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_unit, $id_surat)
    {
        $model = $this->findModel($id_unit, $id_surat);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_unit' => $model->id_unit, 'id_surat' => $model->id_surat]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Surat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id_unit
     * @param string $id_surat
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_unit, $id_surat)
    {
        $this->findModel($id_unit, $id_surat)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Surat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id_unit
     * @param string $id_surat
     * @return Surat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_unit, $id_surat)
    {
        if (($model = Surat::findOne(['id_unit' => $id_unit, 'id_surat' => $id_surat])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionKode()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$cat_id = $parents[0];
				if($cat_id=='S'){
					$array = KlasifikasiSubstantif::find()->asArray()->all();
				} elseif($cat_id=='F'){
					$array = KlasifikasiFasilitatif::find()->asArray()->all();
				}
				$out = ArrayHelper::getColumn($array, function ($data) {
					return [
						'id' => $data['kode'],
						'name' => $data['kode']." - ".$data['klasifikasi'],
				]; });
				return ['output'=>$out, 'selected'=>''];
			}
		}
		return ['output'=>'', 'selected'=>''];
    }
	
	public function actionSubkode()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$ids = $_POST['depdrop_parents'];
			$cat_id = empty($ids[0]) ? null : $ids[0];
			if ($cat_id != null) {
				$subcat_id = empty($ids[1]) ? null : $ids[1];
				if($cat_id=='S'){
					$array = SubklasifikasiSubstantif::find()->select('kode_subklasifikasi, subklasifikasi')->where(['kode_klasifikasi' => $subcat_id])->asArray()->all();
				} elseif($cat_id=='F'){
					$array = SubklasifikasiFasilitatif::find()->select('kode_subklasifikasi, subklasifikasi')->where(['kode_klasifikasi' => $subcat_id])->asArray()->all();
				}
				$out = ArrayHelper::getColumn($array, function ($data) {
					return [
						'id' => $data['kode_subklasifikasi'],
						'name' => $data['kode_subklasifikasi']." - ".$data['subklasifikasi'],
				]; });
				return ['output'=>$out, 'selected'=>''];
			}
		}
		return ['output'=>'', 'selected'=>''];
    }
	
	public function actionSubkode2() 
	{
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$ids = $_POST['depdrop_parents'];
			$cat_id = empty($ids[0]) ? null : $ids[0];
			if ($cat_id != null && $cat_id=='F') {				
				$subcat_id = empty($ids[1]) ? null : $ids[1];
				$subcat2_id = empty($ids[2]) ? null : $ids[2];
				$array = SubklasifikasiFasilitatif2::find()->select('kode_subklasifikasi2, subklasifikasi2')->where(['kode_klasifikasi' => $subcat_id, 'kode_subklasifikasi' => $subcat2_id])->asArray()->all();
				if(count($array) > 0) {
					$out = ArrayHelper::getColumn($array, function ($data) {
						return [
							'id' => $data['kode_subklasifikasi2'],
							'name' => $data['kode_subklasifikasi2']." - ".$data['subklasifikasi2'],
					]; });
					return ['output'=>$out, 'selected'=>''];	
				}
			}			
		}
		return ['output' => '', 'selected' => ''];
	}
}
