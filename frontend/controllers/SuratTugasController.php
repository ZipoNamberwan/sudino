<?php

namespace frontend\controllers;

use Yii;
use app\models\SuratTugas;
use app\models\SuratTugasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuratTugasController implements the CRUD actions for SuratTugas model.
 */
class SuratTugasController extends Controller
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
     * Lists all SuratTugas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuratTugasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SuratTugas model.
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
     * Creates a new SuratTugas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_unit = null)
    {	
		if ($id_unit==null) { $id_unit = ''; }
		
        $model = new SuratTugas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_unit' => $model->id_unit, 'id_surat' => $model->id_surat]);
        }

        return $this->render('create', [
            'model' => $model,
			'id_unit' => $id_unit,
        ]);
    }

    /**
     * Updates an existing SuratTugas model.
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
     * Deletes an existing SuratTugas model.
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
     * Finds the SuratTugas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id_unit
     * @param string $id_surat
     * @return SuratTugas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_unit, $id_surat)
    {
        if (($model = SuratTugas::findOne(['id_unit' => $id_unit, 'id_surat' => $id_surat])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
