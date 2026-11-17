<?php

namespace frontend\controllers;

use Yii;
use app\models\Nota;
use app\models\NotaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotaController implements the CRUD actions for Nota model.
 */
class NotaController extends Controller
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
     * Lists all Nota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Nota model.
     * @param string $id_unit
     * @param string $id_nota
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_unit, $id_nota)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_unit, $id_nota),
        ]);
    }

    /**
     * Creates a new Nota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_unit = null)
    {
        if ($id_unit==null) { $id_unit = ''; }
		
		$model = new Nota();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_unit' => $model->id_unit, 'id_nota' => $model->id_nota]);
        }

        return $this->render('create', [
            'model' => $model,
			'id_unit' => $id_unit,
        ]);
    }

    /**
     * Updates an existing Nota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id_unit
     * @param string $id_nota
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_unit, $id_nota)
    {
        $model = $this->findModel($id_unit, $id_nota);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_unit' => $model->id_unit, 'id_nota' => $model->id_nota]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Nota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id_unit
     * @param string $id_nota
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_unit, $id_nota)
    {
        $this->findModel($id_unit, $id_nota)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Nota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id_unit
     * @param string $id_nota
     * @return Nota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_unit, $id_nota)
    {
        if (($model = Nota::findOne(['id_unit' => $id_unit, 'id_nota' => $id_nota])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
