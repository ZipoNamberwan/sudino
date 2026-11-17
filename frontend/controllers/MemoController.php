<?php

namespace frontend\controllers;

use Yii;
use app\models\Memo;
use app\models\MemoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemoController implements the CRUD actions for Memo model.
 */
class MemoController extends Controller
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
     * Lists all Memo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Memo model.
     * @param string $id_unit
     * @param string $id_memo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_unit, $id_memo)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_unit, $id_memo),
        ]);
    }

    /**
     * Creates a new Memo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_unit = null)
    {
        if ($id_unit==null) { $id_unit = ''; }
		
		$model = new Memo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_unit' => $model->id_unit, 'id_memo' => $model->id_memo]);
        }

        return $this->render('create', [
            'model' => $model,
			'id_unit' => $id_unit,
        ]);
    }

    /**
     * Updates an existing Memo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id_unit
     * @param string $id_memo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_unit, $id_memo)
    {
        $model = $this->findModel($id_unit, $id_memo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_unit' => $model->id_unit, 'id_memo' => $model->id_memo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Memo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id_unit
     * @param string $id_memo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_unit, $id_memo)
    {
        $this->findModel($id_unit, $id_memo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Memo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id_unit
     * @param string $id_memo
     * @return Memo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_unit, $id_memo)
    {
        if (($model = Memo::findOne(['id_unit' => $id_unit, 'id_memo' => $id_memo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
